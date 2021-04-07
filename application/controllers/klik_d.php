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
		$this->TabelPeriksaMaster = "periksa_master";
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
		
		$kondisi = array('hutprm' => $hutprm);
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi)->result();
		
		foreach ($data['daftar_hutang_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}

		if ($t_hut_mst_lock != 0 || ($t_hut_mst_sts != 'BARU' && $t_hut_mst_sts != 'SETUJU' && $t_hut_mst_sts != 'TOLAK')){
			$validasi_d1 = array(
				'validasi_d1' => "Pengajuan ini sudah selesai verifikasi, nda boleh di ubah-ubah lagi..."
			);
			$this->session->set_userdata($validasi_d1);
			redirect($this->KePilihanD1);
			
		} else {				
			$nilai_master = array('hut_mst_lock' => '1');
			$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
			$this->load->view($this->FormD1,$data);
		}
		$this->kosong_operator_validasi();

	}
	
	function ubah_hutang_ok(){
		if (!empty($this->input->post('hutprm'))){
			$kondisi = array('hutprm' => $this->input->post('hutprm'));
			$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi)->result();
			
			foreach ($data['daftar_hutang_master'] as $hm){
				$t_hut_mst_lock = $hm->hut_mst_lock;
				$t_hut_mst_sts = $hm->hut_mst_sts;
				$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
			}
			
			if ($this->input->post('btnKirim')!="BATAL"){
				
				$nilai_hutang_master = array(
					'hut_mst_sts' => $this->input->post('btnKirim'),
					'hut_mst_lock' => '0'
				);
				$nilai_periksa_master = array(
					'per_mst_dt' => 'VER',
					'per_mst_nobuk' => $t_hut_mst_nobuk,
					'per_mst_sts' => $this->input->post('btnKirim'),
					'per_mst_tgl' => date('Y-m-d'),
					'per_mst_pst' => $this->session->userdata('kode'),
					'per_mst_ket' => $this->input->post('t_cek_mst_ket')
				);
				
				switch ($this->input->post('btnKirim')){
					case "TOLAK":
						$this->form_validation->set_rules('t_cek_mst_ket','CATATAN','required|trim|max_length[2000]');
						$this->form_validation->set_message('required','%s ngga boleh dikosongin kalo ditolak');
						$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');
						
						if($this->form_validation->run() == false){
							$validasi_d1 = array('validasi_d1' => validation_errors('<li>','</li>'));
							$this->session->set_userdata($validasi_d1);
							$nilai_master = array('hut_mst_lock' => '0');
							$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
							redirect($this->KePilihanD1);
						} else {
							$this->m_db->ubah_data($kondisi,$nilai_hutang_master,$this->TabelHutangMaster);
							$this->m_db->tambah_data($nilai_periksa_master,$this->TabelPeriksaMaster);
						}
						break;
					default:
						$this->m_db->ubah_data($kondisi,$nilai_hutang_master,$this->TabelHutangMaster);
						$this->m_db->tambah_data($nilai_periksa_master,$this->TabelPeriksaMaster);
						break;
				}
			}
			$nilai_master = array('hut_mst_lock' => '0');
			$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
			redirect($this->KePilihanD1);
		} else {
			$validasi_d1 = array('validasi_d1' => 'data masih kosong, belum pencet "detail"');
			$this->session->set_userdata($validasi_d1);
			redirect($this->KePilihanD1);
		}
	}
	
	function proses_hutang_ok(){
		$kondisi = array('hutprm' => $this->input->post('hutprm'));
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		if (!empty($data['daftar_hutang_master'])) {
			foreach ($data['daftar_hutang_master'] as $hm){
				$nama_file = $hm->hut_mst_dok;
				$lokasi_file = './berkas/unggah/'.$hm->hut_mst_dok;
				force_download($lokasi_file,NULL);
			}
		} else {
			$validasi_d1 = array('validasi_d1' => 'unduhan kosong, belum pencet "detail"');
			$this->session->set_userdata($validasi_d1);
			redirect($this->KePilihanD1);
		}
	}
		
	
}