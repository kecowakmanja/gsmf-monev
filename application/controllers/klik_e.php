<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class klik_e extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->FormE1 = "daftar_e1";
		$this->KePilihanE1 = "klik_e/pilihan_e1";
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
			redirect($this->KePilihanE1);
		}
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_e1');
		$this->session->unset_userdata('validasi_e1');
	}

	function pilihan_e1(){
		$kondisi1 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'hut_mst_sts' => 'SETUJU'
		);
		
		$kondisi2 = array(
			'rek_mst_kel' => 'NERACA',
			'rek_mst_gol' => 'ASET',
			'rek_mst_sub_gol' => 'ASETLANCAR',
		);

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormE1,$data);
		$this->kosong_operator_validasi();
	}


	function tambah_program_ok(){	
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
				'upload_path' => './berkas/unggah/',
				'allowed_types' => 'doc|docx',
				'max_size' => 20480,
				'overwrite' => true,
				'file_name' => $this->input->post('t_hut_mst_nobuk')
				);
				
			$this->load->library('upload', $konfigurasi);
			
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
				if (!$this->upload->do_upload('t_hut_mst_doc')){
					$validasi_e1 = array(
						'validasi_e1' => "Unggah proposal ga berhasil, hanya bisa file doc/docx"
					);
					$this->session->set_userdata($validasi_e1);
					redirect($this->KePilihane1);
					$this->kosong_operator_validasi();
				}
				
				$nilai_master = array(
					'hut_mst_lock' => '0',
					'hut_mst_dt' => 'AGR',
					'hut_mst_nobuk' => $this->input->post('t_hut_mst_nobuk'),
					'hut_mst_sts' => 'BARU',
					'hut_mst_tgl' => date('Y-m-d'),
					'hut_mst_tglrnc' => $this->input->post('t_hut_mst_tglrnc'),
					'hut_mst_pst' => $this->session->userdata('kode'),
					'hut_mst_kel' => $this->session->userdata('kelompok'),
					'hut_mst_rek' => $this->input->post('t_hut_mst_rek'),
					'hut_mst_rnc' => $this->input->post('t_hut_mst_rnc'),
					'hut_mst_ket' => trim(strtoupper($this->input->post('t_hut_mst_ket'))),
					'hut_mst_dok' => $this->upload->data('file_name')
				);
				
				
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelHutangMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
						break;
					default:
						redirect($this->KePilihane1);
						break;
				}
			} else {
					$validasi_e1 = array('validasi_e1' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_e1);
			}
		}
		
		$nilai_master = array('hut_mst_lock' => '0');
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		redirect($this->KePilihane1);

	}

	function tambah_rutin_ok(){	
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
				'upload_path' => './berkas/unggah/',
				'allowed_types' => 'jpg|jpeg|png|gif|tiff|bmp',
				'max_size' => 20480,
				'overwrite' => true,
				'file_name' => $this->input->post('t_hut_mst_nobuk')
				);
				
			$this->load->library('upload', $konfigurasi);
			
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
				if (!$this->upload->do_upload('t_hut_mst_doc')){
					$validasi_b2 = array(
						'validasi_b2' => "Unggah foto nota ga berhasil, hanya bisa file jpg/jpeg/png/gif/tiff/bmp"
					);
					$this->session->set_userdata($validasi_b2);
					redirect($this->KePilihanB2);
					$this->kosong_operator_validasi();
				}
				
				$nilai_master = array(
					'hut_mst_lock' => '0',
					'hut_mst_dt' => 'AGR',
					'hut_mst_nobuk' => $this->input->post('t_hut_mst_nobuk'),
					'hut_mst_sts' => 'BARU',
					'hut_mst_tgl' => date('Y-m-d'),
					'hut_mst_tglrnc' => $this->input->post('t_hut_mst_tglrnc'),
					'hut_mst_pst' => $this->session->userdata('kode'),
					'hut_mst_kel' => $this->session->userdata('kelompok'),
					'hut_mst_rek' => $this->input->post('t_hut_mst_rek'),
					'hut_mst_rnc' => $this->input->post('t_hut_mst_rnc'),
					'hut_mst_ket' => trim(strtoupper($this->input->post('t_hut_mst_ket'))),
					'hut_mst_dok' => $this->upload->data('file_name')
				);
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelHutangMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
						break;
					default:
						redirect($this->KePilihanB2);
						break;
				}
			} else {
					$validasi_b2 = array('validasi_b2' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_b2);
			}
		}
		
		$nilai_master = array('hut_mst_lock' => '0');
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		redirect($this->KePilihanB2);

	}

	function hapus_program_ok($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$data['daftar_program_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		foreach ($data['daftar_program_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}
		
		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_e1 = array(
				'validasi_e1' => "Pengajuan anggaran lagi di proses, nda boleh hapus data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_e1);
		} else {
			$this->m_db->hapus_data($kondisi,$this->TabelHutangMaster);
		}
		redirect($this->KePilihane1);
		$this->kosong_operator_validasi();
	}
	
	function hapus_rutin_ok($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$data['daftar_rutin_master'] = $this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		foreach ($data['daftar_rutin_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}
		
		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_b2 = array(
				'validasi_b2' => "Pengajuan anggaran lagi di proses, nda boleh hapus data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_b2);
		} else {
			$this->m_db->hapus_data($kondisi,$this->TabelHutangMaster);
		}
		redirect($this->KePilihanB2);
		$this->kosong_operator_validasi();
	}
		
	function ubah_program_ok($hutprm){
		$operator_e1 = array('operator_e1' => "UBAH");
		$this->session->set_userdata($operator_e1);

		$kondisi1 = array('hutprm' => $hutprm);
		$kondisi2 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'PROGRAM'
		);
		
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_program_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		
		foreach ($data['daftar_program_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}

		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_e1 = array(
				'validasi_e1' => "Pengajuan anggaran lagi di proses, nda boleh ubah-ubah data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_e1);
			redirect($this->KePilihane1);
			
		} else {
			$nilai_master = array('hut_mst_lock' => '1');
			$this->m_db->ubah_data($kondisi1,$nilai_master,$this->TabelHutangMaster);
			$this->load->view($this->Forme1,$data);
		}
		
		$this->kosong_operator_validasi();
	}
	
	function ubah_rutin_ok($hutprm){
		$operator_b2 = array('operator_b2' => "UBAH");
		$this->session->set_userdata($operator_b2);

		$kondisi1 = array('hutprm' => $hutprm);
		$kondisi2 = array(
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA',
			'rek_mst_kode' => 'RUTIN'
		);
		
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rutin_master'] = $this->m_db->ambil_data_hutang($kondisi1)->result();
		
		foreach ($data['daftar_rutin_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}

		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$validasi_b2 = array(
				'validasi_b2' => "Pengajuan anggaran lagi di proses, nda boleh ubah-ubah data yang sudah masuk..."
			);
			$this->session->set_userdata($validasi_b2);
			redirect($this->KePilihanB2);
			
		} else {
			$nilai_master = array('hut_mst_lock' => '1');
			$this->m_db->ubah_data($kondisi1,$nilai_master,$this->TabelHutangMaster);
			$this->load->view($this->FormB2,$data);
		}
		
		$this->kosong_operator_validasi();
	}

}