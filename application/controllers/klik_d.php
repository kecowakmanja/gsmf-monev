<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class klik_d extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->FormD1 = "daftar_d1";
		$this->KePilihanD1 = "klik_d/pilihan_d1";
		$this->KePilihanZ1 = "klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if($this->session->userdata('hak') == "PEMAKAI"){
			$validasi_z1 = array('validasi_z1' => "Maaf anda nda boleh masuk laman ini...");
			$this->session->set_userdata($validasi_z1);
			redirect($this->KePilihanZ1);
		} else {
			redirect($this->KePilihanD1);
		}
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_d1');
		$this->session->unset_userdata('validasi_d1');
	}

	function pilihan_d1(){
		$kondisi1 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
		);
		
		$kondisi2 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'PROGRAM'
		);

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormD1,$data);
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
*/
 
	function detail_hutang_ok($hutprm){
		$operator_d1 = array('operator_d1' => "UBAH");
		$this->session->set_userdata($operator_d1);
		
		$kondisi1 = array('hutprm' => $hutprm);
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$this->load->view($this->FormD1,$data);

	}

/*
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