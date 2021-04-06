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
 
	function detail_hutang_ok($hutprm){
		$operator_d1 = array('operator_d1' => "UBAH");
		$this->session->set_userdata($operator_d1);
		
		$kondisi1 = array('hutprm' => $hutprm);
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$this->load->view($this->FormD1,$data);
		
		$this->kosong_operator_validasi();

	}
	
	function ubah_hutang_ok(){
		$kondisi = array('hutprm' => $this->input->post('hutprm'));
		
		if ($this->input->post('btnKirim')!="BATAL"){
			echo "stop dulu";
		}
		
		$nilai_master = array('hut_mst_lock' => '0');
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		redirect($this->KePilihanD1);
	}
	
}