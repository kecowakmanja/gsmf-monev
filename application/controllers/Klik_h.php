<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_h extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelRekeningMaster="rekening_master";
		$this->FormH1="daftar_h1";
		$this->KePilihanH1="klik_h/pilihan_h1";
		$this->KePilihanZ1="klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if($this->session->userdata('hak') == "PEMAKAI"){
			$validasi_z1=array('validasi_z1'=>"Maaf anda nda boleh masuk laman ini...");
			$this->session->set_userdata($validasi_z1);
			redirect($this->KePilihanZ1);
		} else {
			redirect($this->KePilihanH1);
		}
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_h1');
		$this->session->unset_userdata('validasi_h1');
	}

	function pilihan_h1(){
        $kondisi=array(
            'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
        );

        $data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi,$this->TabelRekeningMaster)->result();

		$this->load->view($this->FormH1,$data);
		$this->kosong_operator_validasi();
	}

	
}