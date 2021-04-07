<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class klik_a extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelKelompokMaster = "kelompok_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->TabelInfoLevel1 = "info_level_1";
		$this->TabelInfoLevel2 = "info_level_2";
		$this->TabelInfoLevel3 = "info_level_3";
		$this->TabelInfoLevel4 = "info_level_4";
		$this->FormA1 = "daftar_a1";
		$this->FormA2 = "daftar_a2";
		$this->FormA3 = "daftar_a3";
		$this->KePilihanA1 = "klik_a/pilihan_a1";
		$this->KePilihanA2 = "klik_a/pilihan_a2";
		$this->KePilihanA3 = "klik_a/pilihan_a3";
		$this->KePilihanZ1 = "klik_z/index";
		
		if($this->session->userdata('status') != "masuk"){
			redirect($this->KePilihanZ1);
		}
	}

	function index(){
		if($this->session->userdata('hak') != "PEMILIK"){
			$validasi_z1 = array('validasi_z1' => "Maaf anda nda boleh masuk laman ini...");
			$this->session->set_userdata($validasi_z1);
			redirect($this->KePilihanZ1);
		} else {
			redirect($this->KePilihanA1);
		}
		
	}	

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_a1');
		$this->session->unset_userdata('validasi_a1');
		$this->session->unset_userdata('operator_a2');
		$this->session->unset_userdata('validasi_a2');
		$this->session->unset_userdata('operator_a3');
		$this->session->unset_userdata('validasi_a3');
	}

	function pilihan_a1(){
		$kondisi1 = "1=1";
		$kondisi2 = "in_lv_1_dt = 'STATUS'";
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data($kondisi1,$this->TabelKelompokMaster)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		
		$this->load->view($this->FormA1,$data);
		$this->kosong_operator_validasi();
	}

	function pilihan_a2(){
		$kondisi1 = "1=1";
		$kondisi2 = "in_lv_1_dt = 'STATUS'";
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data($kondisi1,$this->TabelKelompokMaster)->result();
		$data['daftar_peserta_master'] = $this->m_db->ambil_data_peserta($kondisi1,$this->TabelPesertaMaster)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		
		$this->load->view($this->FormA2,$data);
		$this->kosong_operator_validasi();
	}

	function pilihan_a3(){
		$kondisi1 = "in_lv_1_dt = 'REKENING'";
		$kondisi2 = "in_lv_1_dt = 'STATUS'";
		$kondisi3 = "1=1";
		$data['daftar_info_level_1_rek'] = $this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		
		$this->load->view($this->FormA3,$data);
		$this->kosong_operator_validasi();
	}
	
	function tambah_kelompok_ok(){
		if ($this->input->post('btnKirim')!="BATAL"){
			$_POST['t_kel_mst_kode2'] = $this->input->post('t_kel_mst_kode').$this->input->post('t_kel_mst_subkode');
			$this->form_validation->set_rules('t_kel_mst_sts','STATUS','required');
			$this->form_validation->set_rules('t_kel_mst_ket','NAMA','required|max_length[2000]');
			$this->form_validation->set_rules('t_kel_mst_subket','SUBNAMA','required|max_length[2000]');
			$this->form_validation->set_rules('t_kel_mst_kode','KODE','required|trim|max_length[20]');
			if ($this->input->post('btnKirim')=="TAMBAH"){
				$this->form_validation->set_rules('t_kel_mst_kode2','SUBKODE','required|trim|max_length[20]|is_unique['.$this->TabelKelompokMaster.'.kel_mst_subkode]');
			}
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba ganti yang lain deh');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			if($this->form_validation->run() != false){
				$nilai_master = array(
					'kel_mst_kode' => trim(strtoupper($this->input->post('t_kel_mst_kode'))),
					'kel_mst_subkode' => trim(strtoupper($this->input->post('t_kel_mst_kode').$this->input->post('t_kel_mst_subkode'))),
					'kel_mst_sts' => trim(strtoupper($this->input->post('t_kel_mst_sts'))),
					'kel_mst_ket' => trim(strtoupper($this->input->post('t_kel_mst_ket'))),
					'kel_mst_subket' => trim(strtoupper($this->input->post('t_kel_mst_subket')))
				);

				$kondisi = array('kelprm' => $this->input->post('kelprm'));
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelKelompokMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelKelompokMaster);
						break;
					default:
						redirect($this->KePilihanA1);
						break;
				}
			} else {
					$validasi_a1 = array('validasi_a1' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_a1);
			}
			redirect($this->KePilihanA1);
		} else {
			redirect($this->KePilihanA1);
		}
	}

	function tambah_peserta_ok(){
		if ($this->input->post('btnKirim')!="BATAL"){
			$this->form_validation->set_rules('t_pst_mst_sts','STATUS','required');
			$this->form_validation->set_rules('t_pst_mst_hak','HAK','required');
			$this->form_validation->set_rules('t_pst_mst_kel','KELOMPOK','required');
			$this->form_validation->set_rules('t_pst_mst_nm','NAMA','required|max_length[2000]');
			if ($this->input->post('btnKirim')=="TAMBAH"){
				$this->form_validation->set_rules('t_pst_mst_kode','KODE','required|trim|max_length[20]|is_unique['.$this->TabelPesertaMaster.'.pst_mst_kode]');
			}
			$this->form_validation->set_rules('t_pst_mst_pswd','KATA KUNCI','required|trim|max_length[20]');
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba ganti yang lain deh');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			if($this->form_validation->run() != false){
				$nilai_master = array(
					'pst_mst_kode' => trim(strtoupper($this->input->post('t_pst_mst_kode'))),
					'pst_mst_kel' => trim(strtoupper($this->input->post('t_pst_mst_kel'))),
					'pst_mst_hak' => trim(strtoupper($this->input->post('t_pst_mst_hak'))),
					'pst_mst_sts' => trim(strtoupper($this->input->post('t_pst_mst_sts'))),
					'pst_mst_nm' => trim(strtoupper($this->input->post('t_pst_mst_nm'))),
					'pst_mst_pswd' => MD5($this->input->post('t_pst_mst_pswd')),
					'pst_mst_lock' => '0'
				);

				$kondisi = array ('pstprm' => $this->input->post('pstprm'));
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelPesertaMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelPesertaMaster);
						break;
					default:
						redirect($this->KePilihanA2);
						break;
				}
			} else {
					$validasi_a2 = array('validasi_a2' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_a2);
			}
			redirect($this->KePilihanA2);
		} else {
			redirect($this->KePilihanA2);
		}
	}

	function tambah_rekening_ok(){		
		if ($this->input->post('btnKirim')!="BATAL"){
			$this->form_validation->set_rules('t_rek_mst_kel','KELOMPOK','required');
			$this->form_validation->set_rules('t_rek_mst_sts','STATUS','required');
			$this->form_validation->set_rules('t_rek_mst_gol','GOLONGAN','required');
			$this->form_validation->set_rules('t_rek_mst_sub_gol','SUB-GOLONGAN','required');
			$this->form_validation->set_rules('t_rek_mst_kode','KODE','required');
			$this->form_validation->set_rules('t_rek_mst_ket_sub_kode','SUB-KODE KETERANGAN','required|max_length[2000]');
			if ($this->input->post('btnKirim')=="TAMBAH"){
				$this->form_validation->set_rules('t_rek_mst_sub_kode','SUB-KODE','required|trim|max_length[20]|is_unique['.$this->TabelRekeningMaster.'.rek_mst_sub_kode]');
			}
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba ganti yang lain deh');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 20000 karakter');

			if($this->form_validation->run() != false){
				$nilai_master = array(
					'rek_mst_kel' => trim(strtoupper($this->input->post('t_rek_mst_kel'))),
					'rek_mst_sts' => trim(strtoupper($this->input->post('t_rek_mst_sts'))),
					'rek_mst_gol' => trim(strtoupper($this->input->post('t_rek_mst_gol'))),
					'rek_mst_sub_gol' => trim(strtoupper($this->input->post('t_rek_mst_sub_gol'))),
					'rek_mst_kode' => trim(strtoupper($this->input->post('t_rek_mst_kode'))),
					'rek_mst_sub_kode' => trim(strtoupper($this->input->post('t_rek_mst_sub_kode'))),
					'rek_mst_ket_sub_kode' => trim(strtoupper($this->input->post('t_rek_mst_ket_sub_kode'))),
				);

				$kondisi = array ('rekprm' => $this->input->post('rekprm'));
				
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_master,$this->TabelRekeningMaster);
						break;
					case "UBAH":
						$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelRekeningMaster);
						break;
					default:
						redirect($this->KePilihanA3);
						break;
				}
			} else {
					$validasi_a3 = array('validasi_a3' => validation_errors('<li>','</li>'));
					$this->session->set_userdata($validasi_a3);
			}
			redirect($this->KePilihanA3);
		} else {
			redirect($this->KePilihanA3);
		}

	}

	function hapus_kelompok_ok($kelprm){
		$kondisi = array ('kelprm' => $kelprm);
		$this->m_db->hapus_data($kondisi,$this->TabelKelompokMaster);
		redirect($this->KePilihanA1);
	}

	function hapus_peserta_ok($pstprm){
		$kondisi = array ('pstprm' => $pstprm);
		$data['daftar_peserta_master'] = $this->m_db->ambil_data($kondisi,$this->TabelPesertaMaster)->result();
		
		foreach ($data['daftar_peserta_master'] as $pm) {
				$t_pst_mst_lock = $pm->pst_mst_lock;
			}
		
		if($t_pst_mst_lock == '0' ){
			$this->m_db->hapus_data($kondisi,$this->TabelPesertaMaster);
		} else {
			$validasi_a2 = array('validasi_a2' => 'Pemakai ini lagi masuk, nda boleh hapus');
			$this->session->set_userdata($validasi_a2);
		}
		redirect($this->KePilihanA2);
	}

	function hapus_rekening_ok($rekprm){
		$kondisi = array ('rekprm' => $rekprm);
		$this->m_db->hapus_data($kondisi,$this->TabelRekeningMaster);
		redirect($this->KePilihanA3);
	}

	function ubah_kelompok_ok($kelprm){
		$operator_a1 = array('operator_a1' => "UBAH");
		$this->session->set_userdata($operator_a1);

		$kondisi1 = array('kelprm' => $kelprm);
		$kondisi2 = "in_lv_1_dt = 'STATUS'";
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data($kondisi1,$this->TabelKelompokMaster)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		$this->load->view($this->FormA1,$data);

		$this->kosong_operator_validasi();
	}

	function ubah_peserta_ok($pstprm){
		$operator_a2 = array('operator_a2' => "UBAH");
		$this->session->set_userdata($operator_a2);

		$kondisi3 = "in_lv_1_dt = 'STATUS'";
		$kondisi1 = array('pstprm' => $pstprm);
		$kondisi2 = "1=1";
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelKelompokMaster)->result();
		$data['daftar_peserta_master'] = $this->m_db->ambil_data_peserta($kondisi1,$this->TabelPesertaMaster)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi3,$this->TabelInfoLevel1)->result();
		
		$this->load->view($this->FormA2,$data);

		$this->kosong_operator_validasi();
	}

	function ubah_rekening_ok($rekprm){
		$operator_a3 = array('operator_a3' => "UBAH");
		$this->session->set_userdata($operator_a3);

		$kondisi1 = "in_lv_1_dt = 'REKENING'";
		$kondisi2 = "in_lv_1_dt = 'STATUS'";
		$kondisi3 = array('rekprm' => $rekprm);
		$data['daftar_info_level_1_rek'] = $this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_info_level_1_sts'] = $this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormA3,$data);

		$this->kosong_operator_validasi();
	}
	
	function proses_kelompok_ok(){
		switch ($this->input->post('btnProses')){
			case "UNDUH":
				$nama_file = '_templateKelompok.csv';
				$lokasi_file = file_get_contents(base_url().'berkas/unduh/_templateKelompok.csv');
				force_download($nama_file,$lokasi_file);
				break;
			case "PROSES":
				$berkas_sementara = $_FILES['t_kel_csv']['tmp_name'];
				$berkas_aseli = $_FILES['t_kel_csv']['name'];
				$ekstensi_berkas_aseli  = explode('.', $_FILES['t_kel_csv']['name']);
				$ukuran_berkas_aseli = $_FILES['t_kel_csv']['size'];

				if (strtolower(end($ekstensi_berkas_aseli)) === 'csv' && $ukuran_berkas_aseli>0) {
					$baris = 0;
					$proses_berkas = fopen($berkas_sementara, "r");

					while ($kolom = fgetcsv($proses_berkas)) {
						$baris++;
						if ($baris == 1) continue; //untuk skip header csv
						$isi_csv = array(
							'kel_mst_sts' => trim(strtoupper($kolom[0])),
							'kel_mst_kode' => trim(strtoupper($kolom[1])),
							'kel_mst_subkode' => trim(strtoupper($kolom[2])),
							'kel_mst_ket' => trim(strtoupper($kolom[3])),
							'kel_mst_subket' => trim(strtoupper($kolom[4])),
						);
							
						$this->m_db->tambah_data($isi_csv,$this->TabelKelompokMaster);
					}
					fclose($proses_berkas);
				} else {
					$validasi_a1 = array('validasi_a1' => 'Berkas yang di upload bukan file CSV atau isinya kosong...');
					$this->session->set_userdata($validasi_a1);
				}
				redirect($this->KePilihanA1);
				break;
		}
	}
	
	function proses_peserta_ok(){
		switch ($this->input->post('btnProses')){
			case "UNDUH":
				$nama_file = '_templatePeserta.csv';
				$lokasi_file = file_get_contents(base_url().'berkas/unduh/_templatePeserta.csv');
				force_download($nama_file,$lokasi_file);
				break;
			case "PROSES":
				$berkas_sementara = $_FILES['t_pst_csv']['tmp_name'];
				$berkas_aseli = $_FILES['t_pst_csv']['name'];
				$ekstensi_berkas_aseli  = explode('.', $_FILES['t_pst_csv']['name']);
				$ukuran_berkas_aseli = $_FILES['t_pst_csv']['size'];

				if (strtolower(end($ekstensi_berkas_aseli)) === 'csv' && $ukuran_berkas_aseli>0) {
					$baris = 0;
					$proses_berkas = fopen($berkas_sementara, "r");

					while ($kolom = fgetcsv($proses_berkas)) {
						$baris++;
						if ($baris == 1) continue; //untuk skip header csv
						$isi_csv = array(
							'pst_mst_sts' => trim(strtoupper($kolom[0])),
							'pst_mst_kode' => trim(strtoupper($kolom[1])),
							'pst_mst_kel' => trim(strtoupper($kolom[2])),
							'pst_mst_hak' => trim(strtoupper($kolom[3])),
							'pst_mst_nm' => trim(strtoupper($kolom[4])),
							'pst_mst_pswd' => trim(strtoupper($kolom[5])),
							'pst_mst_lock' => '0'
						);
							
						$this->m_db->tambah_data($isi_csv,$this->TabelPesertaMaster);
					}
					fclose($proses_berkas);
				} else {
					$validasi_a2 = array('validasi_a1' => 'Berkas yang di upload bukan file CSV atau isinya kosong...');
					$this->session->set_userdata($validasi_a2);
				}
				redirect($this->KePilihanA2);
				break;
		}
	}

	function proses_rekening_ok(){
		switch ($this->input->post('btnProses')){
			case "UNDUH":
				$nama_file = '_templateRekening.csv';
				$lokasi_file = file_get_contents(base_url().'berkas/unduh/_templateRekening.csv');
				force_download($nama_file,$lokasi_file);
				break;
			case "PROSES":
				$berkas_sementara = $_FILES['t_rek_csv']['tmp_name'];
				$berkas_aseli = $_FILES['t_rek_csv']['name'];
				$ekstensi_berkas_aseli  = explode('.', $_FILES['t_rek_csv']['name']);
				$ukuran_berkas_aseli = $_FILES['t_rek_csv']['size'];

				if (strtolower(end($ekstensi_berkas_aseli)) === 'csv' && $ukuran_berkas_aseli>0) {
					$baris = 0;
					$proses_berkas = fopen($berkas_sementara, "r");

					while ($kolom = fgetcsv($proses_berkas)) {
						$baris++;
						if ($baris == 1) continue; //untuk skip header csv
						$isi_csv = array(
							'rek_mst_sts' => trim(strtoupper($kolom[0])),
							'rek_mst_kel' => trim(strtoupper($kolom[1])),
							'rek_mst_gol' => trim(strtoupper($kolom[2])),
							'rek_mst_sub_gol' => trim(strtoupper($kolom[3])),
							'rek_mst_kode' => trim(strtoupper($kolom[4])),
							'rek_mst_sub_kode' => trim(strtoupper($kolom[5])),
							'rek_mst_ket_sub_kode' => trim(strtoupper($kolom[6]))
						);
							
						$this->m_db->tambah_data($isi_csv,$this->TabelRekeningMaster);
					}
					fclose($proses_berkas);
				} else {
					$validasi_a3 = array('validasi_a3' => 'Berkas yang di upload bukan file CSV atau isinya kosong...');
					$this->session->set_userdata($validasi_a3);
				}
				redirect($this->KePilihanA3);
				break;
		}
	}

	function cari_auto_kelompok_ok(){
		$seperti = array('kel_mst_kode' => $_GET['term']);
		$kelompok = array('kel_mst_kode');
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data_seperti($seperti,$kelompok,$this->TabelKelompokMaster)->result();
		
		foreach($data['daftar_kelompok_master'] as $km){
			$t_kel_mst_kode[] = array(
				'label' => $km->kel_mst_kode,
				'value' => $km->kel_mst_ket
			);
		}
		echo json_encode($t_kel_mst_kode);
	}

	function cari_auto_kelompok_2_ok(){
		$seperti = array('kel_mst_subkode' => $_GET['term']);
		$kondisi = array('kel_mst_kode' => $_GET['extra']);
		$kelompok = array('kel_mst_subkode');
		$data['daftar_kelompok_master'] = $this->m_db->ambil_data_seperti_kondisi($kondisi,$seperti,$kelompok,$this->TabelKelompokMaster)->result();
		
		foreach($data['daftar_kelompok_master'] as $km){
			$t_kel_mst_subkode[] = array(
				'label' => substr($km->kel_mst_subkode,strlen($km->kel_mst_kode)),
				'value' => $km->kel_mst_subket
			);
		}
		echo json_encode($t_kel_mst_subkode);
	}

	function cari_auto_peserta_ok(){
		$seperti = array('pst_mst_kode' => $_GET['term']);
		$kelompok = array('pst_mst_kode');
		$data['daftar_peserta_master'] = $this->m_db->ambil_data_seperti($seperti,$kelompok,$this->TabelPesertaMaster)->result();
		
		foreach($data['daftar_peserta_master'] as $pm){
			$t_pst_mst_kode[] = array(
				'label' => $pm->pst_mst_kode,
				'value' => $pm->pst_mst_nm
			);
		}
		echo json_encode($t_pst_mst_kode);
	}
	
	function cari_auto_rekening_ok(){
		$seperti = array('rek_mst_sub_kode' => $_GET['term']);
		$kondisi = array(
			'rek_mst_kel' => $_GET['extra1'], 
			'rek_mst_gol' => $_GET['extra2'], 
			'rek_mst_sub_gol' => $_GET['extra3'],
			'rek_mst_kode' => $_GET['extra4']
		);
		$kelompok = array('rek_mst_sub_kode');
		$data['daftar_rekening_master'] = $this->m_db->ambil_data_seperti_kondisi($kondisi,$seperti,$kelompok,$this->TabelRekeningMaster)->result();
		
		foreach($data['daftar_rekening_master'] as $rm){
			$t_rek_mst_sub_kode[] = array(
				'label' => $rm->rek_mst_sub_kode,
				'value' => $rm->rek_mst_ket_sub_kode
			);
		}
		echo json_encode($t_rek_mst_sub_kode);
	}

	function cari_info_level_2(){
		$kondisi = array(
			'in_lv_1_dt' => 'REKENING',
			'in_lv_1_kd' => $this->input->post('kode_level_1')
		);
		$data['daftar_info_level_2_rek'] = $this->m_db->ambil_data($kondisi,$this->TabelInfoLevel2)->result();
		
		$t_rek_mst_gol[""] = "Pilihan golongan rekening...";
		foreach($data['daftar_info_level_2_rek'] as $lv2_rek){
			$t_rek_mst_gol[$lv2_rek->in_lv_2_kd] = $lv2_rek->in_lv_2_ket;
		}
		echo json_encode($t_rek_mst_gol);
	}

	function cari_info_level_3(){
		$kondisi = array(
			'in_lv_1_dt' => 'REKENING',
			'in_lv_1_kd' => $this->input->post('kode_level_1'),
			'in_lv_2_kd' => $this->input->post('kode_level_2')
		);
		$data['daftar_info_level_3_rek'] = $this->m_db->ambil_data($kondisi,$this->TabelInfoLevel3)->result();
		
		$t_rek_mst_sub_gol[""] = "Pilihan sub-golongan rekening...";
		foreach($data['daftar_info_level_3_rek'] as $lv3_rek){
			$t_rek_mst_sub_gol[$lv3_rek->in_lv_3_kd] = $lv3_rek->in_lv_3_ket;
		}
		echo json_encode($t_rek_mst_sub_gol);
	}

	function cari_info_level_4(){
		$kondisi = array(
			'in_lv_1_dt' => 'REKENING',
			'in_lv_1_kd' => $this->input->post('kode_level_1'),
			'in_lv_2_kd' => $this->input->post('kode_level_2'),
			'in_lv_3_kd' => $this->input->post('kode_level_3')
		);
		$data['daftar_info_level_4_rek'] = $this->m_db->ambil_data($kondisi,$this->TabelInfoLevel4)->result();
		
		$t_rek_mst_kode[""] = "Pilihan sub-golongan rekening...";
		foreach($data['daftar_info_level_4_rek'] as $lv4_rek){
			$t_rek_mst_kode[$lv4_rek->in_lv_4_kd] = $lv4_rek->in_lv_4_ket;
		}
		echo json_encode($t_rek_mst_kode);
	}

}