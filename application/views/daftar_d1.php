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

$tombol_setuju = array(
		'name' => 'btnKirim',
		'value' => 'SETUJU',
		'class' => 'btn btn-lg btn-outline-dark'
);

$tombol_tolak = array(
		'name' => 'btnKirim',
		'value' => 'TOLAK',
		'class' => 'btn btn-lg btn-outline-dark'
);

$tombol_batal = array(
		'name' => 'btnKirim',
		'value' => 'BATAL',
		'class' => 'btn btn-lg btn-outline-dark'
);

$formulir_catatan = array(
	'name' => 't_cek_mst_ket',
	'class '=> 'form-control',
	'rows' => '3',
	'id' => 't_cek_mst_ket',
	'placeholder' => 'Bila di tolak, harus masukin alasan...'
);

$formulir_urut = array(
	'id' => 't_hutprm',
	'name' => 't_hutprm',
	'readonly' => 'true',
	'class '=> 'form-control'
);
$formulir_nobuk = array(
	'id' => 't_hut_mst_nobuk',
	'name' => 't_hut_mst_nobuk',
	'readonly' => 'true',
	'class '=> 'form-control'
);

$formulir_tgl = array(
	'id' => 't_hut_mst_tgl',
	'name' => 't_hut_mst_tgl',
	'disabled' => 'true',
	'class '=> 'form-control'
);
$formulir_tglrnc = array(
	'id' => 't_hut_mst_tglrnc',
	'name' => 't_hut_mst_tglrnc',
	'disabled' => 'true',
	'class' => 'form-control'
);
$formulir_pst = array(
	'id' => 't_hut_mst_pst',
	'name' => 't_hut_mst_pst',
	'disabled' => 'true',
	'class' => 'form-control'
);
$formulir_kel = array(
	'id' => 't_hut_mst_kel',
	'name' => 't_hut_mst_kel',
	'disabled' => 'true',
	'class' => 'form-control'
);
$formulir_rek = array(
	'id' => 't_hut_mst_rek',
	'name' => 't_hut_mst_rek',
	'disabled' => 'true',
	'class' => 'form-control'
);
$formulir_rnc = array(
	'id' => 't_hut_mst_rnc',
	'name' => 't_hut_mst_rnc',
	'disabled' => 'true',
	'class' => 'form-control'
);
$formulir_ket = array(
	'id' => 't_hut_mst_ket',
	'name' => 't_hut_mst_ket',
	'disabled' => 'true',
	'class' => 'form-control'
);

?>
<div class="container-fluid">
	<div class="card text-center">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" class="nav-link" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_d/pilihan_d1'?>"><strong>D1. VERIFIKASI</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_d/pilihan_d2'?>"><strong>D2. HISTORIS</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN ANGGARAN PROGRAM DAN BIAYA RUTIN
				</h5>
				<p class="card-text">
					<ul>
						<li>Tekan <strong>DETAIL</strong> di <strong>DAFTAR PENGAJUAN ANGGARAN</strong> untuk melakukan persetujuan.</li>
						<li>Periksa berkas yang dilampirkan saat pengajuan anggaran dengan menekan tombol <strong>UNDUH</strong> di <strong>DAFTAR PENGAJUAN ANGGARAN</strong>.</li>
						<li>Verifikator bisa pilih tombol <strong>TOLAK</strong> atau <strong>SETUJU</strong>, catatan tambahan diperlukan kalo pengajuan di tolak.</li>
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
										<th>JENIS</th>
										<th>KELOMPOK</th>
										<th>RENCANA</th>
										<th>KEGIATAN</th>
										<th>ANGGARAN</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_hutang_master as $hm){ ?>
									<tr>
										<td><?php echo $hm->hut_mst_nobuk ?></td>
										<td><?php echo $hm->rek_mst_kode ?></td>
										<td><?php echo $hm->kel_mst_subket ?></td>
										<td><?php echo $hm->hut_mst_tglrnc ?></td>
										<td><?php echo $hm->hut_mst_ket ?></td>
										<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
										<td>
											<a href="#" onclick="detail_hutang_ok('<?php echo $hm->hutprm; ?>')" class="btn btn-sm btn-outline-dark">DETAIL</a>
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
	<div class="modal" id="mdlCek" tabindex="-1" aria-labelledby="mdlCekLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<?php echo form_open('klik_d/ubah_hutang_ok','',$formulir_urut); ?>
				<div class="modal-header">
					<h5 class="modal-title" id="mdlCekLbl"><strong>VERIFIKASI</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-sm table-borderless">
						<tbody>
							<tr>
								<td><?php echo form_label('URUT'); ?></td>
								<td><?php echo form_input($formulir_urut); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('MUTASI'); ?></td>
								<td><?php echo form_input($formulir_nobuk); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('KEGIATAN'); ?></td>
								<td><?php echo form_input($formulir_ket); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('PENGAJU') ?></td>
								<td><?php echo form_input($formulir_pst); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('ANGGARAN') ?></td>
								<td><?php echo form_input($formulir_rnc); ?></td>
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
						echo form_submit($tombol_setuju);
						echo form_submit($tombol_tolak);
						echo form_submit($tombol_batal); 
					?>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var url_detail_hutang_ok = "<?php echo base_url()."index.php/klik_d/detail_hutang_ok/"?>";

$(document).ready(
function () {
	$('#tblHutDet').DataTable();
});

function detail_hutang_ok(t_hutprm){
	$.ajax({
		type: "POST",
		url: url_detail_hutang_ok,
		dataType: 'json',
		data: {hutprm:t_hutprm,hutlock:'0',hutf:'VER'},
		success: function(data){
			$('#t_hutprm').val(data[0].hutprm);
			$('#t_hut_mst_nobuk').val(data[0].hutnobuk);
			$('#t_hut_mst_tgl').val(data[0].huttgl);
			$('#t_hut_mst_tglrnc').val(data[0].huttglrnc);
			$('#t_hut_mst_pst').val(data[0].hutpst);
			$('#t_hut_mst_kel').val(data[0].hutkel);
			$('#t_hut_mst_rek').val(data[0].hutrek);
			$('#t_hut_mst_rnc').val(data[0].hutrnc);
			$('#t_hut_mst_ket').val(data[0].hutket);
			$('#mdlCek').modal('toggle');
		}
	})
}
</script>
</body>
</html>