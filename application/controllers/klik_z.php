<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class klik_z extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		$this->FormAwal = "daftar_z0.php";
		$this->FormDaftar = "daftar_z1.php";
		$this->TabelPesertaMaster = "peserta_master";
	}
 
	function index(){
		if($this->session->userdata('status')=="masuk"){
			$this->load->view($this->FormDaftar);
		} else{		
		$this->load->view($this->FormAwal);
		}
	}	

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_a1');
		$this->session->unset_userdata('validasi_a1');
		$this->session->unset_userdata('operator_a2');
		$this->session->unset_userdata('validasi_a2');
		$this->session->unset_userdata('operator_z1');
		$this->session->unset_userdata('validasi_z1');
	}

	function kulonuwun(){
		$this->kosong_operator_validasi();

		$kondisi = array(
			'pst_mst_kode' => $this->input->post('t_pst_mst_kode'),
			'pst_mst_pswd' => MD5($this->input->post('t_pst_mst_pswd')),
			'pst_mst_sts' => "AKTIF"
		);
		
		$data['daftar_peserta_master'] = $this->m_db->ambil_data($kondisi,$this->TabelPesertaMaster)->result();
	
		if (empty($data['daftar_peserta_master'])){
			$validasi_z0 = array('validasi_z0' => "Kombinasi PENGGUNA dan KATA KUNCI nda cocok tuh...");
			$this->session->set_userdata($validasi_z0);
			redirect('klik_z/index');
		}
		else {
		foreach ($data['daftar_peserta_master'] as $pm){
			$cek_prm = $pm->pgnprm;
			$cek_kode = $pm->pst_mst_kode;
			$cek_kel = $pm->pst_mst_kel;
			$cek_hak = $pm->pst_mst_hak;
			$cek_nm = $pm->pst_mst_nm;
		}
			
		$datamasuk = array(
			'nama' => $cek_nm,
			'kode' => $cek_kode,
			'kelompok' => $cek_kel,
			'hak' => $cek_hak,
			'tgl_masuk' => date('Y-m-d'),
			'jam_masuk' => date('H:i:s'),
			'prm' => $cek_prm,
			'status' => "masuk"
		);
		$this->session->unset_userdata('validasi');
		$this->session->set_userdata($datamasuk);
		redirect('klik_z/index');
		}
	}

	function kepareng(){
		$this->session->sess_destroy();
		redirect('klik_z/index');
	}
}