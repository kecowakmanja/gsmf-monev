<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class C_cair extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		if($this->session->userdata('status')!="masuk"){
			redirect('c_depan/index');
		} 
	}
 
	function index(){
		if (($this->session->userdata('kelompok') == "ROOT") or ($this->session->userdata('kelompok') == "BENDAHARA")){
			redirect('c_cair/daftar_hutang');
		}
		else {
			redirect('c_cair/gagal_masuk');
		}
	}

	function daftar_hutang(){
		$kondisi = array('rekgol' => "7", 'reksts' => "AKTIF");
		$tabel = "rekening";
		$data['daftar_rekening_beban'] = $this->m_db->ambil_data($kondisi,$tabel)->result();
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_cair()->result();
		$this->load->view('v_cair.php',$data);
	}

	function daftar_hutang_saring(){
		$c_hutsts = $this->input->post('c_hutsts');
		$c_huttglrnc = $this->input->post('c_huttglrnc');
		$c_hutrekprm = $this->input->post('c_hutrekprm');
		
		$c_saring = array(
			'hutsts' => $c_hutsts,
			'huttglrnc' => $c_huttglrnc,
			'hutrekprm' => $c_hutrekprm
		);
		
		$kondisi = array('rekgol' => "7", 'reksts' => "AKTIF");
		$tabel = "rekening";
		$data['daftar_rekening_beban'] = $this->m_db->ambil_data($kondisi,$tabel)->result();
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_cair_saring($c_saring)->result();
		$this->load->view('v_cair.php',$data);
	}

	function cair_hutang($hutprm){
		$kondisiH = array('hutprm' => $hutprm);
		$tabelH = "hutang";
		$kondisiR = array('rekgol' => "1", 'reksts' => "AKTIF");
		$tabelR = "rekening";
		$data['daftar_rekening_kas'] = $this->m_db->ambil_data($kondisiR,$tabelR)->result();
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_cair_ok($kondisiH,$tabelH)->result();

		foreach ($data['daftar_hutang'] as $h){
			$c_hutsts = $h->hutsts;
			$c_hutrnc = $h->hutrnc;
			$c_huttotal = $h->huttotal;
		}

		if (($c_hutsts != "SETUJU") AND ($c_hutrnc-$c_huttotal<='0')){
			$t_pesan = "ANGGARAN SUDAH HABIS, TIDAK BOLEH CAIR";
			echo "<script>
			alert('$t_pesan');
			location.href='".base_url()."index.php';
			</script>";
		} else {
		$this->load->view('v_cair_u.php',$data);
		}
	}

	function cair_hutang_ok(){
		$u_hutprm = $this->input->post('u_hutprm');
		$u_mtstotal = $this->input->post('u_mtstotal');
		$u_mtsrekprm = $this->input->post('u_mtsrekprm');
		$u_mtsket = $this->input->post('u_mtsket');
		$u_hutsts = "CAIR";
		$tabelH = "hutang";
		$kondisi = array(
			'hutprm' => $u_hutprm
		);

		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi,$tabelH)->result();

		foreach($data['daftar_hutang'] as $hut){
			$c_hutrnc = $hut->hutrnc;
			$c_huttotal = $hut->huttotal;
		}

		$u_total = $c_huttotal+$u_mtstotal;
		$c_sisa = $c_hutrnc-$c_huttotal;
		$t_mtsdt = "KK";
		$t_mtssts = "SELESAI";
		$t_mtspgnprm = $this->session->userdata('prm');
		$t_mtstgl = date('Y-m-d');
		$t_mtsket = $this->input->post('u_mtsket');
		$t_mtsrekprm = $this->input->post('u_mtsrekprm');
		$t_mtshutpiuprm = $this->input->post('u_hutprm');
		$t_mtstotal = $this->input->post('u_mtstotal');
		$t_hutnobuk = "mtsnobuk";
		$tabelM = "mutasi";
		$nilaiID = array(
			'mtsdt' => $t_mtsdt,
			'mtstgl' => $t_mtstgl
			);
		
		$data_hutang = array(
			'hutsts' => $u_hutsts,
			'huttotal' => $u_total
		);

		$this->form_validation->set_rules('u_mtsrekprm','Rekening Kas','required');
		$this->form_validation->set_rules('u_mtsket','Referensi','required');
		$this->form_validation->set_rules('u_mtstotal','Nilai',"greater_than[0]|less_than_equal_to[$c_sisa]");

		if($this->form_validation->run() != false){
			$urut['id_terakhir'] = $this->m_db->ambil_data_urut($nilaiID,$tabelM,$t_hutnobuk)->result();
			foreach ($urut['id_terakhir'] as $id){
				$c_mtsnobuk = ltrim(substr($id->mtsnobuk,-5),'0');
			}
			$nourut = $c_mtsnobuk + 1;
			$nilai = array(
				'mtsdt' => $t_mtsdt,
				'mtssts' => $t_mtssts,
				'mtstgl' => $t_mtstgl,
				'mtspgnprm' => $t_mtspgnprm,
				'mtsket' => $t_mtsket,
				'mtsrekprm' => $t_mtsrekprm,
				'mtstotal' => $t_mtstotal,
				'mtshutpiuprm' => $t_mtshutpiuprm,
				'mtsnobuk' => $t_mtsdt.date('Ymd').str_pad($nourut,5,"0",STR_PAD_LEFT)
				);
			$this->m_db->tambah_data($nilai,$tabelM);
			$this->m_db->ubah_data($kondisi,$data_hutang,$tabelH);
			redirect('c_cair/index');
		} else {
			$t_pesan = "Semua Kolom Harus Di Isi,Nilai harus>0 dan<=Sisa Pencairan";
			echo "<script>
			alert('$t_pesan');
			location.href='".base_url()."index.php';
			</script>";
		}
	}

	function batal_hutang($hutprm){
			$kondisi = array('hutprm' => $hutprm);
			$tabel = "hutang";
			$u_hutsts = "SETUJU";
			$nilai = array('hutsts' => $u_hutsts);
			$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi,$tabel)->result();
	
			foreach ($data['daftar_hutang'] as $h){
				$c_hutsts = $h->hutsts;
			}
	
			if ($c_hutsts != "CAIR"){
				$t_pesan = "ANGGARAN BELUM CAIR, TIDAK BOLEH BATAL";
				echo "<script>
				alert('$t_pesan');
				location.href='".base_url()."index.php';
				</script>";
			} else {
			$this->m_db->ubah_data($kondisi,$nilai,$tabel);
			redirect('c_cair/index');
			}
	}

	function gagal_masuk(){
		$t_pesan = "PENGGUNA TIDAK BOLEH MASUK LAMAN INI";
		echo "<script>
		alert('$t_pesan');
		location.href='".base_url()."index.php';
		</script>";
	}
		
 
}