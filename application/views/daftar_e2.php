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
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_e/pilihan_e1'?>"><strong>E1. REALISASI</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_e/pilihan_e2'?>"><strong>E2. DAFTAR</strong></a>
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
			<?php if(!empty($this->session->userdata('validasi_e2'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_e2') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DAFTAR MUTASI KAS DAN SETARA KAS</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblKasDet">
								<thead>
									<tr>
										<th>URUT</th>
										<th>NO.MUTASI</th>
										<th>NO.REFERENSI</th>
										<th>JENIS</th>
										<th>TANGGAL</th>
										<th>STATUS</th>
										<th>NOMINAL</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_kas_master as $km){ ?>
									<tr>
										<td><?php echo $km->kasprm; ?></td>
										<td><?php echo $km->kas_mst_nobuk ?></td>
										<td><?php echo $km->kas_mst_noref ?></td>
										<td><?php echo $km->rek_mst_ket_sub_kode ?></td>
										<td><?php echo $km->kas_mst_tgl ?></td>
										<td><?php echo $km->kas_mst_sts ?></td>
										<td><?php echo 'Rp'. number_format($km->kas_mst_ttl,2,",",".") ?></td>
										<td>
											<a href="<?php echo base_url().'index.php/klik_e/detail_kas_ok/'.$km->kasprm ?>" class="btn btn-sm btn-primary" onClick="kasihfokuslah()">DETAIL</a>
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
		<div class="card-footer text-muted">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#tblKasDet').DataTable({
	"order": [[ 0, "asc" ]]
});

</script>
</body>
</html>