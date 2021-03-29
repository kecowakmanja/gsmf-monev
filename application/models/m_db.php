<?php 
 
class M_db extends CI_Model{
	function ambil_data_hutang($kondisi){
		$this->db->select('*');
		$this->db->from('hutang_master as h');
		$this->db->join('peserta_master as p','p.pst_mst_kode = h.hut_mst_pst');
		$this->db->join('kelompok_master as k','k.kel_mst_subkode = p.pst_mst_kel');
		$this->db->where($kondisi);
		return $this->db->get();
	}

	function ambil_data_hutang_detail($kondisi){
		$this->db->select('hd.*, rm.*');
		$this->db->from('hutang_master as hm');
		$this->db->join('hutang_detail as hd','hd.hut_det_nobuk = hm.hut_mst_nobuk');
		$this->db->join('rekening_master as rm','rm.rek_mst_kode = hd.hut_det_rek');
		$this->db->where($kondisi);
		return $this->db->get();
	}
	
	function ambil_data_hutang_setuju(){
		$blmcair = array('BARU');
		$this->db->select('*');
		$this->db->from('hutang_master as h');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where_in('h.hutsts',$blmcair);
		return $this->db->get();
	}

	function ambil_data_hutang_setuju_saring($saring){
		$this->db->select('*');
		$this->db->from('hutang as h');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->like($saring);
		return $this->db->get();
	}

	function ambil_data_hutang_cair(){
		$where_in = array('SETUJU','CAIR');
		$this->db->select('*');
		$this->db->from('hutang as h');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where_in('h.hutsts',$where_in);
		return $this->db->get();
	}

	function ambil_data_hutang_cair_saring($saring){
		$where_in = array('SETUJU','CAIR');
		$this->db->select('*');
		$this->db->from('hutang as h');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where_in('h.hutsts',$where_in);
		$this->db->like($saring);
		return $this->db->get();
	}

	function ambil_data_hutang_cair_ok($kondisi,$tabel){
		$this->db->select('*');
		$this->db->from('hutang as h');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where($kondisi);
		return $this->db->get();
	}

	
	function ambil_data_kas(){
		$where_in = array('KK');
		$this->db->select('m.*,p.*,h.*,rk.rekprm as rkrekprm, rk.rekket as rkrekket, rb.rekprm as rbrekprm, rb.rekket as rbrekket');
		$this->db->from('mutasi as m');
		$this->db->join('peserta as p','p.pgnprm = m.mtspgnprm');
		$this->db->join('rekening as rk','rk.rekprm = m.mtsrekprm');
		$this->db->join('hutang as h','h.hutprm = m.mtshutpiuprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where_in('m.mtsdt',$where_in);
		return $this->db->get();
	}

	function ambil_data_kas_saring($saring){
		$where_in = array('KK');
		$this->db->select('m.*,p.*,h.*,rk.rekprm as rkrekprm, rk.rekket as rkrekket, rb.rekprm as rbrekprm, rb.rekket as rbrekket');
		$this->db->from('mutasi as m');
		$this->db->join('peserta as p','p.pgnprm = m.mtspgnprm');
		$this->db->join('rekening as rk','rk.rekprm = m.mtsrekprm');
		$this->db->join('hutang as h','h.hutprm = m.mtshutpiuprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where_in('m.mtsdt',$where_in);
		$this->db->like($saring);
		return $this->db->get();
	}

	function ambil_data_seperti_kondisi($kondisi,$seperti,$kelompok,$tabel){
		$this->db->like($seperti);
		$this->db->where($kondisi);
		$this->db->limit(10);
		$this->db->group_by($kelompok);
		return $this->db->get($tabel);
	}

	function ambil_data_seperti($seperti,$kelompok,$tabel){
		$this->db->like($seperti);
		$this->db->limit(10);
		$this->db->group_by($kelompok);
		return $this->db->get($tabel);
	}

	function ubah_data($kondisi,$nilai,$tabel){
		$this->db->where($kondisi);
		$this->db->set($nilai);
		$this->db->update($tabel);
	}

	function ambil_data($kondisi,$tabel){
		$this->db->where($kondisi);
		return $this->db->get($tabel);
	}

	function tambah_data($nilai,$tabel){
		$this->db->insert($tabel,$nilai);
	}

	function hapus_data($kondisi,$tabel){
		$this->db->where($kondisi);
		$this->db->delete($tabel);
	}

	function hitung_data($kondisi,$nilai,$tabel){
		$this->db->select_sum($nilai);
		$this->db->where($kondisi);
		return $this->db->get($tabel);
	}

	function ambil_data_urut($tabel,$prefix1,$prefix2,$prefix3,$separator,$prm1,$prm2,$prm3){
		$this->db->select("CONCAT('$prefix1','$separator',$prefix2,'$separator',(LPAD(FLOOR(RAND()*99999),5,0))) as urut",FALSE);
		$this->db->from("$tabel as a");
		$this->db->join("$tabel as b","b.$prm1='$prefix1' and b.$prm2='a.urut' and b.$prm3='$prefix3'","left");
		$this->db->where("a.$prm1='$prefix1'");
		$this->db->where("a.$prm3='$prefix3'");
		$this->db->where("b.$prm2 is null");
		$this->db->limit('1');
		return $this->db->get();
	}
	
	function ambil_data_acc($kondisi,$tabel){
		$this->db->select('*');
		$this->db->from('acc as a');
		$this->db->join('hutang as h','h.hutprm = a.acchutpiuprm');
		$this->db->join('peserta as p','p.pgnprm = h.hutpgnprm');
		$this->db->join('rekening as rb','rb.rekprm = h.hutrekprm');
		$this->db->where($kondisi);
		return $this->db->get();
	}

	function ambil_data_peserta($kondisi,$tabel){
		$this->db->select('*');
		$this->db->from('peserta_master as pm');
		$this->db->join('kelompok_master as km','km.kel_mst_subkode = pm.pst_mst_kel');
		$this->db->where($kondisi);
		return $this->db->get();
	}

}
