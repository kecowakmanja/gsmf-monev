<!DOCTYPE html>
<html>
<head>
	<title>HALAMANDEPAN-GSMF</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url().'assets/css/bs-jq.css'?>" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url().'assets/js/bootstrap.bundle.js'?>"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	
</head>
<body>
<?php

$formulir_prm = array();
$formulir_urut = "";
$formulir_nobuk_hut = "";
$formulir_sts = "";
$formulir_tgl= "";
$formulir_tglrnc = "";
$formulir_pst = "";
$formulir_kel = "";
$formulir_rek = "";
$formulir_rnc = "";
$formulir_ket = "";
$formulir_dok = "";

foreach($daftar_rekening_master as $rm){
		$rekkode[$rm->rek_mst_sub_kode] = $rm->rek_mst_ket_sub_kode;
}
		
$formulir_kas = array(
	'name' => 't_kas_mst_rek',
	'options' => $rekkode,
	'class' => 'form-control',
	'id' => 't_kas_mst_rek'
	);
	
$formulir_cair = array(
	'name' => 't_kas_mst_ttl',
	'type' => 'number',
	'class' => 'form-control',
	'value' => '0',
	'id' => 't_kas_mst_ttl'
	);

if($this->session->userdata('operator_e1') == "UBAH" && empty($this->session->userdata('validasi_e1'))){
	foreach($daftar_hutang_master as $hm){
		$formulir_urut = $hm->hutprm;
		$formulir_nobuk_hut = $hm->hut_mst_nobuk;
		$formulir_sts = $hm->hut_mst_sts;
		$formulir_tgl = $hm->hut_mst_tgl;
		$formulir_tglrnc = $hm->hut_mst_tglrnc;
		$formulir_pst = $hm->pst_mst_nm;
		$formulir_kel = $hm->kel_mst_ket;
		$formulir_rek = $hm->rek_mst_ket_sub_kode;
		$formulir_rnc = 'Rp. '.number_format($hm->hut_mst_rnc,2,",",".");
		$formulir_ket = $hm->hut_mst_ket;
		$formulir_dok = $hm->hut_mst_dok;
		
					
		$formulir_prm = array(
		"hutprm" => $hm->hutprm
		);
	}
}

$formulir_catatan = array(
	'name' => 't_cek_mst_ket',
	'class '=> 'form-control form-control-sm',
	'rows' => '3'
	);
	
$formulir_nobuk = array(
		'name' => 't_kas_mst_nobuk',
		'class' => 'form-control',
		'readonly' => 'true',
		'id' => 't_kas_mst_nobuk'
	);

$tombol_cair = array(
	'name' => 'btnKirim',
	'value' => 'CAIR',
	'class' => 'btn btn-primary btn-sm'
	);


$tombol_batal = array(
	'name' => 'btnKirim',
	'value'=> 'BATAL',
	'class'=> 'btn btn-danger btn-sm'
	);
	
$tombol_unduh = array(
	"name" => "btnProses",
	"value" => "UNDUH",
	"class" => "btn btn-sm btn-warning"
);

?>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_e/pilihan_e1'?>"><strong>E1. REALISASI</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_e/pilihan_e2'?>"><strong>E2. DAFTAR</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					REALISASI ANGGARAN PROGRAM DAN BIAYA RUTIN
				</h5>
				<p class="card-text">
					<ul>
						<li>Tekan <strong>DETAIL</strong> di <strong>DAFTAR PENGAJUAN ANGGARAN</strong> dulu supaya bisa cairkan anggaran.</li>
						<li>Jangan sampai salah pilih <strong>POS REKENING</strong>.</li>
						<li><strong>BESAR PENCAIRAN</strong> yaitu sebesar sisa rencana anggaran.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_e1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_e1') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DAFTAR PENGAJUAN ANGGARAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblHutDet">
								<thead>
									<tr>
										<th>URUT</th>
										<th>NO.MUTASI</th>
										<th>JENIS</th>
										<th>STATUS</th>
										<th>PELAKSANAAN</th>
										<th>RENCANA</th>
										<th>CAIR</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_hutang_master as $hm){ ?>
									<tr>
										<td><?php echo $hm->hutprm; ?></td>
										<td><?php echo $hm->hut_mst_nobuk ?></td>
										<td><?php echo $hm->rek_mst_kode ?></td>
										<td><?php echo $hm->hut_mst_sts ?></td>
										<td><?php echo $hm->hut_mst_tglrnc ?></td>
										<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
										<td><?php echo 'Rp'. number_format($hm->hut_mst_ttl,2,",",".") ?></td>
										<td>
											<a href="<?php echo base_url().'index.php/klik_e/detail_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-primary" onClick="kasihfokuslah()">DETAIL</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="accordion">
				<div class="accordion-item" id="frmHutDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>KOLOM REALISASI</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<table class="table table-sm text-start table-light">
								<?php echo form_open('klik_d/proses_hutang_ok','',$formulir_prm); ?>
								<tr>
									<td><?php echo form_label('NOMOR URUT'); ?></td>
									<td><?php echo form_label($formulir_urut); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENGAJUAN ANGGARAN'); ?></td>
									<td><?php echo form_label($formulir_nobuk_hut); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('STATUS'); ?></td>
									<td><?php echo form_label($formulir_sts); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TANGGAL PENGAJUAN'); ?></td>
									<td><?php echo form_label($formulir_tgl); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TANGGAL PELAKSANAAN'); ?></td>
									<td><?php echo form_label($formulir_tglrnc); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('PENGAJU'); ?></td>
									<td><?php echo form_label($formulir_pst); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KELOMPOK'); ?></td>
									<td><?php echo form_label($formulir_kel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('POS ANGGARAN'); ?></td>
									<td><?php echo form_label($formulir_rek); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('RENCANA ANGGARAN'); ?></td>
									<td><?php echo form_label($formulir_rnc); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NAMA PROPOSAL KEGIATAN'); ?></td>
									<td><?php echo form_label($formulir_ket); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('BERKAS PENDUKUNG'); ?></td>
									<td><?php 
										echo form_label($formulir_dok); 
										?>
									</td>
									<td><?php
										echo form_submit($tombol_unduh);
										echo form_close();
										?>
									</td>
								</tr>
							</table>
							<table class="table table-sm text-start table-bordered table-light">
								<?php echo form_open('klik_e/ubah_hutang_ok','',$formulir_prm); ?>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENCAIRAN ANGGARAN'); ?></td>
									<td><?php echo form_input($formulir_nobuk); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('POS REKENING'); ?></td>
									<td><?php echo form_dropdown($formulir_kas); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('BESAR PENCAIRAN'); ?></td>
									<td><?php echo form_input($formulir_cair); ?></td>
								</tr>
								<tr>
									<td>
									</td>
									<td>
										<?php 
										echo form_submit($tombol_cair);
										echo form_submit($tombol_batal);
										echo form_close();
										?>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer text-muted">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#tblHutDet').DataTable({
	"order": [[ 3, "asc" ]]
});

</script>
</body>
</html>