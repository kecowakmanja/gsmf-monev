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
<body onload="kasihfokuslah()">
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_b/index'?>"><strong>B1. PROGRAM</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_b/tambah_hutang/'?>"><strong>B2. RUTIN</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN ANGGARAN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk mengisi formulir pengajuan anggaran, sila tekan <strong>TAMBAH</strong> pada baris navigasi.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian pengajuan anggaran.</li>
						<li><strong>JUDUL TABEL</strong> dapat di tekan untuk melakukan pengurutan untuk membantu permudah pencarian.</li>
						<li>Tombol operator <strong>UBAH</strong>, <strong>HAPUS</strong>, <strong>DETAIL</strong>, untuk melakukan perubahan, menghapus dan melihat detail pengajuan.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('operator'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show">
					<?php echo $this->session->userdata('operator'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="<?php echo $this->session->unset_userdata('operator') ?>"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL PROGRAM</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table" id="tblHut">
									<thead>
										<tr>
											<th>URUT</th>
											<th>NO.MUTASI</th>
											<th>KELOMPOK</th>
											<th>STATUS</th>
											<th>WAKTU</th>
											<th>KETERANGAN</th>
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
											<td><?php echo $hm->kel_mst_subket ?></td>
											<td><?php echo $hm->hut_mst_sts ?></td>
											<td><?php echo $hm->hut_mst_tglrnc ?></td>
											<td><?php echo $hm->hut_mst_ket ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_ttl,2,",",".") ?></td>
											<td>
												<a href="<?php echo base_url().'index.php/klik_b/ubah_hutang/'.$hm->hutprm ?>" class="btn btn-sm btn-warning">UBAH</a>
												<a href="<?php echo base_url().'index.php/klik_b/hapus_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-danger">HAPUS</a>
												<a href="<?php echo base_url().'index.php/klik_b/detail_hutang/'.$hm->hut_mst_nobuk ?>" class="btn btn-sm btn-primary">DETAIL</a>
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
		</div>
		<div class="card-footer text-muted">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
$(document).ready(
function () {
	$('#tblHut').DataTable();
});


function kasihfokuslah(){
	inputan1.focus();
}

</script>

</html>