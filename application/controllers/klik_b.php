<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class klik_b extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->FormB1 = "daftar_b1";
		$this->KePilihanB1 = "klik_b/pilihan_b1";
		$this->KePilihanZ1 = "klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		redirect($this->KePilihanB1);
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_b1');
		$this->session->unset_userdata('validasi_b1');
	}

	function pilihan_b1(){
		if($this->session->userdata('hak')=="PEMILIK"){
			$kondisi1 = "1=1";
		}
		else{
			$kondisi1 = array(
				'k.kel_mst_subkode'=>$this->session->userdata('kelompok')
			);
		};

		$kondisi2 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'PROGRAM'
		);

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormB1,$data);
		$this->kosong_operator_validasi();
	}


	function tambah_hutang_ok(){
		
		$kondisi = array('hutprm' => $this->input->post('hutprm'));
		
		if ($this->input->post('btnKirim')!="BATAL"){
			if (empty($_POST['t_hut_mst_nobuk'])) {
				$prefix1 = 'AGR';
				$prefix2 = date('Ymd');
				$prefix3 = date('Y-m-d');
				$prm1 = 'hut_mst_dt';
				$prm2 = 'hut_mst_nobuk';
				$prm3 = 'hut_mst_tgl';
				$separator = "-";
	
				$_POST['t_hut_mst_nobuk'] = $this->m_db->ambil_data_urut($this->TabelHutangMaster,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3)->result();
				if (empty($data_no_bukti_acak)){ //empty karna blm ada record
					$_POST['t_hut_mst_nobuk'] = trim(strtoupper($prefix1.$separator.$prefix2.$separator.str_pad(floor(rand(0,99999)),5,"0",STR_PAD_LEFT)));
				}
			}
			
			$konfigurasi = array (
				'upload_path' => base_url().'berkas/unggah/',
				'allowed_types' => 'doc|docx',
				'max_size' => 20480,
				'overwrite' => true,
				'file_name' => $_POST['t_hut_mst_nobuk']
				);
 
			$this->load->library('upload', $konfigurasi);
			
			if (!$this->upload->do_upload('t_hut_mst_doc')){
				$validasi_b1 = array(
					'validasi_b1' => "Unggah proposal ga berhasil, hanya bisa file doc/docx"
				);
				$this->session->set_userdata($validasi_b1);
				redirect($this->KePilihanB1);
				$this->kosong_operator_validasi();
			}
			
			$this->form_validation->set_rules('t_hut_mst_tglrnc','RENCANA KEGIATAN','required');
			$this->form_validation->set_rules('t_hut_mst_rek','REKENING BEBAN','required');
			$this->form_validation->set_rules('t_hut_mst_nobuk','FILE','required');
			$this->form_validation->set_rules('t_hut_mst_ket','KETERANGAN','required|max_length[2000]');
			$this->form_validation->set_rules('t_hut_mst_rnc','RENCANA ANGGARAN','required|greater_than[0]');
			
			if ($this->input->post('btnKirim')=="TAMBAH"){
				$this->form_validation->set_rules('t_hut_mst_nobuk','SUBKODE','required|trim|max_length[20]|is_unique['.$this->TabelHutangMaster.'.hut_mst_nobuk]');
			}
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba ganti yang lain deh');
			$this->form_validation->set_message('greater_than','%s pengajuan anggarannya harus lebih dari 0');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			if($this->form_validation->run() != false){
				$nilai_master = array(
					'hut_mst_lock' => '0',
					'hut_mst_dt' => 'AGR',
					'hut_mst_nobuk' => $this->input->post('t_hut_mst_nobuk'),
					'hut_mst_sts' => 'BARU',
					'hut_mst_tgl' => date('Y-m-d'),
					'hut_mst_tglrnc' => $this->input->post('t_hut_mst_tglrnc'),
					'hut_mst_pst' => $this->session->userdata('kode'),
					'hut_mst_rek' => $this->input->post('t_hut_mst_rek'),
					'hut_mst_rnc' => $this->input->post('t_hut_mst_rnc'),
					'hut_mst_ket' => trim(strtoupper($this->input->post('t_hut_mst_ket')))
				);
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelHutangMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
						break;
					default:
						redirect($this->KePilihanB1);
						break;
				}
			} else {
					$validasi_b1 = array('validasi_b1' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_b1);
			}
		}
		
		$nilai_master = array('hut_mst_lock' => '0');
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		redirect($this->KePilihanB1);
	}


	function hapus_hutang_ok($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		foreach ($data['daftar_hutang_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}
		
		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_b1 = array(
				'validasi_b1' => "Pengajuan anggaran lagi di proses, nda boleh hapus data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_b1);
		} else {
			$this->m_db->hapus_data($kondisi,$this->TabelHutangMaster);
		}
		redirect($this->KePilihanB1);
		$this->kosong_operator_validasi();
	}
		
	function ubah_hutang_ok($hutprm){
		$operator_b1 = array('operator_b1' => "UBAH");
		$this->session->set_userdata($operator_b1);

		$kondisi1 = array('hutprm' => $hutprm);
		$kondisi2 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'PROGRAM'
		);
		
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		
		foreach ($data['daftar_hutang_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}

		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_b1 = array(
				'validasi_b1' => "Pengajuan anggaran lagi di proses, nda boleh ubah-ubah data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_b1);
			
		} else {
			$nilai_master = array('hut_mst_lock' => '1');
			$this->m_db->ubah_data($kondisi1,$nilai_master,$this->TabelHutangMaster);
		}
		
		redirect($this->KePilihanB1);
		$this->kosong_operator_validasi();
	}

/*	function hapus_hutang_detail_ok($hutprm,$t_hut_mst_nobuk){
		$kondisi3 = array('hutprm'=>$hutprm);
		$tabel1 = "hutang_master";
		$tabel2 = "hutang_detail";
		$nilai_detail_hitung = "hut_det_rnc";
		$kondisi1 = array('hut_mst_nobuk' => $t_hut_mst_nobuk);
		$kondisi2 = array('hut_det_nobuk' => $t_hut_mst_nobuk);

		$this->m_db->hapus_data($kondisi3,$tabel2);

		$data['total_rencana_anggaran']=$this->m_db->hitung_data($kondisi2,$nilai_detail_hitung,$tabel2)->result();
		foreach($data['total_rencana_anggaran'] as $tra){
			$t_hut_mst_rnc = $tra->hut_det_rnc;
		}
		$total_rencana = array ('hut_mst_rnc' => $t_hut_mst_rnc);
		$this->m_db->ubah_data($kondisi1,$total_rencana,$tabel1);
		redirect('c_hutang/tambah_hutang/'.$t_hut_mst_nobuk);
	}
 
	function detail_hutang($nobukti){
		$kondisi1 = array('hut_mst_nobuk' => $nobukti);
		$kondisi2 = array('hut_det_nobuk' => $nobukti);
		$tabel1 = "hutang_master";
		$tabel2 = "hutang_detail";
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();
		$data['daftar_hutang_detail'] = $this->m_db->ambil_data_hutang_detail($kondisi1)->result();

		$t_lock = 1;
		$nilai2 = array('hut_det_lock' => $t_lock);
		$nilai1 = array('hut_mst_lock' => $t_lock);

		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();

		foreach ($data['daftar_hutang'] as $h){
			$t_hut_mst_lock = $h->hut_mst_lock;
			$t_hut_mst_sts = $h->hut_mst_sts;
			$t_hut_mst_nobuk = $h->hut_mst_nobuk;
		}

		if ($t_hut_mst_lock != 0){
			$pesan_operator_gagal = array(
				'operator' => "GAGAL=Pengajuan Anggaran Sedang Dalam Proses"
			);
			$this->session->set_userdata($pesan_operator_gagal);
			redirect('c_hutang/index/');
		} else {
			$this->session->unset_userdata('operator');
			$this->m_db->ubah_data($kondisi1,$nilai1,$tabel1);
			$this->m_db->ubah_data($kondisi2,$nilai2,$tabel2);
			$this->load->view('v_hutang_d',$data);
		}
	}

	function detail_hutang_ok(){
		$nobukti = $this->input->post('t_hut_mst_nobuk');
		$t_nama_tombol=$this->input->post('btnKirim');
		$tabel1="hutang_master";
		$tabel2="hutang_detail";
		$tabel3="cek_master";
		$tabel4="cek_detail";
		$kondisi1 = array('hut_mst_nobuk' => $nobukti);
		$kondisi2 = array('hut_det_nobuk' => $nobukti);
		$kondisi3 = array('cek_mst_nobuk' => $nobukti);
		$t_lock0=0;

		$nilai1 = array(
			'hut_mst_lock' => $t_lock0,
		);
		$nilai2 = array(
			'hut_det_lock' => $t_lock0
		);
		$nilai3 = array(
			'hut_mst_sts' => $t_nama_tombol
		);
		$this->m_db->ubah_data($kondisi1,$nilai1,$tabel1);
		$this->m_db->ubah_data($kondisi2,$nilai2,$tabel2);
		if($t_nama_tombol!="BATAL"){
			$this->m_db->ubah_data($kondisi1,$nilai3,$tabel1);

			$data['hutang_master']=$this->m_db->ambil_data($kondisi1,$tabel1)->result();
			foreach($data['hutang_master'] as $cm){
				$t_cek_mst_lock = $t_lock0;
				$t_cek_mst_dt = $cm->hut_mst_dt;
				$t_cek_mst_nobuk = $cm->hut_mst_nobuk;
				$t_cek_mst_sts = $cm->hut_mst_sts;
				$t_cek_mst_tgl = date('Y-m-d');
				$t_cek_mst_pgn = $this->session->userdata('kode');
				$t_cek_mst_ket = strtoupper($this->input->post('t_cek_mst_ket'));
			};

			$data['cek_master']=$this->m_db->ambil_data($kondisi3,$tabel3)->result();
			$nilai4 = array(
				'cek_mst_lock' => $t_cek_mst_lock,
				'cek_mst_dt' => $t_cek_mst_dt,
				'cek_mst_nobuk' => $t_cek_mst_nobuk,
				'cek_mst_sts' => $t_cek_mst_sts,
				'cek_mst_tgl' => $t_cek_mst_tgl,
				'cek_mst_pgn' => $t_cek_mst_pgn,
				'cek_mst_ket' => $t_cek_mst_ket
			);
			$nilai5 = array(
				'cek_det_lock' => $t_cek_mst_lock,
				'cek_det_dt' => $t_cek_mst_dt,
				'cek_det_nobuk' => $t_cek_mst_nobuk,
				'cek_det_tgl' => $t_cek_mst_tgl,
				'cek_det_sts' => $t_cek_mst_sts
			);
			
			if(empty($data['cek_master'])){	
				$this->m_db->tambah_data($nilai4,$tabel3);
			} else {
				$this->m_db->ubah_data($kondisi3,$nilai4,$tabel3);
			}
			
			$this->m_db->tambah_data($nilai5,$tabel4);
		}
		redirect('c_hutang/index/');

	}
*/
}