<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_d extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->TabelPeriksaMaster = "periksa_master";
		$this->FormD1 = "daftar_d1";
		$this->FormD2 = "daftar_d2";
		$this->KePilihanD1 = "klik_d/pilihan_d1";
		$this->KePilihanD2 = "klik_d/pilihan_d2";
		$this->KePilihanZ1 = "klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if(($this->session->userdata('hak') == "PEMAKAI") || ($this->session->userdata('hak') == "PELAKSANA")){
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
		$data = array();
		
		$kondisi1 = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA'
		);
		
		$kondisi2 = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'PROGRAM'
		);

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang_periksa($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormD1,$data);
		$this->kosong_operator_validasi();
	}
	
	function pilihan_d2(){
		$data = array();
		
		$kondisi = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA'
		);
		
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang_periksa_selesai($kondisi)->result();
		$this->load->view($this->FormD2,$data);
		$this->kosong_operator_validasi();
	}
	
	function detail_hutang_ok(){
		$operator_d1 = array('operator_d1' => "UBAH");
		$this->session->set_userdata($operator_d1);
		
		$kondisi = array(
			'hutprm' => $this->input->post('hutprm'),
			'hut_mst_lock' => $this->input->post('hutlock')
			);
			
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi)->result();
		
		if(!empty($data['daftar_hutang_master'])){
			foreach ($data['daftar_hutang_master'] as $hm){				
				$t_hut_mst[] = array(
					'hutprm' => $hm->hutprm,
					'hutnobuk' => $hm->hut_mst_nobuk,
					'huttgl' => $hm->hut_mst_tgl,
					'huttglrnc' => $hm->hut_mst_tglrnc,
					'hutpst' => $hm->pst_mst_nm,
					'hutkel' => $hm->kel_mst_subket,
					'hutrnc' => 'Rp. '.number_format($hm->hut_mst_rnc,2,",","."),
					'hutrek' => $hm->rek_mst_ket_sub_kode,
					'hutket' => $hm->hut_mst_ket,
				);
			}
			
			$nilai_master = array('hut_mst_lock' => '1');
			$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
			
		} else {
			$t_hut_mst[] = array();
		}

		echo json_encode($t_hut_mst);
	}
	
	function ubah_hutang_ok(){
		if (!empty($this->input->post('t_hutprm'))){
			$kondisi = array(
				'hutprm' => $this->input->post('t_hutprm'),
				'hut_mst_lock' => '1'
			);
			
			$t_hut_mst_nobuk = $this->input->post('t_hut_mst_nobuk');
			
			$nilai_master = array(
				'hut_mst_lock' => '0'
				);
			
			$nilai_hutang_master = array(
				'hut_mst_lock' => '0',
				'hut_mst_sts' => $this->input->post('btnKirim')
			);
			
			$nilai_periksa_master = array(
				'per_mst_dt' => 'VER',
				'per_mst_nobuk' => $t_hut_mst_nobuk,
				'per_mst_sts' => $this->input->post('btnKirim'),
				'per_mst_tgl' => date('Y-m-d'),
				'per_mst_pst' => $this->session->userdata('kode'),
				'per_mst_ket' => strtoupper($this->input->post('t_cek_mst_ket'))
			);
			
			switch ($this->input->post('btnKirim')){
				case "TOLAK":
					$this->form_validation->set_rules('t_cek_mst_ket','CATATAN','required|trim|max_length[2000]');
					$this->form_validation->set_message('required','%s ngga boleh dikosongin kalo ditolak');
					$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');
					
					if($this->form_validation->run() == false){
						$validasi_d1 = array('validasi_d1' => validation_errors('<li>','</li>'));
						$this->session->set_userdata($validasi_d1);
					} else {
						$this->m_db->tambah_data($nilai_periksa_master,$this->TabelPeriksaMaster);
						$this->m_db->ubah_data($kondisi,$nilai_hutang_master,$this->TabelHutangMaster);
					}
					break;
				case "SETUJU":
					$this->m_db->tambah_data($nilai_periksa_master,$this->TabelPeriksaMaster);
					$this->m_db->ubah_data($kondisi,$nilai_hutang_master,$this->TabelHutangMaster);
					break;
			}
			$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		}
		
		switch ($this->input->post('btnKirim')){
			case "TUTUP":
				redirect($this->KePilihanD2);
				break;
			default:
				redirect($this->KePilihanD1);
				break;
		}
		$this->kosong_operator_validasi();
	}
	
	function unduh_hutang_ok($hutprm){
		if (!empty($hutprm)){
			$kondisi = array(
				'hutprm' => $hutprm,
			);
			
			$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
			if (!empty($data['daftar_hutang_master'])) {
				foreach ($data['daftar_hutang_master'] as $hm){
					$nama_file = $hm->hut_mst_dok;
					$lokasi_file = './berkas/unggah/'.$hm->hut_mst_dok;
					force_download($lokasi_file,NULL);
				}
			}
		}
	}

	function detail_verifikasi_ok(){
		$kondisi = array(
			'per_mst_nobuk' => $this->input->post('per_mst_nobuk'),
			);
			
		$data['daftar_periksa_master'] = $this->m_db->ambil_data($kondisi,$this->TabelPeriksaMaster)->result();
		
		if(!empty($data['daftar_periksa_master'])){
			foreach ($data['daftar_periksa_master'] as $pm){				
				$t_per_mst[] = array(
					'pernobuk' => $pm->per_mst_nobuk,
					'pertgl' => $pm->per_mst_tgl,
					'persts' => $pm->per_mst_sts,
					'perket' => $pm->per_mst_ket
				);
			}
		} else {
			$t_per_mst[] = array();
		}

		echo json_encode($t_per_mst);
	}		
	
}