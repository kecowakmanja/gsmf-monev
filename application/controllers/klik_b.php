<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_b extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->FormB1 = "daftar_b1";
		$this->KePilihanB1 = "klik_b/pilihan_b1";
		$this->KePilihanZ1 = "klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if(($this->session->userdata('hak') == "PENGAWAS") || ($this->session->userdata('hak') == "PELAKSANA")){
			$validasi_z1 = array('validasi_z1' => "Maaf anda nda boleh masuk laman ini...");
			$this->session->set_userdata($validasi_z1);
			redirect($this->KePilihanZ1);
		} else {
			redirect($this->KePilihanB1);
		}
		
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_b1');
		$this->session->unset_userdata('validasi_b1');
	}

	function pilihan_b1(){
		if($this->session->userdata('hak')=="PEMILIK"){
			$kondisi1 = array(
				'rek_mst_sts' => 'AKTIF',
				'rek_mst_kel' => 'ANGGARAN',
				'rek_mst_gol' => 'ABTT',
				'rek_mst_sub_gol' => 'BIAYA'
			);
		}
		else{
			$kondisi1 = array(
				'hut_mst_kel' => $this->session->userdata('kelompok'),
				'rek_mst_sts' => 'AKTIF',
				'rek_mst_kel' => 'ANGGARAN',
				'rek_mst_gol' => 'ABTT',
				'rek_mst_sub_gol' => 'BIAYA'
			);
		};

		$kondisi2 = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA'
		);
		
		$kelompok = 'rek_mst_sts,rek_mst_kel,rek_mst_gol,rek_mst_sub_gol,rek_mst_kode';

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data_kelompok($kondisi2,$kelompok,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormB1,$data);
		$this->kosong_operator_validasi();
	}

	function tambah_hutang_ok(){	
		if ($this->input->post('btnKirim')!="BATAL"){
			$prefix1 = 'AGR';
			$prefix2 = date('Ymd');
			$prefix3 = date('Y-m-d');
			$prm1 = 'hut_mst_dt';
			$prm2 = 'hut_mst_nobuk';
			$prm3 = 'hut_mst_tgl';
			$separator = "-";
			$t_hut_mst_nobuk = '';

			$data['no_acak'] = $this->m_db->ambil_data_urut($this->TabelHutangMaster,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3)->result();
			if (empty($data['no_acak'])){ //empty karna blm ada record
				$data['no_acak'] = trim(strtoupper($prefix1.$separator.$prefix2.$separator.str_pad(floor(rand(0,99999)),5,"0",STR_PAD_LEFT)));
			}
			
			$t_hut_mst_nobuk = $data['no_acak'];

			switch ($this->input->post('t_hut_jenis')){
				case "PROGRAM":
					$konfigurasi = array (
						'upload_path' => './berkas/unggah/',
						'allowed_types' => 'doc|docx',
						'max_size' => 20480,
						'overwrite' => true,
						'file_name' => $t_hut_mst_nobuk
						);
					break;
					
				case "RUTIN":					
					$konfigurasi = array (
						'upload_path' => './berkas/unggah/',
						'allowed_types' => 'jpg|jpeg|png|gif|tiff|bmp',
						'max_size' => 20480,
						'overwrite' => true,
						'file_name' => $t_hut_mst_nobuk
						);		
					break;
					
				default:
					$validasi_b1 = array(
						'validasi_b1' => "jenis kegiatan tidak terdaftar atau belum di pilih"
					);
					$this->session->set_userdata($validasi_b1);
					redirect($this->KePilihanB1);
					$this->kosong_operator_validasi();
					break;
			}
			$this->load->library('upload', $konfigurasi);
			
			$this->form_validation->set_rules('t_hut_mst_tglrnc','TANGGAL PELAKSANAAN KEGIATAN','required');
			$this->form_validation->set_rules('t_hut_mst_rek','REKENING BEBAN','required');
			$this->form_validation->set_rules('t_hut_mst_ket','NAMA KEGIATAN','required|max_length[2000]');
			$this->form_validation->set_rules('t_hut_mst_rnc','RENCANA ANGGARAN','required|greater_than[0]');
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('greater_than','%s pengajuan anggarannya harus lebih dari 0');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			if($this->form_validation->run() != false){
				if (!$this->upload->do_upload('t_hut_mst_doc')){
					$validasi_b1 = array(
						'validasi_b1' => "Unggah proposal ga berhasil, PROGRAM=berkas doc/docx, BIAYA RUTIN=berkas jpeg"
					);
					$this->session->set_userdata($validasi_b1);
					redirect($this->KePilihanB1);
					$this->kosong_operator_validasi();
				}
				
				$nilai_master = array(
					'hut_mst_lock' => '0',
					'hut_mst_dt' => 'AGR',
					'hut_mst_nobuk' => $t_hut_mst_nobuk,
					'hut_mst_sts' => 'BARU',
					'hut_mst_tgl' => date('Y-m-d'),
					'hut_mst_tglrnc' => $this->input->post('t_hut_mst_tglrnc'),
					'hut_mst_pst' => $this->session->userdata('kode'),
					'hut_mst_kel' => $this->session->userdata('kelompok'),
					'hut_mst_rek' => $this->input->post('t_hut_mst_rek'),
					'hut_mst_rnc' => $this->input->post('t_hut_mst_rnc'),
					'hut_mst_ttl' => '0',
					'hut_mst_ket' => trim(strtoupper($this->input->post('t_hut_mst_ket'))),
					'hut_mst_dok' => $this->upload->data('file_name')
				);
				
				$this->m_db->tambah_data($nilai_master,$this->TabelHutangMaster);
			} else {
					$validasi_b1 = array('validasi_b1' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_b1);
			}
		}
		redirect($this->KePilihanB1);
	}

	function hapus_hutang_ok($hutprm){
		$kondisi = array(
			'hutprm' => $hutprm,
			'hut_mst_sts' => 'BARU',
			'hut_mst_lock' => '0'
		);
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		if (empty($data['daftar_hutang_master'])){
			$validasi_b1 = array(
				'validasi_b1' => "Pengajuan anggaran sudah selesai di proses, nda boleh hapus data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_b1);
		} else {
			$this->m_db->hapus_data($kondisi,$this->TabelHutangMaster);
		}
		redirect($this->KePilihanB1);
		$this->kosong_operator_validasi();
	}
	
	function cari_rek(){
		$kondisi = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => $this->input->post('t_kode_rek')
		);
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi,$this->TabelRekeningMaster)->result();
	
		$t_rek_mst_kode[""] = "Pilihan sub-golongan rekening...";	
		foreach($data['daftar_rekening_master'] as $rm){
			$t_rek_mst_kode[$rm->rek_mst_sub_kode] = $rm->rek_mst_ket_sub_kode;
		}
		echo json_encode($t_rek_mst_kode);
	}

}