<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_b extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster='hutang_master';
		$this->TabelRekeningMaster='rekening_master';
		$this->TabelKaryawanMaster='karyawan_master';
		$this->FormB1='daftar_b1';
		$this->KePilihanB1='klik_b/pilihan_b1';
		$this->KePilihanZ1='klik_z/index';

		if($this->session->userdata('status')!='masuk'){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if($this->session->userdata('hak')=='PENGAWAS'){
			$validasi_z1=array('validasi_z1'=>'Maaf anda nda boleh masuk laman ini...');
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
		if($this->session->userdata('hak')=='PEMILIK'){
			$kondisi1=array(
				'rek_mst_sts'=>'AKTIF',
				'rek_mst_kel'=>'ANGGARAN',
				'rek_mst_gol'=>'ABTT',
				'rek_mst_sub_gol'=>'BIAYA'
			);
		}
		else{
			$kondisi1=array(
				'hut_mst_kel'=>$this->session->userdata('kelompok'),
				'rek_mst_sts'=>'AKTIF',
				'rek_mst_kel'=>'ANGGARAN',
				'rek_mst_gol'=>'ABTT',
				'rek_mst_sub_gol'=>'BIAYA'
			);
		};

		$kondisi2a=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA'
		);

		switch($this->session->userdata('hak')){
			case 'PEMAKAI':
				$kondisi2b='rek_mst_kode IN ("PROGRAM","RUTIN")';
				break;
			case 'PELAKSANA':
				$kondisi2b='rek_mst_kode NOT IN ("PROGRAM","RUTIN")';
				break;
			default:
				$kondisi2b='1=1';
				break;
		}
		
		
		$kelompok='rek_mst_sts,rek_mst_kel,rek_mst_gol,rek_mst_sub_gol,rek_mst_kode';

		$data['daftar_hutang_master']=$this->m_db->ambil_data_hutang($kondisi1)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data_kelompok($kondisi2a,$kondisi2b,$kelompok,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormB1,$data);
		$this->kosong_operator_validasi();
	}

	function tambah_hutang_ok(){
		$prefix1='AGR';
		$prefix2=date('Ymd');
		$prefix3=date('Y-m-d');
		$prm1='hut_mst_dt';
		$prm2='hut_mst_nobuk';
		$prm3='hut_mst_tgl';
		$separator='-';
		$t_hut_mst_nobuk='';

		$data['no_acak']=$this->m_db->ambil_data_urut($this->TabelHutangMaster,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3)->result();
		if (empty($data['no_acak'])){ //empty karna blm ada record
			$data['no_acak']=trim(strtoupper($prefix1.$separator.$prefix2.$separator.str_pad(floor(rand(0,99999)),5,'0',STR_PAD_LEFT)));
			$t_hut_mst_nobuk=$data['no_acak'];
		} else {
			foreach($data['no_acak'] as $no_urut){
				$t_hut_mst_nobuk=$no_urut->urut;
			}
		}

		$this->form_validation->set_rules('t_hut_mst_tglrnc','TANGGAL PELAKSANAAN KEGIATAN','required');
		$this->form_validation->set_rules('t_hut_mst_rek','REKENING BEBAN','required');
		$this->form_validation->set_rules('t_hut_mst_ket','NAMA KEGIATAN','required|max_length[2000]');
		$this->form_validation->set_rules('t_hut_mst_rnc','RENCANA ANGGARAN','required|greater_than[0]');
		$this->form_validation->set_rules('t_hut_jenis','JENIS PENGAJUAN','required');

		$this->form_validation->set_message('required','%s ngga boleh dikosongin');
		$this->form_validation->set_message('greater_than','%s pengajuan anggarannya harus lebih dari 0');
		$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
		$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

		switch ($this->input->post('t_hut_jenis')){
			case 'PROGRAM':
				$konfigurasi=array (
					'upload_path'=>'./berkas/unggah/',
					'allowed_types'=>'doc|docx',
					'max_size'=>20480,
					'overwrite'=>true,
					'file_name'=>$t_hut_mst_nobuk
					);
				break;
				
			case 'KARYAWAN':
				$this->form_validation->set_rules('t_hut_mst_noref','KODE KARYAWAN','required');
				break;

			case 'RUTIN':
				$konfigurasi=array (
					'upload_path'=>'./berkas/unggah/',
					'allowed_types'=>'jpg|jpeg|png|gif|tiff|bmp',
					'max_size'=>20480,
					'overwrite'=>true,
					'file_name'=>$t_hut_mst_nobuk
					);		
				break;

			case 'PERAWATAN':
				$konfigurasi=array (
					'upload_path'=>'./berkas/unggah/',
					'allowed_types'=>'jpg|jpeg|png|gif|tiff|bmp',
					'max_size'=>20480,
					'overwrite'=>true,
					'file_name'=>$t_hut_mst_nobuk
					);		
				break;
		}

		if($this->form_validation->run()!=false){
			if ($this->input->post('t_hut_jenis')!='KARYAWAN'){
				$this->load->library('upload', $konfigurasi);
				if (!$this->upload->do_upload('t_hut_mst_doc')){
					$validasi_b1=array(
						'validasi_b1'=>'Unggah proposal ga berhasil, PROGRAM=berkas doc/docx, BIAYA RUTIN=berkas jpeg'
					);
					$this->session->set_userdata($validasi_b1);
					redirect($this->KePilihanB1);
					$this->kosong_operator_validasi();
				}
					
			}
			
			$nilai_master=array(
				'hut_mst_lock'=>'0',
				'hut_mst_dt'=>'AGR',
				'hut_mst_nobuk'=>$t_hut_mst_nobuk,
				'hut_mst_noref'=>$this->input->post('t_hut_mst_noref'),
				'hut_mst_sts'=>'BARU',
				'hut_mst_tgl'=>date('Y-m-d'),
				'hut_mst_tglrnc'=>$this->input->post('t_hut_mst_tglrnc'),
				'hut_mst_pst'=>$this->session->userdata('kode'),
				'hut_mst_kel'=>$this->session->userdata('kelompok'),
				'hut_mst_rek'=>$this->input->post('t_hut_mst_rek'),
				'hut_mst_rnc'=>$this->input->post('t_hut_mst_rnc'),
				'hut_mst_ttl'=>'0',
				'hut_mst_ket'=>trim(strtoupper($this->input->post('t_hut_mst_ket'))),
				'hut_mst_dok'=>$this->input->post('t_hut_jenis')!='KARYAWAN' ? $this->upload->data('file_name') : ''
			);
			
			$this->m_db->tambah_data($nilai_master,$this->TabelHutangMaster);
		} else {
				$validasi_b1=array('validasi_b1'=>validation_errors('<li>','</li>'));
				$this->session->set_userdata($validasi_b1);
		}
		redirect($this->KePilihanB1);
		$this->kosong_operator_validasi();
	}

	function hapus_hutang_ok($hutprm){
		$kondisi=array(
			'hutprm'=>$hutprm,
			'hut_mst_sts'=>'BARU',
			'hut_mst_lock'=>'0'
		);
		$data['daftar_hutang_master']=$this->m_db->ambil_data($kondisi,$this->TabelHutangMaster)->result();
		
		if (empty($data['daftar_hutang_master'])){
			$validasi_b1=array(
				'validasi_b1'=>'Pengajuan anggaran sudah selesai di proses, nda boleh hapus data yang sudah masuk...'
			);
			$this->session->set_userdata($validasi_b1);
		} else {
			$this->m_db->hapus_data($kondisi,$this->TabelHutangMaster);
		}
		redirect($this->KePilihanB1);
		$this->kosong_operator_validasi();
	}
	
	function cari_rek(){
		$kondisi=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>$this->input->post('t_kode_rek')
		);
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi,$this->TabelRekeningMaster)->result();
	
		$t_rek_mst_kode['']='Pilihan sub-golongan rekening...';	
		foreach($data['daftar_rekening_master'] as $rm){
			$t_rek_mst_kode[$rm->rek_mst_sub_kode]=$rm->rek_mst_ket_sub_kode;
		}
		echo json_encode($t_rek_mst_kode);
	}

	function cari_ref(){
		switch($this->input->post('t_jenis')){
			case 'KARYAWAN':
				if(!empty($this->input->post('t_kode'))){
					$kondisi=array(
						'kry_mst_sts'=>$this->input->post('t_sts'),
						'kry_mst_kode'=>$this->input->post('t_kode'),
						'kry_mst_lock'=>'0'
					);
				} else {
					$kondisi=array(
						'kry_mst_sts'=>$this->input->post('t_sts'),
						'kry_mst_lock'=>'0'
					);
				}

				$data['daftar_karyawan_master']=$this->m_db->ambil_data_karyawan($kondisi)->result();
				if(!empty($this->input->post('t_kode'))){
					$t_kry_mst_rek['']='Pilihan pos rekening...';	
					foreach($data['daftar_karyawan_master'] as $km){
						$t_kry_mst_rek[$km->kry_mst_rek]=$km->rek_mst_ket_sub_kode;
						$t_kry_mst_gaji['f01personalia']=(float)$km->kry_mst_upah_pokok+(float)$km->kry_mst_tunj_ttp+(float)$km->kry_mst_tunj_t_ttp;
					}
					echo json_encode(array($t_kry_mst_rek,$t_kry_mst_gaji));
				} else {
					$t_kry_mst_kode['']='Pilihan karyawan...';	
					foreach($data['daftar_karyawan_master'] as $km){
						$t_kry_mst_kode[$km->kry_mst_kode]=$km->pst_mst_nm;
					}
					echo json_encode($t_kry_mst_kode);
				}
				break;

			case 'PENGADAAN':
			case 'PERAWATAN':
				if(!empty($this->input->post('t_kode'))){
					$kondisi=array(
						'inv_mst_sts'=>$this->input->post('t_sts'),
						'inv_mst_kode'=>$this->input->post('t_kode'),
						'inv_mst_lock'=>'0'
					);
				} else {
					$kondisi=array(
						'inv_mst_sts'=>$this->input->post('t_sts'),
						'inv_mst_lock'=>'0'
					);
				}

				if($this->input->post('t_jenis')=='PENGADAAN'){
					$data['daftar_inventaris_master']=$this->m_db->ambil_data_inventaris_ada($kondisi)->result();
				}

				if($this->input->post('t_jenis')=='PERAWATAN'){
					$data['daftar_inventaris_master']=$this->m_db->ambil_data_inventaris_rawat($kondisi)->result();
				}

				if(!empty($this->input->post('t_kode'))){
					$t_inv_mst_rek['']='Pilihan pos rekening...';
					foreach($data['daftar_inventaris_master'] as $im){
						$t_inv_mst_rek[$im->inv_mst_rek_rawat]=$im->rek_mst_ket_sub_kode;
						$t_inv_mst_awal['g01inventaris']=(float)$im->inv_mst_awal;
					}
					echo json_encode(array($t_inv_mst_rek,$t_inv_mst_awal));
				} else {
					$t_inv_mst_kode['']='Pilihan inventaris...';	
					foreach($data['daftar_inventaris_master'] as $im){
						$t_inv_mst_kode[$im->inv_mst_kode]=$im->inv_mst_barang.' '.$im->inv_mst_kode;
					}
					echo json_encode($t_inv_mst_kode);
				}
				break;
		}
	}


}