<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class C_setuju extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		if($this->session->userdata('status')!="masuk"){
			redirect('c_depan/index');
		} 
	}
 
	function index(){
		if (($this->session->userdata('kelompok') == "ROOT") or ($this->session->userdata('kelompok') == "BENDAHARA")){
			redirect('c_setuju/daftar_hutang');
		}
		else {
			redirect('c_setuju/gagal_masuk');
		}
	}

	function daftar_hutang(){
		$kondisi = array('rekgol' => "7", 'reksts' => "AKTIF");
		$tabel = "rekening";
		$data['daftar_rekening_beban'] = $this->m_db->ambil_data($kondisi,$tabel)->result();
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_setuju()->result();
		$this->load->view('v_setuju.php',$data);
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
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_setuju_saring($c_saring)->result();
		$this->load->view('v_setuju.php',$data);
	}

	function setuju_hutang($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$tabel = "hutang";
		$u_hutsts = "SETUJU";
		$t_accdt = "ACC";
		$t_acctgl = date('Y-m-d');
		$t_accsts = "SELESAI";
		$nilai = array('hutsts' => $u_hutsts);
		$t_accpgnprm = $this->session->userdata('prm');
		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi,$tabel)->result();

		$t_accnobuk = 'accnobuk';
		$tabelacc = "acc";
		$nilaiID = array(
			'accdt' => $t_accdt,
			'acctgl' => $t_acctgl
			);

		$urut['id_terakhir'] = $this->m_db->ambil_data_urut($nilaiID,$tabelacc,$t_accnobuk)->result();
		foreach ($urut['id_terakhir'] as $id){
			$c_accnobuk = ltrim(substr($id->accnobuk,-5),'0');
		}

		$nourut = $c_accnobuk + 1;
		$nilaiacc = array(
			'accdt' => $t_accdt,
			'accsts' => $t_accsts,
			'acctgl' => $t_acctgl,
			'accpgnprm' => $t_accpgnprm,
			'accket' => $u_hutsts,
			'acchutpiuprm' => $hutprm,
			'accnobuk' => $t_accdt.date('Ymd').str_pad($nourut,5,"0",STR_PAD_LEFT)
			);

		foreach ($data['daftar_hutang'] as $h){
			$c_hutsts = $h->hutsts;
		}

		if ($c_hutsts != "BARU"){
			$t_pesan = "ANGGARAN $c_hutsts, TIDAK BOLEH UBAH/HAPUS";
			echo "<script>
			alert('$t_pesan');
			location.href='".base_url()."index.php';
			</script>";
		} else {
		$this->m_db->ubah_data($kondisi,$nilai,$tabel);
		$this->m_db->tambah_data($nilaiacc,$tabelacc);
		redirect('c_setuju/index');
		}
	}

	function tolak_hutang($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$tabel = "hutang";
		$data['daftar_hutang'] = $this->m_db->ambil_data_hutang_cair_ok($kondisi,$tabel)->result();
	
		foreach ($data['daftar_hutang'] as $h){
			$c_hutsts = $h->hutsts;
		}
	
		if ($c_hutsts != "BARU"){
			$t_pesan = "ANGGARAN $c_hutsts, TIDAK BOLEH UBAH/HAPUS";
			echo "<script>
			alert('$t_pesan');
			location.href='".base_url()."index.php';
			</script>";
		} else {
		$this->load->view('v_setuju_u.php',$data);
		}
	}

	function tolak_hutang_ok(){
		$kondisi = array('hutprm' => $this->input->post('u_hutprm'));
		$hutprm = $this->input->post('u_hutprm');
		$tabel = "hutang";
		$u_hutsts = "TOLAK";
		$u_accket = implode(',',$this->input->post('u_accket'));
		$t_accdt = "ACC";
		$t_acctgl = date('Y-m-d');
		$t_accsts = "SELESAI";
		$nilai = array('hutsts' => $u_hutsts);
		$t_accpgnprm = $this->session->userdata('prm');
		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi,$tabel)->result();

		$t_accnobuk = 'accnobuk';
		$tabelacc = "acc";
		$nilaiID = array(
			'accdt' => $t_accdt,
			'acctgl' => $t_acctgl
			);

		$urut['id_terakhir'] = $this->m_db->ambil_data_urut($nilaiID,$tabelacc,$t_accnobuk)->result();
		foreach ($urut['id_terakhir'] as $id){
			$c_accnobuk = ltrim(substr($id->accnobuk,-5),'0');
		}

		$nourut = $c_accnobuk + 1;
		$nilaiacc = array(
			'accdt' => $t_accdt,
			'accsts' => $t_accsts,
			'acctgl' => $t_acctgl,
			'accpgnprm' => $t_accpgnprm,
			'accket' => $u_accket,
			'acchutpiuprm' => $hutprm,
			'accnobuk' => $t_accdt.date('Ymd').str_pad($nourut,5,"0",STR_PAD_LEFT)
			);

		foreach ($data['daftar_hutang'] as $h){
			$c_hutsts = $h->hutsts;
		}

		if ($c_hutsts != "BARU"){
			$t_pesan = "ANGGARAN $c_hutsts, TIDAK BOLEH UBAH/HAPUS";
			echo "<script>
			alert('$t_pesan');
			location.href='".base_url()."index.php';
			</script>";
		} else {
		$this->m_db->ubah_data($kondisi,$nilai,$tabel);
		$this->m_db->tambah_data($nilaiacc,$tabelacc);
		redirect('c_setuju/index');
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