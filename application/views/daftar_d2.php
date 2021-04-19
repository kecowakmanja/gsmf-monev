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

$formulir_catatan = array(
	'name' => 't_cek_mst_ket',
	'class '=> 'form-control',
	'rows' => '3',
	'id' => 't_cek_mst_ket',
	'placeholder' => 'Alasan tidak di sertakan...',
	'disabled' => 'true'
);

$formulir_nobuk = array(
	'id' => 't_cek_mst_nobuk',
	'name' => 't_cek_mst_nobuk',
	'disabled' => 'true',
	'class' => 'form-control'
);

$formulir_tgl = array(
	'id' => 't_cek_mst_tgl',
	'name' => 't_cek_mst_tgl',
	'disabled' => 'true',
	'class' => 'form-control'
);

$formulir_sts = array(
	'id' => 't_cek_mst_sts',
	'name' => 't_cek_mst_sts',
	'disabled' => 'true',
	'class' => 'form-control'
);

$tombol_batal = array(
		'name' => 'btnKirim',
		'value' => 'TUTUP',
		'data-bs-dismiss' => 'modal',
		'class' => 'btn btn-lg btn-outline-dark'
);
?>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_d/pilihan_d1'?>"><strong>D1. VERIFIKASI</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_d/pilihan_d2'?>"><strong>D2. HISTORIS</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN ANGGARAN PROGRAM DAN BIAYA RUTIN SELESAI VERIFIKASI
				</h5>
				<p class="card-text">
					<ul>
						<li>Berikut ini adalah daftar pengajuan anggaran yang sudah <strong>VERIFIKASI</strong>.</li>
						<li>Pengajuan dengan status <strong>SETUJU</strong>, bisa melanjutkan ke proses pencairan anggaran.</li>
						<li>Pengajuan dengan status <strong>TOLAK</strong>, bisa tekan tombol detail untuk melihat catatan tidak lolos validasinya.</li>
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
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DAFTAR PENGAJUAN ANGGARAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-hover" id="tblHutDet">
								<thead>
									<tr>
										<th>NO.MUTASI</th>
										<th>KELOMPOK</th>
										<th>JENIS</th>
										<th>HASIL</th>
										<th>TANGGAL</th>
										<th>RENCANA</th>
										<th>VERIFIKATOR</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_hutang_master as $hm){ ?>
									<tr>
										<td><?php echo $hm->hut_mst_nobuk ?></td>
										<td><?php echo $hm->kel_mst_subket ?></td>
										<td><?php echo $hm->rek_mst_kode ?></td>
										<td><?php echo $hm->per_mst_sts ?></td>
										<td><?php echo $hm->per_mst_tgl ?></td>
										<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
										<td><?php echo $hm->pst_mst_nm ?></td>
										<td>
											<a href="#" onclick="detail_hutang_ok('<?php echo $hm->hut_mst_nobuk ?>')" class="btn btn-sm btn-outline-dark">DETAIL</a>
											<a href="<?php echo base_url().'index.php/klik_d/unduh_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-outline-dark">UNDUH</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="modal" id="mdlVer" tabindex="-1" aria-labelledby="mdlVerLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdlVerLbl"><strong>HASIL</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-sm table-borderless">
						<tbody>
							<tr>
								<td><?php echo form_label('MUTASI'); ?></td>
								<td><?php echo form_input($formulir_nobuk); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('HASIL'); ?></td>
								<td><?php echo form_input($formulir_sts); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('TANGGAL VERIFIKASI') ?></td>
								<td><?php echo form_input($formulir_tgl); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('CATATAN') ?></td>
								<td><?php echo form_textarea($formulir_catatan); ?></td>
							</tr>
							
							
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<?php 
						echo form_submit($tombol_batal); 
					?>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url_detail_verifikasi_ok = "<?php echo base_url()."index.php/klik_d/detail_verifikasi_ok/"?>";

$(document).ready(
function () {
	$('#tblHutDet').DataTable();
});

function detail_hutang_ok(t_hut_mst_nobuk){
	$.ajax({
		type: "POST",
		url: url_detail_verifikasi_ok,
		dataType: 'json',
		data: {per_mst_nobuk:t_hut_mst_nobuk},
		success: function(data){
			$('#t_cek_mst_nobuk').val(data[0].pernobuk);
			$('#t_cek_mst_sts').val(data[0].persts);
			$('#t_cek_mst_tgl').val(data[0].pertgl);
			$('#t_cek_mst_ket').val(data[0].perket);
			$('#mdlVer').modal('toggle');
		}
	})
}


</script>
</body>
</html>