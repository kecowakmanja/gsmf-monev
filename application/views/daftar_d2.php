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
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_d/pilihan_d1'?>"><strong>D1. BELUM</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_d/pilihan_d2'?>"><strong>D2. SELESAI</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
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
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
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
										<th>HASIL</th>
										<th>TANGGAL</th>
										<th>RENCANA</th>
										<th>VERIFIKATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_hutang_master as $hm){ ?>
									<tr>
										<td><?php echo $hm->hut_mst_nobuk ?></td>
										<td><?php echo $hm->rek_mst_kode ?></td>
										<td><?php echo $hm->per_mst_sts ?></td>
										<td><?php echo $hm->per_mst_tgl ?></td>
										<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
										<td><?php echo $hm->pst_mst_nm ?></td>
									</tr>
									<?php } ?>
								</tbody>
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

$(document).ready(
function () {
	$('#tblHutDet').DataTable();
});


</script>
</body>
</html>