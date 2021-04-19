<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Klik_e extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//model
		$this->load->model('m_db');

		//variabel global
		$this->TabelHutangMaster = "hutang_master";
		$this->TabelPesertaMaster = "peserta_master";
		$this->TabelRekeningMaster = "rekening_master";
		$this->TabelKasMaster = "kas_master";
		$this->TabelJurnalMaster = "jurnal_master";
		$this->FormE1 = "daftar_e1";
		$this->FormE2 = "daftar_e2";
		$this->KePilihanE1 = "klik_e/pilihan_e1";
		$this->KePilihanE2 = "klik_e/pilihan_e2";
		$this->KePilihanZ1 = "klik_z/index";

		if($this->session->userdata('status')!="masuk"){
			redirect($this->KePilihanZ1);
		} 
	}
 
	function index(){
		if(($this->session->userdata('hak') == "PENGAWAS") || ($this->session->userdata('hak') == "PEMAKAI")){
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
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'ANGGARAN',
			'rek_mst_gol' => 'ABTT',
			'rek_mst_sub_gol' => 'BIAYA'
		);
		
		$kondisi2 = array(
			'rek_mst_sts' => 'AKTIF',
			'rek_mst_kel' => 'NERACA',
			'rek_mst_gol' => 'ASET',
			'rek_mst_sub_gol' => 'ASETLANCAR',
			'rek_mst_kode' => 'SETARAKAS'
		);

		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang_cair($kondisi1)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi2,$this->TabelRekeningMaster)->result();
		$this->load->view($this->FormE1,$data);
		$this->kosong_operator_validasi();
	}
	
	function pilihan_e2(){
		$kondisi1 = "1=1";
		
		$data['daftar_kas_master'] = $this->m_db->ambil_data_kas($kondisi1)->result();
		$this->load->view($this->FormE2,$data);
		$this->kosong_operator_validasi();
	}
	
	function detail_hutang_ok(){
		$operator_e1 = array('operator_e1' => "UBAH");
		$this->session->set_userdata($operator_e1);
		
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
					'hutttl' => 'Rp. '.number_format($hm->hut_mst_ttl,2,",","."),
					'hutsisa' => 'Rp. '.number_format(($hm->hut_mst_rnc-$hm->hut_mst_ttl),2,",","."),
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
		
		$kondisi = array(
			'hutprm' => $this->input->post('t_hutprm'),
			'hut_mst_lock' => '1'
		);
		
		$nilai_master = array(
				'hut_mst_lock' => '0'
		);
		
		if ($this->input->post('btnKirim')!="BATAL"){			
			$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi)->result();
			
			foreach ($data['daftar_hutang_master'] as $hm){
				$t_hut_mst_lock = $hm->hut_mst_lock;
				$t_hut_mst_sts = $hm->hut_mst_sts;
				$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
				$t_hut_mst_rnc = $hm->hut_mst_rnc;
				$t_hut_mst_ttl = $hm->hut_mst_ttl;
				$t_hut_mst_rek = $hm->hut_mst_rek;
				$maksimum = (float)$hm->hut_mst_rnc-(float)$hm->hut_mst_ttl;
			}
			
			$nilai_hit = 'kas_mst_ttl';
			$kondisi_hit = array(
				'kas_mst_noref' => $t_hut_mst_nobuk
			);
			
			$hasil_hit = $this->m_db->hitung_data($kondisi_hit,$nilai_hit,$this->TabelKasMaster)->result();
			
			foreach ($hasil_hit as $hasil_hit_ok){
				$t_hut_mst_ttl = (float)$hasil_hit_ok->kas_mst_ttl;
			}
			
			$prefix1 = 'KK';
			$prefix2 = date('Ymd');
			$prefix3 = date('Y-m-d');
			$prm1 = 'kas_mst_dt';
			$prm2 = 'kas_mst_nobuk';
			$prm3 = 'kas_mst_tgl';
			$separator = "-";
			
			$data['no_acak'] = $this->m_db->ambil_data_urut($this->TabelKasMaster,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3)->result();
			if (empty($data['no_acak'])){ //empty karna blm ada record
				$data['no_acak'] = trim(strtoupper($prefix1.$separator.$prefix2.$separator.str_pad(floor(rand(0,99999)),5,"0",STR_PAD_LEFT)));
			}

			$t_kas_mst_nobuk = $data['no_acak'];
			
			$nilai_kas_master = array(
				'kas_mst_lock' => '0',
				'kas_mst_dt' => 'KK',
				'kas_mst_nobuk' => $t_kas_mst_nobuk,
				'kas_mst_sts' => $this->input->post('btnKirim'),
				'kas_mst_tgl' => date('Y-m-d'),
				'kas_mst_pst' => $this->session->userdata('kode'),
				'kas_mst_noref' => $t_hut_mst_nobuk,
				'kas_mst_rek' => $this->input->post('t_kas_mst_rek'),
				'kas_mst_ttl' => -1*$this->input->post('t_kas_mst_ttl'),
				'kas_mst_ket' => strtoupper($this->input->post('t_kas_mst_ket'))
			);
			
			$nilai_hutang_master = array(
				'hut_mst_sts' => $this->input->post('btnKirim'),
				'hut_mst_ttl' => (-1*$t_hut_mst_ttl)+$this->input->post('t_kas_mst_ttl'),
				'hut_mst_lock' => '0'
			);
			
			$nilai_jurnal_k_master = array(
				'jrn_mst_lock' => '0',
				'jrn_mst_dt' => 'KK',
				'jrn_mst_nobuk' => $t_kas_mst_nobuk,
				'jrn_mst_noref' => $t_hut_mst_nobuk,
				'jrn_mst_pst' => $this->session->userdata('kode'),
				'jrn_mst_tgl' => date('Y-m-d'),
				'jrn_mst_rek' => $this->input->post('t_kas_mst_rek'),
				'jrn_mst_dk' => 'K',
				'jrn_mst_ttl' => $this->input->post('t_kas_mst_ttl'),
				'jrn_mst_ket' => strtoupper($this->input->post('t_kas_mst_ket'))
			);
			
			$nilai_jurnal_d_master = array(
				'jrn_mst_lock' => '0',
				'jrn_mst_dt' => 'KK',
				'jrn_mst_nobuk' => $t_kas_mst_nobuk,
				'jrn_mst_noref' => $t_hut_mst_nobuk,
				'jrn_mst_pst' => $this->session->userdata('kode'),
				'jrn_mst_tgl' => date('Y-m-d'),
				'jrn_mst_rek' => $t_hut_mst_rek,
				'jrn_mst_dk' => 'D',
				'jrn_mst_ttl' => $this->input->post('t_kas_mst_ttl'),
				'jrn_mst_ket' => strtoupper($this->input->post('t_kas_mst_ket'))
			);
			
			
			
			switch ($this->input->post('btnKirim')){
				case "CAIR":
					$this->form_validation->set_rules('t_kas_mst_rek','REKENING PENCAIRAN','required');
					$this->form_validation->set_rules('t_kas_mst_ket','KETERANGAN TAMBAHAN','required');
					$this->form_validation->set_rules('t_kas_mst_ttl','TOTAL PENCAIRAN','required|greater_than[0]|less_than_equal_to['.$maksimum.']');
					
					$this->form_validation->set_message('required','%s ngga boleh dikosongin');
					$this->form_validation->set_message('greater_than','%s harus lebih dari 0');
					$this->form_validation->set_message('less_than_equal_to','%s harus lebih kecil dari '.$maksimum.'');
					
					if($this->form_validation->run() == false){
						$validasi_e1 = array('validasi_e1' => validation_errors('<li>','</li>'));
						$this->session->set_userdata($validasi_e1);
					} else {
						$this->m_db->ubah_data($kondisi,$nilai_hutang_master,$this->TabelHutangMaster);
						$this->m_db->tambah_data($nilai_kas_master,$this->TabelKasMaster);
						
						$this->m_db->tambah_data($nilai_jurnal_d_master,$this->TabelJurnalMaster);
						$this->m_db->tambah_data($nilai_jurnal_k_master,$this->TabelJurnalMaster);
					}
					break;
			}
		}
		
		$this->m_db->ubah_data($kondisi,$nilai_master,$this->TabelHutangMaster);
		redirect($this->KePilihanE1);
		$this->kosong_operator_validasi();
	}
	
	function cari_jurnal(){
		$kondisi = array(
			'jrn_mst_nobuk' => $this->input->post('t_jrn_mst_nobuk')
		);
		$data['daftar_jurnal_master'] = $this->m_db->ambil_data_jurnal($kondisi)->result();
		
		$t_jrn_mst = array();
		
		foreach($data['daftar_jurnal_master'] as $jm){
			$t_jrn_mst[] = array(
					'jrnnobuk' => $jm->jrn_mst_nobuk,
					'jrntgl' => $jm->jrn_mst_tgl,
					'jrnrek' => $jm->jrn_mst_rek,
					'jrnketrek' => $jm->rek_mst_sub_gol.' '.$jm->rek_mst_ket_sub_kode,
					'jrndk' => $jm->jrn_mst_dk,
					'jrnttl' => 'Rp '. number_format($jm->jrn_mst_ttl,2,",",".")
			);
		}
		echo json_encode($t_jrn_mst);
		
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
}