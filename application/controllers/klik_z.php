<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_z extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		$this->FormAwal = "daftar_z0.php";
		$this->FormDaftar = "daftar_z1.php";
		$this->TabelPesertaMaster = "peserta_master";
		$this->KePilihanZ0 = "klik_z/index";
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
		
		$data['daftar_peserta_master'] = $this->m_db->ambil_data_peserta($kondisi,$this->TabelPesertaMaster)->result();
	
		if (empty($data['daftar_peserta_master'])){
			$validasi_z0 = array('validasi_z0' => "KODE dan KATA KUNCI nda cocok tuh");
			$this->session->set_userdata($validasi_z0);
			redirect($this->KePilihanZ0);
		}
		else {
		foreach ($data['daftar_peserta_master'] as $pm){
			$cek_prm = $pm->pstprm;
			$datamasuk = array(
				'nama' => $pm->pst_mst_nm,
				'kode' => $pm->pst_mst_kode,
				'kelompok' => $pm->pst_mst_kel,
				'nmkel' => $pm->kel_mst_subket,
				'hak' => $pm->pst_mst_hak,
				'tgl_masuk' => date('Y-m-d'),
				'jam_masuk' => date('H:i:s'),
				'prm' => $pm->pstprm,
				'status' => 'masuk'
			);
		}
		
		$this->session->set_userdata($datamasuk);
		
		$kondisi = array('pstprm' => $cek_prm);
		$nilai_master = array('pst_mst_lock' => '1');
			
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelPesertaMaster);
		$this->session->unset_userdata('validasi');
		
		redirect($this->KePilihanZ0);
		}
	}

	function kepareng(){
		$kondisi = array('pstprm' => $this->session->userdata('prm'));
		$nilai_master = array('pst_mst_lock' => '0');
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelPesertaMaster);
		$this->session->sess_destroy();
		redirect($this->KePilihanZ0);
	}
	
	function njenengan(){
		$kondisi = array(
			'pstprm' => $this->input->post('pstprm')
		);
		$data['daftar_peserta_master'] = $this->m_db->ambil_data_peserta($kondisi,$this->TabelPesertaMaster)->result();
		
		foreach($data['daftar_peserta_master'] as $pm){
			$t_pst_mst[] = array(
				'pstprm' => $pm->pstprm,
				'pstkode' => $pm->pst_mst_kode,
				'pstnm' => $pm->pst_mst_nm,
				'pstkel' => $pm->kel_mst_subket,
				'psthak' => $pm->pst_mst_hak,
				'kelsubket' => $pm->kel_mst_subket
			);
		}
		echo json_encode($t_pst_mst);
		
	}
	
	function ngubah(){
		$kondisi = array(
			'pstprm' => $this->input->post('t_pstprm')
		);
		
		$nilai = array(
			'pst_mst_pswd' => MD5($this->input->post('t_pstpswd'))
		);
		
		if ($this->input->post('btnKirim')=="UBAH"){
			$this->m_db->ubah_data($kondisi,$nilai,$this->TabelPesertaMaster);
		}
		redirect($this->KePilihanZ0);
	}
}