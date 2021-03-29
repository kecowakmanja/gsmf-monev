<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class C_kas extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		if($this->session->userdata('status')!="masuk"){
			redirect('c_depan/index');
		} 
	}

	function index(){
		if (($this->session->userdata('kelompok') == "ROOT") or ($this->session->userdata('kelompok') == "BENDAHARA")){
			redirect('c_kas/daftar_kas');
		}
		else {
			redirect('c_kas/gagal_masuk');
		}
	}

	function daftar_kas(){		
		$kondisi1 = array('rekgol' => "1", 'reksts' => "AKTIF");
		$kondisi7 = array('rekgol' => "7", 'reksts' => "AKTIF");
		$tabel = "rekening";
		$data['daftar_rekening_kas'] = $this->m_db->ambil_data($kondisi1,$tabel)->result();
		$data['daftar_rekening_beban'] = $this->m_db->ambil_data($kondisi7,$tabel)->result();
		$data['daftar_kas'] = $this->m_db->ambil_data_kas()->result();
		$this->load->view('v_kas',$data);
	}

	function daftar_kas_saring(){
		$c_mtssts = $this->input->post('c_mtssts');
		$c_mtstgl = $this->input->post('c_mtstgl');
		$c_mtsrekprm = $this->input->post('c_mtsrekprm');
		$c_hutrekprm = $this->input->post('c_hutrekprm');

		$c_saring = array(
			'mtssts' => $c_mtssts,
			'mtstgl' => $c_mtstgl,
			'mtsrekprm' => $c_mtsrekprm,
			'hutrekprm' => $c_hutrekprm
		);
		
		$kondisi1 = array('rekgol' => "1", 'reksts' => "AKTIF");
		$kondisi7 = array('rekgol' => "7", 'reksts' => "AKTIF");
		$tabel = "rekening";
		$data['daftar_rekening_kas'] = $this->m_db->ambil_data($kondisi1,$tabel)->result();
		$data['daftar_rekening_beban'] = $this->m_db->ambil_data($kondisi7,$tabel)->result();
		$data['daftar_kas'] = $this->m_db->ambil_data_kas_saring($c_saring)->result();
		$this->load->view('v_kas',$data);
	}

	function gagal_masuk(){
		$t_pesan = "PENGGUNA TIDAK BOLEH MASUK LAMAN INI";
		echo "<script>
		alert('$t_pesan');
		location.href='".base_url()."index.php';
		</script>";
	}
 
}