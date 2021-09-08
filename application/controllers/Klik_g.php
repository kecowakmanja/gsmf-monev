<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_g extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelInfoLevel1="info_level_1";
		$this->TabelRekeningMaster="rekening_master";
		$this->TabelInventarisMaster="inventaris_master";
		$this->FormG1="daftar_g1";
		$this->FormG2="daftar_g2";
		$this->FormG3="daftar_g3";
		$this->KePilihanG1="klik_g/pilihan_g1";
		$this->KePilihanG2="klik_g/pilihan_g2";
		$this->KePilihanG3="klik_g/pilihan_g3";
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
			redirect($this->KePilihanG1);
		}
	}

	function kosong_operator_validasi(){
		$this->session->unset_userdata('operator_g1');
		$this->session->unset_userdata('validasi_g1');
		$this->session->unset_userdata('operator_g2');
		$this->session->unset_userdata('validasi_g2');
		$this->session->unset_userdata('operator_g3');
		$this->session->unset_userdata('validasi_g3');
	}

	function pilihan_g1(){
		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'BERGERAK'
		);

		$kondisi4="inv_mst_tipe IN ('RODA2','RODA4')";

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG1,$data);
		$this->kosong_operator_validasi();
	}

	function pilihan_g2(){
		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'TIDAKBERGERAK'
		);

		$kondisi4="inv_mst_tipe IN ('TANAHBANGUNAN')";

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG2,$data);
		$this->kosong_operator_validasi();
	}

	function pilihan_g3(){
		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'PERALATAN'
		);

		$kondisi4="inv_mst_tipe IN ('PERALATAN')";

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG3,$data);
		$this->kosong_operator_validasi();
	}
	
	
	function tambah_aktiva_g1_ok(){
		if($this->input->post('btnKirim')!="BATAL"){
			$kondisi=array('invprm'=>$this->input->post('invprm'));
			$nilai_inv_master=array(
				'inv_mst_lock'=>'0',
				'inv_mst_sts'=>strtoupper($this->input->post('t_inv_mst_sts')),
				'inv_mst_dt'=>'INV',
				'inv_mst_kode'=>strtoupper($this->input->post('t_inv_mst_kode')),
				'inv_mst_tipe'=>strtoupper($this->input->post('t_inv_mst_tipe')),
				'inv_mst_barang'=>strtoupper($this->input->post('t_inv_mst_barang')),
				'inv_mst_ket'=>strtoupper($this->input->post('t_inv_mst_kode')),
				'inv_mst_pemilik'=>'PAROKI',
				'inv_mst_nm'=>strtoupper($this->input->post('t_inv_mst_nm')),
				'inv_mst_tgl'=>date('Y-m-d'),
				'inv_mst_tgl_beli'=>$this->input->post('t_inv_mst_tgl'),
				'inv_mst_rek'=>strtoupper($this->input->post('t_inv_mst_rek')),
				'inv_mst_rek_sst'=>strtoupper($this->input->post('t_inv_mst_rek_sst')),
				'inv_mst_rek_rawat'=>strtoupper($this->input->post('t_inv_mst_rek_rawat')),
				'inv_mst_jthtmp1'=>$this->input->post('t_inv_mst_jthtmp1'),
				'inv_mst_jthtmp2'=>$this->input->post('t_inv_mst_jthtmp2'),
				'inv_mst_masa'=>$this->input->post('t_inv_mst_masa'),
				'inv_mst_awal'=>(float)$this->input->post('t_inv_mst_awal'),
				'inv_mst_tambah'=>'0',
				'inv_mst_kurang'=>'0',
				'inv_mst_akhir'=>(float)$this->input->post('t_inv_mst_awal'),
			);

			if($this->input->post('btnKirim')!="UBAH"){
				$this->form_validation->set_rules('t_inv_mst_kode','NO.POLISI','required|trim|max_length[20]|is_unique['.$this->TabelInventarisMaster.'.inv_mst_kode]');
			}
			$this->form_validation->set_rules('t_inv_mst_nm','NAMA ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_barang','MERK/OBJEK PAJAK ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_tgl','TGL BELI','required');
			$this->form_validation->set_rules('t_inv_mst_jthtmp1','JTP PAJAK','required');
			$this->form_validation->set_rules('t_inv_mst_jthtmp2','JTP PEMILIK','required');
			$this->form_validation->set_rules('t_inv_mst_awal','HARGA BELI','required|greater_than[0]');
			$this->form_validation->set_rules('t_inv_mst_masa','MASA PAKAI','required|greater_than[0]');
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('greater_than','%s harus lebih dari 0');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba dicek dulu...');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			
			if($this->form_validation->run() == false){
				$validasi_g1=array('validasi_g1'=>validation_errors('<li>','</li>'));
				$this->session->set_userdata($validasi_g1);
			} else {
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_inv_master,$this->TabelInventarisMaster);
						break;
					case "UBAH";
						$this->m_db->ubah_data($kondisi,$nilai_inv_master,$this->TabelInventarisMaster);
				}
			}
		}
		redirect($this->KePilihanG1);
		$this->kosong_operator_validasi();
	}

	function tambah_aktiva_g2_ok(){
		if($this->input->post('btnKirim')!="BATAL"){
			$kondisi=array('invprm'=>$this->input->post('invprm'));
			$nilai_inv_master=array(
				'inv_mst_lock'=>'0',
				'inv_mst_sts'=>strtoupper($this->input->post('t_inv_mst_sts')),
				'inv_mst_dt'=>'INV',
				'inv_mst_kode'=>strtoupper($this->input->post('t_inv_mst_kode')),
				'inv_mst_tipe'=>strtoupper($this->input->post('t_inv_mst_tipe')),
				'inv_mst_barang'=>strtoupper($this->input->post('t_inv_mst_barang')),
				'inv_mst_ket'=>strtoupper($this->input->post('t_inv_mst_ket')),
				'inv_mst_pemilik'=>'PAROKI',
				'inv_mst_nm'=>strtoupper($this->input->post('t_inv_mst_nm')),
				'inv_mst_tgl'=>date('Y-m-d'),
				'inv_mst_tgl_beli'=>$this->input->post('t_inv_mst_tgl'),
				'inv_mst_rek'=>strtoupper($this->input->post('t_inv_mst_rek')),
				'inv_mst_rek_sst'=>strtoupper($this->input->post('t_inv_mst_rek_sst')),
				'inv_mst_rek_rawat'=>strtoupper($this->input->post('t_inv_mst_rek_rawat')),
				'inv_mst_jthtmp1'=>$this->input->post('t_inv_mst_jthtmp1'),
				'inv_mst_jthtmp2'=>$this->input->post('t_inv_mst_jthtmp2'),
				'inv_mst_masa'=>'240',
				'inv_mst_awal'=>(float)$this->input->post('t_inv_mst_awal'),
				'inv_mst_tambah'=>'0',
				'inv_mst_kurang'=>'0',
				'inv_mst_akhir'=>(float)$this->input->post('t_inv_mst_awal'),
			);

			if($this->input->post('btnKirim')!="UBAH"){
				$this->form_validation->set_rules('t_inv_mst_kode','NO.SERTIFIKAT','required|trim|max_length[20]|is_unique['.$this->TabelInventarisMaster.'.inv_mst_kode]');
			}
			$this->form_validation->set_rules('t_inv_mst_nm','NAMA ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_barang','NOMOR OBJEK PAJAK ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_tgl','TGL BELI','required');
			$this->form_validation->set_rules('t_inv_mst_jthtmp1','JTP PAJAK','required');
			$this->form_validation->set_rules('t_inv_mst_jthtmp2','JTP KEPEMILIKAN','required');
			$this->form_validation->set_rules('t_inv_mst_awal','HARGA BELI','required|greater_than[0]');
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('greater_than','%s harus lebih dari 0');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba dicek dulu...');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			
			if($this->form_validation->run() == false){
				$validasi_g2=array('validasi_g2'=>validation_errors('<li>','</li>'));
				$this->session->set_userdata($validasi_g2);
			} else {
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_inv_master,$this->TabelInventarisMaster);
						break;
					case "UBAH";
						$this->m_db->ubah_data($kondisi,$nilai_inv_master,$this->TabelInventarisMaster);
				}
			}
		}
		redirect($this->KePilihanG2);
		$this->kosong_operator_validasi();
	}

	function tambah_aktiva_g3_ok(){
		if($this->input->post('btnKirim')!="BATAL"){
			$kondisi=array('invprm'=>$this->input->post('invprm'));
			$nilai_inv_master=array(
				'inv_mst_lock'=>'0',
				'inv_mst_sts'=>strtoupper($this->input->post('t_inv_mst_sts')),
				'inv_mst_dt'=>'INV',
				'inv_mst_kode'=>strtoupper($this->input->post('t_inv_mst_kode')),
				'inv_mst_tipe'=>strtoupper($this->input->post('t_inv_mst_tipe')),
				'inv_mst_barang'=>strtoupper($this->input->post('t_inv_mst_barang')),
				'inv_mst_ket'=>strtoupper($this->input->post('t_inv_mst_ket')),
				'inv_mst_pemilik'=>'PAROKI',
				'inv_mst_nm'=>strtoupper($this->input->post('t_inv_mst_nm')),
				'inv_mst_tgl'=>date('Y-m-d'),
				'inv_mst_tgl_beli'=>$this->input->post('t_inv_mst_tgl'),
				'inv_mst_rek'=>strtoupper($this->input->post('t_inv_mst_rek')),
				'inv_mst_rek_sst'=>strtoupper($this->input->post('t_inv_mst_rek_sst')),
				'inv_mst_rek_rawat'=>strtoupper($this->input->post('t_inv_mst_rek_rawat')),
				'inv_mst_jthtmp1'=>'9999-12-31',
				'inv_mst_jthtmp2'=>'9999-12-31',
				'inv_mst_masa'=>'48',
				'inv_mst_awal'=>(float)$this->input->post('t_inv_mst_awal'),
				'inv_mst_tambah'=>'0',
				'inv_mst_kurang'=>'0',
				'inv_mst_akhir'=>(float)$this->input->post('t_inv_mst_awal'),
			);

			if($this->input->post('btnKirim')!="UBAH"){
				$this->form_validation->set_rules('t_inv_mst_kode','NO.SERI','required|trim|max_length[20]|is_unique['.$this->TabelInventarisMaster.'.inv_mst_kode]');
			}
			$this->form_validation->set_rules('t_inv_mst_nm','NAMA ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_barang','MERK ','required|trim|max_length[2000]');
			$this->form_validation->set_rules('t_inv_mst_tgl','TGL BELI','required');
			$this->form_validation->set_rules('t_inv_mst_awal','HARGA BELI','required|greater_than[0]');
			
			$this->form_validation->set_message('required','%s ngga boleh dikosongin');
			$this->form_validation->set_message('greater_than','%s harus lebih dari 0');
			$this->form_validation->set_message('is_unique','%s udah ada tuh, coba dicek dulu...');
			$this->form_validation->set_message('max_length[20]','%s kepanjangan, maksimal 20 karakter');
			$this->form_validation->set_message('max_length[2000]','%s kepanjangan, maksimal 2000 karakter');

			
			if($this->form_validation->run() == false){
				$validasi_g3=array('validasi_g3'=>validation_errors('<li>','</li>'));
				$this->session->set_userdata($validasi_g3);
			} else {
				switch ($this->input->post('btnKirim')){
					case "TAMBAH":
						$this->m_db->tambah_data($nilai_inv_master,$this->TabelInventarisMaster);
						break;
					case "UBAH";
						$this->m_db->ubah_data($kondisi,$nilai_inv_master,$this->TabelInventarisMaster);
				}
			}
		}
		redirect($this->KePilihanG3);
		$this->kosong_operator_validasi();
	}

	function hapus_aktiva_g1_ok($t_invprm){
		$kondisi=array(
			'invprm'=>$t_invprm
		);

		$this->m_db->hapus_data($kondisi,$this->TabelInventarisMaster);
		redirect($this->KePilihanG1);
		$this->kosong_operator_validasi();
	}

	function hapus_aktiva_g2_ok($t_invprm){
		$kondisi=array(
			'invprm'=>$t_invprm
		);

		$this->m_db->hapus_data($kondisi,$this->TabelInventarisMaster);
		redirect($this->KePilihanG2);
		$this->kosong_operator_validasi();
	}

	function hapus_aktiva_g3_ok($t_invprm){
		$kondisi=array(
			'invprm'=>$t_invprm
		);

		$this->m_db->hapus_data($kondisi,$this->TabelInventarisMaster);
		redirect($this->KePilihanG3);
		$this->kosong_operator_validasi();
	}

	function ubah_aktiva_g1_ok($t_invprm){
		$operator_g1=array('operator_g1'=>"UBAH");
		$this->session->set_userdata($operator_g1);

		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'BERGERAK'
		);

		$kondisi4=array(
			'invprm'=>$t_invprm
		);

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG1,$data);
		$this->kosong_operator_validasi();

	}

	function ubah_aktiva_g2_ok($t_invprm){
		$operator_g2=array('operator_g2'=>"UBAH");
		$this->session->set_userdata($operator_g2);

		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'TIDAKBERGERAK'
		);

		$kondisi4=array(
			'invprm'=>$t_invprm
		);

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG2,$data);
		$this->kosong_operator_validasi();

	}

	function ubah_aktiva_g3_ok($t_invprm){
		$operator_g3=array('operator_g3'=>"UBAH");
		$this->session->set_userdata($operator_g3);

		$kondisi1=array(
			'in_lv_1_dt'=>'STATUS'
		);

		$kondisi2=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'ANGGARAN',
			'rek_mst_gol'=>'ABTT',
			'rek_mst_sub_gol'=>'BIAYA',
			'rek_mst_kode'=>'PERAWATAN'
		);

		$kondisi3=array(
			'rek_mst_sts'=>'AKTIF',
			'rek_mst_kel'=>'NERACA',
			'rek_mst_gol'=>'ASET',
			'rek_mst_sub_gol'=>'ASETTETAP',
			'rek_mst_kode'=>'PERALATAN'
		);

		$kondisi4=array(
			'invprm'=>$t_invprm
		);

		$data['daftar_sts']=$this->m_db->ambil_data($kondisi1,$this->TabelInfoLevel1)->result();
		$data['daftar_rekrawat_master']=$this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$data['daftar_rekening_master']=$this->m_db->ambil_data($kondisi3,$this->TabelRekeningMaster)->result();
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi4,$this->TabelInventarisMaster)->result();
		$this->load->view($this->FormG3,$data);
		$this->kosong_operator_validasi();

	}

	function cari_aktiva(){
		$kondisi=array(
			'invprm'=>$this->input->post('invprm')
			);
			
		$data['daftar_inventaris_master']=$this->m_db->ambil_data($kondisi,$this->TabelInventarisMaster)->result();
		
		if(!empty($data['daftar_inventaris_master'])){
			foreach ($data['daftar_inventaris_master'] as $im){				
				$t_inv_mst[]=array(
					'invsts'=>$im->inv_mst_sts,
					'invtipe'=>$im->inv_mst_tipe,
					'invbarang'=>$im->inv_mst_barang,
					'invket'=>$im->inv_mst_ket,
					'invkode'=>$im->inv_mst_kode,
					'invnm'=>$im->inv_mst_nm,
					'invpemilik'=>$im->inv_mst_pemilik,
					'invjthtmp1'=>$im->inv_mst_jthtmp1,
					'invjthtmp2'=>$im->inv_mst_jthtmp2,
					'invtgl'=>$im->inv_mst_tgl_beli,
					'invmasa'=>$im->inv_mst_masa,
					'invawal'=>'Rp. '.number_format($im->inv_mst_awal,2,",","."),
					'invtambah'=>'Rp. '.number_format($im->inv_mst_tambah,2,",","."),
					'invkurang'=>'Rp. '.number_format($im->inv_mst_kurang,2,",","."),
					'invakhir'=>'Rp. '.number_format($im->inv_mst_akhir,2,",",".")
				);
			}
		} else {
			$t_inv_mst[]=array();
		}
		echo json_encode($t_inv_mst);
	}
}