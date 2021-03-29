<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class C_hutang extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_db');
		if($this->session->userdata('status')!="masuk"){
			redirect('c_depan/index');
		} 
	}
 
	function index(){
		redirect('c_hutang/daftar_hutang');
	}

	function daftar_hutang(){
		$this->session->unset_userdata('validasi');
		if($this->session->userdata('kelompok')=="ROOT"){
			$kondisi="1=1";
		}
		else{
			$kondisi = array(
				'p.pgn_mst_kel'=>$this->session->userdata('kelompok')
			);
		};
		$data['daftar_hutang_master'] = $this->m_db->ambil_data_hutang($kondisi)->result();
		$this->load->view('v_hutang.php',$data);
	}

	function tambah_hutang($nobukti){

		$kondisi1 = array(
			'rek_mst_gol' => "BEBAN", 
			'rek_mst_sts' => "AKTIF"
		);
		$kondisi2 = array(
			'hut_det_nobuk' => $nobukti
		);
		$kondisi3 = array(
			'hut_mst_nobuk' => $nobukti
		);

		$tabel1 = "rekening_master";
		$tabel2 = "hutang_detail";
		$tabel3 = "hutang_master";
		$data['daftar_hutang_detail'] = $this->m_db->ambil_data_hutang_detail($kondisi3)->result();
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi3,$tabel3)->result();
		$data['daftar_rekening_master'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();

		$t_kosong ="";

		if(empty($data['daftar_hutang_master'])){
			$hut_mst_nobuk_kosong = (object)[
				'hut_mst_nobuk' => $nobukti,
				'hut_mst_ket' => $t_kosong,
				'hut_mst_tglrnc' => date('Y-m-d')
			];
			$data['daftar_hutang_master']=[$hut_mst_nobuk_kosong];
		}

		$t_lock = 1;
		$nilai2 = array('hut_det_lock' => $t_lock);
		$nilai3 = array('hut_mst_lock' => $t_lock);
		
		$this->m_db->ubah_data($kondisi3,$nilai3,$tabel3);
		$this->m_db->ubah_data($kondisi2,$nilai2,$tabel2);

		$this->load->view('v_hutang_t.php',$data);
	}

	function tambah_hutang_ok(){
		$t_lock1 = 1;
		$t_lock0 = 0;
		$t_hut_mst_nobuk = $this->input->post('t_hut_mst_nobuk');
		$t_hut_mst_dt = "AGR";
		$t_hut_mst_sts = "BARU";
		$t_hut_mst_tgl = date('Y-m-d');
		$t_hut_mst_tglrnc = $this->input->post('t_hut_mst_tglrnc');
		$t_hut_mst_pgn = $this->session->userdata('kode');
		$t_hut_mst_ttl = "0";
		$t_hut_mst_ket = $this->input->post('t_hut_mst_ket');
		
		$t_hut_det_dt = "AGR";
		$t_hut_det_nobuk = $this->input->post('t_hut_mst_nobuk');
		$t_hut_det_rek = $this->input->post('t_hut_det_rek');
		$t_hut_det_rnc = $this->input->post('t_hut_det_rnc');
		$tabel_detail = "hutang_detail";
		$tabel_master = "hutang_master";

		$nilai_detail_hitung = "hut_det_rnc";
		$t_nama_tombol = $this->input->post('btnKirim');

		$prefix1 = $t_hut_mst_dt;
		$prefix2 = date('Ymd');
		$prefix3 = $t_hut_mst_tgl;
		$prm1 = "hut_mst_dt";
		$prm2 = "hut_mst_nobuk";
		$prm3 = "hut_mst_tgl";
		$separator = "-";

		$kondisi1 = array('hut_mst_nobuk' => $t_hut_mst_nobuk);
		$kondisi2 = array('hut_det_nobuk' => $t_hut_mst_nobuk);
		
		if($t_nama_tombol=="TAMBAH"){
			$this->form_validation->set_rules('t_hut_det_rek','REKENING BEBAN','required');
			$this->form_validation->set_rules('t_hut_mst_ket','KETERANGAN','required');
			$this->form_validation->set_rules('t_hut_mst_tglrnc','RENCANA KEGIATAN','required');
			$this->form_validation->set_rules('t_hut_det_rnc','RENCANA ANGGARAN','required|greater_than[0]');

			if($this->form_validation->run() == false){
				$pesan_validasi_gagal = array(
					'validasi' => "WAJIB=Semua Field Wajib Di isi"
				);
				$this->session->set_userdata($pesan_validasi_gagal);
				redirect('c_hutang/tambah_hutang/'.$t_hut_mst_nobuk);
			} else {
				$this->session->unset_userdata('validasi');
				if ($t_hut_mst_nobuk=="KOSONG"){
					$data['no_bukti'] = $this->m_db->ambil_data_urut($tabel_master,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3)->result();
					if (empty($data['no_bukti'])){
							$data_no_bukti_acak = ['urut'=>$prefix1.$separator.$prefix2.$separator.str_pad(floor(rand(0,99999)),5,"0",STR_PAD_LEFT)];
							$data['no_bukti'][]=(object)$data_no_bukti_acak;
					}
					
					foreach ($data['no_bukti'] as $nb){
						$t_hut_mst_nobuk = $nb->urut;
					}

					$nilai_master = array(
						'hut_mst_lock' => $t_lock1,
						'hut_mst_dt' => $t_hut_mst_dt,
						'hut_mst_nobuk' => $t_hut_mst_nobuk,
						'hut_mst_sts' => $t_hut_mst_sts,
						'hut_mst_tgl' => $t_hut_mst_tgl,
						'hut_mst_tglrnc' => $t_hut_mst_tglrnc,
						'hut_mst_pgn' => $t_hut_mst_pgn,
						'hut_mst_rnc' => $t_hut_det_rnc,
						'hut_mst_ttl' => $t_hut_mst_ttl,
						'hut_mst_ket' => strtoupper($t_hut_mst_ket)
					);
					$this->m_db->tambah_data($nilai_master,$tabel_master);
				}
				
				$nilai_detail = array(
					'hut_det_lock' => $t_lock1,
					'hut_det_dt' => $t_hut_det_dt,
					'hut_det_nobuk' => $t_hut_mst_nobuk,
					'hut_det_rek' => $t_hut_det_rek,
					'hut_det_rnc' => $t_hut_det_rnc,
				);
				$this->m_db->tambah_data($nilai_detail,$tabel_detail);

				$data['total_rencana_anggaran']=$this->m_db->hitung_data($kondisi2,$nilai_detail_hitung,$tabel_detail)->result();
				foreach($data['total_rencana_anggaran'] as $tra){
					$t_hut_mst_rnc = $tra->hut_det_rnc;
				}
				$total_rencana = array ('hut_mst_rnc' => $t_hut_mst_rnc);
				$this->m_db->ubah_data($kondisi1,$total_rencana,$tabel_master);
			}
			redirect('c_hutang/tambah_hutang/'.$t_hut_mst_nobuk);
		} else {
			if($t_hut_mst_nobuk!="KOSONG"){
				$nilai1 = array(
					'hut_mst_lock' => $t_lock0,
					'hut_mst_ket' => $t_hut_mst_ket, 
					'hut_mst_tglrnc' => $t_hut_mst_tglrnc,
				);
				$nilai2 = array(
					'hut_det_lock' => $t_lock0
				);
				$this->m_db->ubah_data($kondisi1,$nilai1,$tabel_master);
				$this->m_db->ubah_data($kondisi2,$nilai2,$tabel_detail);
			}
			redirect('c_hutang/index/');
		}
	}

	function hapus_hutang_ok($hutprm){
		$kondisi = array('hutprm' => $hutprm);
		$tabel_master = "hutang_master";
		$tabel_detail = "hutang_detail";

		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi,$tabel_master)->result();

		foreach ($data['daftar_hutang'] as $h){
			$t_hut_mst_lock = $h->hut_mst_lock;
			$t_hut_mst_sts = $h->hut_mst_sts;
			$t_hut_mst_nobuk = $h->hut_mst_nobuk;
		}

		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock != 0){
			$pesan_operator_gagal = array(
				'operator' => "GAGAL=Pengajuan Anggaran Sedang Dalam Proses"
			);
			$this->session->set_userdata($pesan_operator_gagal);
			redirect('c_hutang/index/');
		} else {
			$this->session->unset_userdata('operator');
			$kondisi_master = array('hut_mst_nobuk'=>$t_hut_mst_nobuk);
			$kondisi_detail = array('hut_det_nobuk'=>$t_hut_mst_nobuk);

			$this->m_db->hapus_data($kondisi_master,$tabel_master);
			$this->m_db->hapus_data($kondisi_detail,$tabel_detail);
			redirect('c_hutang/index/');
		}
	}

	function ubah_hutang($hutprm){
		$kondisi1 = array('hutprm' => $hutprm);
		$tabel1 = "hutang_master";
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();

		foreach ($data['daftar_hutang_master'] as $hm){
			$t_hut_mst_lock = $hm->hut_mst_lock;
			$t_hut_mst_sts = $hm->hut_mst_sts;
			$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		}

		if ($t_hut_mst_sts != "BARU" || $t_hut_mst_lock!=0){
			$pesan_operator_gagal = array(
				'operator' => "GAGAL=Pengajuan Anggaran Sedang Dalam Proses"
			);
			$this->session->set_userdata($pesan_operator_gagal);
			redirect('c_hutang/index/');
		} else {
			$this->session->unset_userdata('operator');
			redirect('c_hutang/tambah_hutang/'.$t_hut_mst_nobuk);
		}
	}

	function hapus_hutang_detail_ok($hutprm,$t_hut_mst_nobuk){
		$kondisi3 = array('hutprm'=>$hutprm);
		$tabel1 = "hutang_master";
		$tabel2 = "hutang_detail";
		$nilai_detail_hitung = "hut_det_rnc";
		$kondisi1 = array('hut_mst_nobuk' => $t_hut_mst_nobuk);
		$kondisi2 = array('hut_det_nobuk' => $t_hut_mst_nobuk);

		$this->m_db->hapus_data($kondisi3,$tabel2);

		$data['total_rencana_anggaran']=$this->m_db->hitung_data($kondisi2,$nilai_detail_hitung,$tabel2)->result();
		foreach($data['total_rencana_anggaran'] as $tra){
			$t_hut_mst_rnc = $tra->hut_det_rnc;
		}
		$total_rencana = array ('hut_mst_rnc' => $t_hut_mst_rnc);
		$this->m_db->ubah_data($kondisi1,$total_rencana,$tabel1);
		redirect('c_hutang/tambah_hutang/'.$t_hut_mst_nobuk);
	}
 
	function detail_hutang($nobukti){
		$kondisi1 = array('hut_mst_nobuk' => $nobukti);
		$kondisi2 = array('hut_det_nobuk' => $nobukti);
		$tabel1 = "hutang_master";
		$tabel2 = "hutang_detail";
		$data['daftar_hutang_master'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();
		$data['daftar_hutang_detail'] = $this->m_db->ambil_data_hutang_detail($kondisi1)->result();

		$t_lock = 1;
		$nilai2 = array('hut_det_lock' => $t_lock);
		$nilai1 = array('hut_mst_lock' => $t_lock);

		$data['daftar_hutang'] = $this->m_db->ambil_data($kondisi1,$tabel1)->result();

		foreach ($data['daftar_hutang'] as $h){
			$t_hut_mst_lock = $h->hut_mst_lock;
			$t_hut_mst_sts = $h->hut_mst_sts;
			$t_hut_mst_nobuk = $h->hut_mst_nobuk;
		}

		if ($t_hut_mst_lock != 0){
			$pesan_operator_gagal = array(
				'operator' => "GAGAL=Pengajuan Anggaran Sedang Dalam Proses"
			);
			$this->session->set_userdata($pesan_operator_gagal);
			redirect('c_hutang/index/');
		} else {
			$this->session->unset_userdata('operator');
			$this->m_db->ubah_data($kondisi1,$nilai1,$tabel1);
			$this->m_db->ubah_data($kondisi2,$nilai2,$tabel2);
			$this->load->view('v_hutang_d',$data);
		}
	}

	function detail_hutang_ok(){
		$nobukti = $this->input->post('t_hut_mst_nobuk');
		$t_nama_tombol=$this->input->post('btnKirim');
		$tabel1="hutang_master";
		$tabel2="hutang_detail";
		$tabel3="cek_master";
		$tabel4="cek_detail";
		$kondisi1 = array('hut_mst_nobuk' => $nobukti);
		$kondisi2 = array('hut_det_nobuk' => $nobukti);
		$kondisi3 = array('cek_mst_nobuk' => $nobukti);
		$t_lock0=0;

		$nilai1 = array(
			'hut_mst_lock' => $t_lock0,
		);
		$nilai2 = array(
			'hut_det_lock' => $t_lock0
		);
		$nilai3 = array(
			'hut_mst_sts' => $t_nama_tombol
		);
		$this->m_db->ubah_data($kondisi1,$nilai1,$tabel1);
		$this->m_db->ubah_data($kondisi2,$nilai2,$tabel2);
		if($t_nama_tombol!="BATAL"){
			$this->m_db->ubah_data($kondisi1,$nilai3,$tabel1);

			$data['hutang_master']=$this->m_db->ambil_data($kondisi1,$tabel1)->result();
			foreach($data['hutang_master'] as $cm){
				$t_cek_mst_lock = $t_lock0;
				$t_cek_mst_dt = $cm->hut_mst_dt;
				$t_cek_mst_nobuk = $cm->hut_mst_nobuk;
				$t_cek_mst_sts = $cm->hut_mst_sts;
				$t_cek_mst_tgl = date('Y-m-d');
				$t_cek_mst_pgn = $this->session->userdata('kode');
				$t_cek_mst_ket = strtoupper($this->input->post('t_cek_mst_ket'));
			};

			$data['cek_master']=$this->m_db->ambil_data($kondisi3,$tabel3)->result();
			$nilai4 = array(
				'cek_mst_lock' => $t_cek_mst_lock,
				'cek_mst_dt' => $t_cek_mst_dt,
				'cek_mst_nobuk' => $t_cek_mst_nobuk,
				'cek_mst_sts' => $t_cek_mst_sts,
				'cek_mst_tgl' => $t_cek_mst_tgl,
				'cek_mst_pgn' => $t_cek_mst_pgn,
				'cek_mst_ket' => $t_cek_mst_ket
			);
			$nilai5 = array(
				'cek_det_lock' => $t_cek_mst_lock,
				'cek_det_dt' => $t_cek_mst_dt,
				'cek_det_nobuk' => $t_cek_mst_nobuk,
				'cek_det_tgl' => $t_cek_mst_tgl,
				'cek_det_sts' => $t_cek_mst_sts
			);
			
			if(empty($data['cek_master'])){	
				$this->m_db->tambah_data($nilai4,$tabel3);
			} else {
				$this->m_db->ubah_data($kondisi3,$nilai4,$tabel3);
			}
			
			$this->m_db->tambah_data($nilai5,$tabel4);
		}
		redirect('c_hutang/index/');

	}

}