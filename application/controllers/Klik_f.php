<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_f extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelKaryawanMaster="karyawan_master";
		$this->TabelPesertaMaster="peserta_master";
		$this->TabelInfoLevel1="info_level_1";
		$this->TabelKelompokMaster="kelompok_master";
		$this->TabelRekeningMaster="rekening_master";
		$this->FormF1="daftar_f1";
		$this->KePilihanF1="klik_f/pilihan_f1";
		$this->KePilihanZ1="klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if(($this->session->userdata('hak') == "PENGAWAS") || ($this->session->userdata('hak') == "PEMAKAI")){
			$validasi_z1=array('validasi_z1'=>"Maaf anda nda boleh masuk laman ini...");
			$this->session->set_userdata($validasi_z1);
			redirect($this->KePilihanZ1);
		} else {
			redirect($this->KePilihanF1);
		}
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_f1');
		$this->session->unset_userdata('validasi_f1');
	}

	function pilihan_f1(){
		$kondisi1=array(
			'in_lv_1_dt'=>'PENDIDIKAN'
		);
		
		$kondisi2=array(
			'in_lv_1_dt'=>'STSKRY'
		);

		$kondisi3=array(
			'in_lv_1_dt'=>'STSNKH'
		);

		$kondisi4=array(
			'kel_mst_sts'=>'AKTIF'
		);

		$kondisi5="kry_mst_kode IS NULL";

		$kondisi6="1=1";

		$kondisi7=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'KARYAWAN'
		);


		$data['daftar_pendidikan']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_stskry']=$this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		$data['daftar_stsnkh']=$this->m_db->ambil_data($kondisi3,$this->TabelInfoLevel1)->result();
		$data['daftar_jabatan']=$this->m_db->ambil_data($kondisi4,$this->TabelKelompokMaster)->result();
		$data['daftar_kry_master']=$this->m_db->ambil_data_karyawan($kondisi6)->result();
		$data['daftar_peserta_master']=$this->m_db->ambil_data_peserta($kondisi5,$this->TabelPesertaMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi7,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormF1,$data);
		$this->kosong_operator_validasi();
	}
	
	
	function tambah_karyawan_ok(){
		if($this->input->post('btnKirim')!="BATAL"){
			$kondisi=array('kryprm'=>$this->input->post('kryprm'));
			$nilai_kry_master=array(
				'kry_mst_lock'=>'0',
				'kry_mst_sts'=>strtoupper($this->input->post('t_kry_mst_sts')),
				'kry_mst_kode'=>strtoupper($this->input->post('t_kry_mst_kode')),
				'kry_mst_ic'=>strtoupper($this->input->post('t_kry_mst_ic')),
				'kry_mst_alamat'=>strtoupper($this->input->post('t_kry_mst_alamat')),
				'kry_mst_tgllhr'=>$this->input->post('t_kry_mst_tgllhr'),
				'kry_mst_tglkry'=>$this->input->post('t_kry_mst_tglkry'),
				'kry_mst_pddk'=>strtoupper($this->input->post('t_kry_mst_pddk')),
				'kry_mst_stsanak'=>strtoupper($this->input->post('t_kry_mst_stsanak')),
				'kry_mst_gol'=>strtoupper($this->input->post('t_kry_mst_gol')),
				'kry_mst_rek'=>strtoupper($this->input->post('t_kry_mst_rek')),
				'kry_mst_upah_pokok'=>$this->input->post('t_kry_mst_upah_pokok'),
				'kry_mst_tunj_ttp'=>$this->input->post('t_kry_mst_tunj_ttp'),
				'kry_mst_tunj_t_ttp'=>$this->input->post('t_kry_mst_tunj_t_ttp')
			);

			$this->form_validation->set_rules('t_kry_mst_kode','KODE PEMAKAI','required');
			$this->form_validation->set_rules('t_kry_mst_ic','KTP','required|trim|max_length[20]|is_unique['.$this->TabelKaryawanMaster.'.kry_mst_ic]');
			$this->form_validation->set_rules('t_kry_mst_alamat','ALAMAT','required');
			$this->form_validation->set_rules('t_kry_mst_tgllhr','TGL LAHIR','required');
			$this->form_validation->set_rules('t_kry_mst_tglkry','TGL MULAI BER-KARYA','required');
			$this->form_validation->set_rules('t_kry_mst_pddk','TINGKAT PENDIDIKAN','required');
			$this->form_validation->set_rules('t_kry_mst_stsanak','STATUS PERKAWINAN DAN JUMLAH ANAK','required');
			$this->form_validation->set_rules('t_kry_mst_gol','GOLONGAN','required');
			$this->form_validation->set_rules('t_kry_mst_rek','GOLONGAN','required');
			$this->form_validation->set_rules('t_kry_mst_upah_pokok','UPAH POKOK','required|greater_than[0]');
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('greater_than','%s harus lebih dari 0');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba dicek dulu...');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');

			
			if($this->form_validation->run() == false){
				$validasi_f1=array('validasi_f1'=>validation_errors('<li>','</li>'));
				$this->session->set_userdata($validasi_f1);
			} else {
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_kry_master,$this->TabelKaryawanMaster);
						break;
					case "UBAH";
						$this->m_db->ubah_data($kondisi,$nilai_kry_master,$this->TabelKaryawanMaster);
				}
			}
		}
		redirect($this->KePilihanF1);
		$this->kosong_operator_validasi();
	}

	function hapus_karyawan_ok($t_kryprm){
		$kondisi=array(
			'kryprm'=>$t_kryprm
		);

		$this->m_db->hapus_data($kondisi,$this->TabelKaryawanMaster);
		redirect($this->KePilihanF1);
		$this->kosong_operator_validasi();
	}

	function ubah_karyawan_ok($t_kryprm){
		$operator_f1=array('operator_f1'=>"UBAH");
		$this->session->set_userdata($operator_f1);

		$kondisi1=array(
			'in_lv_1_dt'=>'PENDIDIKAN'
		);
		
		$kondisi2=array(
			'in_lv_1_dt'=>'STSKRY'
		);

		$kondisi3=array(
			'in_lv_1_dt'=>'STSNKH'
		);

		$kondisi4=array(
			'kel_mst_sts'=>'AKTIF'
		);

		$kondisi6=array(
			'kryprm'=>$t_kryprm
		);

		$kondisi7=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'KARYAWAN'
		);


		$data['daftar_pendidikan']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_stskry']=$this->m_db->ambil_data($kondisi2,$this->TabelInfoLevel1)->result();
		$data['daftar_stsnkh']=$this->m_db->ambil_data($kondisi3,$this->TabelInfoLevel1)->result();
		$data['daftar_jabatan']=$this->m_db->ambil_data($kondisi4,$this->TabelKelompokMaster)->result();
		$data['daftar_kry_master']=$this->m_db->ambil_data_karyawan($kondisi6)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi7,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormF1,$data);
		$this->kosong_operator_validasi();
	}


	function cari_peserta(){
		$kondisi=array(
			'pst_mst_kode'=>$this->input->post('t_pst_mst_kode'),
			'pst_mst_sts'=>$this->input->post('t_pst_mst_sts'),
			);
			
		$data['daftar_peserta_master']=$this->m_db->ambil_data_peserta($kondisi,$this->TabelPesertaMaster)->result();
		
		if(!empty($data['daftar_peserta_master'])){
			foreach ($data['daftar_peserta_master'] as $pm){				
				$t_pst_mst[]=array(
					'pstnm'=>$pm->pst_mst_nm,
					'pststs'=>$pm->pst_mst_sts,
					'pstkel'=>$pm->pst_mst_kel,
					'pstket'=>$pm->kel_mst_subket
				);
			}
		} else {
			$t_pst_mst[]=array();
		}

		echo json_encode($t_pst_mst);
	}		

	function cari_karyawan(){
		$kondisi=array(
			'kryprm'=>$this->input->post('kryprm')
			);
		
		$data['daftar_karyawan_master']=$this->m_db->ambil_data_karyawan($kondisi)->result();
		
		if(!empty($data['daftar_karyawan_master'])){
			foreach ($data['daftar_karyawan_master'] as $km){				
				$t_kry_mst[]=array(
					'krysts'=>$km->kry_mst_sts,
					'krykode'=>$km->kry_mst_kode,
					'kryic'=>$km->kry_mst_ic,
					'krynm'=>$km->pst_mst_nm,
					'kryalamat'=>$km->kry_mst_alamat,
					'krytgllhr'=>$km->kry_mst_tgllhr,
					'krytglkry'=>$km->kry_mst_tglkry,
					'krypddk'=>$km->kry_mst_pddk,
					'krystsanak'=>$km->kry_mst_stsanak,
					'krykel'=>$km->pst_mst_kel,
					'kryket'=>$km->kel_mst_subket,
					'krygol'=>$km->kry_mst_gol,
					'kryrek'=>$km->kry_mst_rek,
					'kryupah_pokok'=>'Rp. '.number_format($km->kry_mst_upah_pokok,2,",","."),
					'krytunj_ttp'=>'Rp. '.number_format($km->kry_mst_tunj_ttp,2,",","."),
					'krytunj_t_ttp'=>'Rp. '.number_format($km->kry_mst_tunj_t_ttp,2,",",".")
				);
			}
			echo json_encode($t_kry_mst);
		}
	}	
}