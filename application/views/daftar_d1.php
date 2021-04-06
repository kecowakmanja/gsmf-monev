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
$formulir_nobuk = "";
$formulir_sts = "";
$formulir_tgl= "";
$formulir_tglrnc = "";
$formulir_pst = "";
$formulir_kel = "";
$formulir_rek = "";
$formulir_rnc = "";
$formulir_ket = "";
$formulir_dok = "";

if(!empty($this->session->userdata('operator_d1'))){
	if($this->session->userdata('operator_d1')!="TAMBAH"){
		foreach($daftar_hutang_master as $hm){
			$formulir_urut = $hm->hutprm;
			$formulir_nobuk = $hm->hut_mst_nobuk;
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
}

$formulir_catatan = array(
	'name' => 't_cek_mst_ket',
	'class '=> 'form-control form-control-sm',
	'rows' => '3'
	);

$tombol_setuju = array(
	'name' => 'btnKirim',
	'value' => 'SETUJU',
	'class' => 'btn btn-success btn-lg'
	);


$tombol_batal = array(
	'name' => 'btnKirim',
	'value'=> 'BATAL',
	'class'=> 'btn btn-primary btn-lg'
	);
	
$tombol_tolak = array(
	'name' => 'btnKirim',
	'value' => 'TOLAK',
	'class' => 'btn btn-danger btn-lg'
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
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_d/pilihan_d1'?>"><strong>D1. VERIFIKASI</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN ANGGARAN PROGRAM DAN BIAYA RUTIN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah, sila tekan tombol <strong>TAMBAH</strong> pada <strong>DETAIL KELOMPOK</strong>.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian.</li>
						<li><strong>JUDUL TABEL</strong> dapat di tekan untuk melakukan pengurutan untuk membantu permudah pencarian.</li>
						<li>Tombol operator <strong>DETAIL</strong> untuk melihat lebih detail sebelum melakukan ACC.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_d1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_d1') ?>
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
											<a href="<?php echo base_url().'index.php/klik_d/detail_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-primary">DETAIL</a>
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
							<strong>KOLOM PERSETUJUAN</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<table class="table table-sm table-borderless text-start">
								<tr>
									<td><?php echo form_label('NOMOR URUT'); ?></td>
									<td><?php echo form_label($formulir_urut); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENGAJUAN ANGGARAN'); ?></td>
									<td><?php echo form_label($formulir_nobuk); ?></td>
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
									<td><?php echo form_label($formulir_dok); ?></td>
								</tr>
							</table>
							<table class="table table-sm table-borderless text-center">
								<?php echo form_open('klik_d/ubah_hutang_ok','',$formulir_prm); ?>
								<tr>
									<td><?php echo form_label('CATATAN TAMBAHAN'); ?></td>
								</tr>	
								<tr>
									<td><?php echo form_textarea($formulir_catatan)?></td>
								</tr>
								<tr>
									<td>
										<div class="row justify-content-center">
											<div class="col col-sm-4">
												<?php 
												echo form_submit($tombol_tolak);
												echo form_submit($tombol_setuju);
												echo form_submit($tombol_batal);
												echo form_close(); 
												?>
											</div>
										</div>
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
var inputan1 = document.getElementById('isiDua');

function kasihfokuslah(){
	inputan1.scrollIntoView();
}

	$('#tblHutDet').DataTable({
	"order": [[ 3, "asc" ]]
});

</script>
</body>
</html>