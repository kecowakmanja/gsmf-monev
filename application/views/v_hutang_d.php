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
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link disabled" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="<?php echo base_url().'index.php/c_hutang/index'?>"><strong>DAFTAR</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#"><strong>DETAIL</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					FORMULIR PENGAJUAN ANGGARAN
				</h5>		
				<p class="card-text">
					<ul>
						<li>Periksa kembali pengajuan anggaran yang sudah di isi di <strong>TABEL ANGGARAN</strong> sebelum menekan tombol <strong>SETUJU</strong>.</li>
						<li>Anggaran yang sudah di-<strong>SETUJU</strong>-i, tidak bisa di batalkan maupun dirubah-rubah.</li>
						<li>Simpan baik-baik <strong>NOMOR BUKTI PENGAJUAN ANGGARAN</strong> untuk mempermudah proses verifikasi dan pencairan anggaran.</li>						
					</ul>
				</p>
			</div>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmHutDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL ANGGARAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-borderless table-light">
								<?php 
								foreach ($daftar_hutang_master as $hm){
									$nobuk = $hm->hut_mst_nobuk;
									$ket = $hm->hut_mst_ket;
									$tglrnc = $hm->hut_mst_tglrnc;
									$totrnc = $hm->hut_mst_rnc;
								}

								$t_hut_mst_nobuk = array('t_hut_mst_nobuk'=>$nobuk);

								echo form_open('c_hutang/detail_hutang_ok','',$t_hut_mst_nobuk);
								?>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENGAJUAN ANGGARAN'); ?></td>
									<td><?php echo form_label($nobuk); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NAMA PROPOSAL KEGIATAN'); ?></td>
									<td><?php echo form_label($ket); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TANGGAL PELAKSANAAN'); ?></td>
									<td><?php echo form_label($tglrnc); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TOTAL RENCANA ANGGARAN'); ?></td>
									<td><?php echo form_label('Rp'). number_format($totrnc,2,",","."); ?></td>
								</tr>
							</table>
							<table class="table table-sm table-hover" id="tblHutDet">
								<thead>
									<tr>
										<th>URUT</th>
										<th>KODE REKENING</th>
										<th>POS</th>
										<th>RENCANA</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($daftar_hutang_detail as $hd){ ?>
										<tr>
											<td><?php echo $hd->hutprm; ?></td>
											<td><?php echo $hd->rek_mst_kode ?></td>
											<td><?php echo $hd->rek_mst_ket; ?></td>
											<td><?php echo 'Rp'. number_format($hd->hut_det_rnc,2,",",".") ?></td>
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
							<table class="table table-sm table-borderless" id="tblHutDet">
								<tr>
									<td><?php echo form_label('CATATAN TAMBAHAN'); ?></td>
								</tr>	
								<tr>
									<td><?php echo form_textarea(['name'=>'t_cek_mst_ket','class'=>'form-control form-control-sm'])?></td>
								</tr>
								<tr>
									<td>
										<div class="row justify-content-center">
											<div class="col col-sm-4">
												<?php echo form_submit(['name'=>'btnKirim','value'=>'TOLAK','class'=>'btn btn-danger btn-lg']); ?>
												<?php echo form_submit(['name'=>'btnKirim','value'=>'SETUJU','class'=>'btn btn-success btn-lg']); ?>
												<?php echo form_submit(['name'=>'btnKirim','value'=>'BATAL','class'=>'btn btn-primary btn-lg']); ?>
												<?php echo form_close(); ?>
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
	$(document).ready(function(){

		// Format mata uang.
		$( '.uang' ).mask('000.000.000', {reverse: true});

	})
</script>
</body>
</html>