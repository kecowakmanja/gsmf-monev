<?php 
 
class M_db extends CI_Model{
	function ambil_data_hutang($kondisi){
		$this->db->select('*');
		$this->db->from('hutang_master as h');
		$this->db->join('rekening_master as r','r.rek_mst_sub_kode = h.hut_mst_rek');
		$this->db->join('kelompok_master as k','k.kel_mst_subkode = h.hut_mst_kel');
		$this->db->join('peserta_master as p','p.pst_mst_kode = h.hut_mst_pst');
		$this->db->where($kondisi);
		return $this->db->get();
	}
	
	function ambil_data_hutang_periksa($kondisi){
		$blmcair = array('BARU','SETUJU','TOLAK');
		$this->db->select('*');
		$this->db->from('hutang_master as h');
		$this->db->join('rekening_master as r','r.rek_mst_sub_kode = h.hut_mst_rek');
		$this->db->join('kelompok_master as k','k.kel_mst_subkode = h.hut_mst_kel');
		$this->db->join('peserta_master as p','p.pst_mst_kode = h.hut_mst_pst');
		$this->db->where($kondisi);
		$this->db->where_in('h.hut_mst_sts',$blmcair);
		return $this->db->get();
	}
	
	function ambil_data_hutang_cair($kondisi){
		$blmcair = array('SETUJU','CAIR');
		$this->db->select('*');
		$this->db->from('hutang_master as h');
		$this->db->join('rekening_master as r','r.rek_mst_sub_kode = h.hut_mst_rek');
		$this->db->join('kelompok_master as k','k.kel_mst_subkode = h.hut_mst_kel');
		$this->db->join('peserta_master as p','p.pst_mst_kode = h.hut_mst_pst');
		$this->db->where($kondisi);
		$this->db->where('hut_mst_rnc>hut_mst_ttl');
		$this->db->where_in('h.hut_mst_sts',$blmcair);
		return $this->db->get();
	}
	
	function ambil_data_peserta($kondisi,$tabel){
		$this->db->select('*');
		$this->db->from('peserta_master as pm');
		$this->db->join('kelompok_master as km','km.kel_mst_subkode = pm.pst_mst_kel','left');
		$this->db->where($kondisi);
		return $this->db->get();
	}
	
	function ambil_data_kas($kondisi){
		$this->db->select('*');
		$this->db->from('kas_master as k');
		$this->db->join('rekening_master as r','r.rek_mst_sub_kode = k.kas_mst_rek');
		$this->db->join('hutang_master as h','h.hut_mst_nobuk = k.kas_mst_noref','left');
		$this->db->join('kelompok_master as kl','kl.kel_mst_subkode = h.hut_mst_kel');
		$this->db->join('peserta_master as p','p.pst_mst_kode = h.hut_mst_pst');
		$this->db->where($kondisi);
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

	function ambil_data($kondisi,$tabel){
		$this->db->where($kondisi);
		return $this->db->get($tabel);
	}

	function ubah_data($kondisi,$nilai,$tabel){
		$this->db->where($kondisi);
		$this->db->set($nilai);
		$this->db->update($tabel);
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
	
	

}
