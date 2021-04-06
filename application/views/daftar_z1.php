<!DOCTYPE html>
<html>
<head>
<title>HALAMANDEPAN-GSMF</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url().'assets/js/bootstrap.bundle.js'?>"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<h1><strong>GSMF-MONEV</h1></strong>
		</div>
		<div class="card-body">
			<div class="alert alert-success text-start">
				<p class="card-text">
					Hai <strong><?php echo $this->session->userdata('nama') ?></strong>
					anda sedang login sebagai <strong><?php echo $this->session->userdata('kode') ?></strong> dengan hak akses <strong><?php echo $this->session->userdata('hak') ?></strong>
					Pada waktu <strong><?php echo $this->session->userdata('tgl_masuk') ?></strong>.
					<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url().'index.php/klik_z/kepareng/'?>">PAMIT</a>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_z1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show">
					<?php echo $this->session->userdata('validasi_z1'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="<?php echo $this->session->unset_userdata('validasi_z1') ?>"></button>
				</div>
			<?php } ?>
			<div class="row align-items-start">
				<div class="col-sm-3">	
					<div class="card text-dark bg-warning">
						<div class="card-header">
							<strong>A. SETELAN AWAL</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-lg" aria-current="true" href="<?php echo base_url().'index.php/klik_a/index/'?>">
								DAFTAR BIDANG, TIMPEL, PENGGUNA dan POS-REKENING.
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning">
						<div class="card-header">
							<strong>B. ANGGARAN BELANJA</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-lg" aria-current="true" href="<?php echo base_url().'index.php/klik_b/index/'?>">
								PROGRAM DAN BIAYA RUTIN.
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning">
						<div class="card-header">
							<strong>C. ANGGARAN PENDAPATAN</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-lg" aria-current="true" href="<?php echo base_url().'index.php/c_rekening/index/'?>">
								ANGGARAN PENDAPATAN.
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning">
						<div class="card-header">
							<strong>D. VERIFIKASI</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-lg" aria-current="true" href="<?php echo base_url().'index.php/klik_d/index/'?>">
								VERIFIKASI PROPOSAL KEGIATAN DAN NOTA BIAYA RUTIN.
							</a>
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
</html>