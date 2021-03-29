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
					<a class="nav-link active" href="<?php $kosong="KOSONG"; echo base_url().'index.php/c_hutang/tambah_hutang/'.$kosong?>"><strong>TAMBAH</strong></a>
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
						<li>Mohon melengkapi isian <strong>NAMA PROPOSAL KEGIATAN</strong>, <strong>TANGGAL PELAKSANAAN</strong>, <strong>POS ANGGARAN</strong> dan <strong>BESAR ANGGARAN</strong> pada formulir <strong>DETAIL ANGGARAN</strong>.</li>
						<li>Periksa kembali pengajuan anggaran yang sudah di isi di <strong>TABEL ANGGARAN</strong> sebelum menekan tombol <strong>SELESAI</strong>.</li>
						<li>Simpan baik-baik <strong>NOMOR BUKTI PENGAJUAN ANGGARAN</strong> untuk mempermudah proses verifikasi dan pencairan anggaran.</li>						
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi'))) { ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<?php echo $this->session->userdata('validasi'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="<?php echo $this->session->unset_userdata('validasi') ?>"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmHutDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL ANGGARAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-bordered table-light">
								<?php 

								foreach	($daftar_rekening_master as $rm){
									$rekkode[$rm->rek_mst_kode] = $rm->rek_mst_ket;
								}
								
								foreach ($daftar_hutang_master as $hm){
									$nobuk = $hm->hut_mst_nobuk;
									$ket = $hm->hut_mst_ket;
									$tglrnc = $hm->hut_mst_tglrnc;
								}

								echo form_open('c_hutang/tambah_hutang_ok');
								?>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENGAJUAN ANGGARAN'); ?></td>
									<td><?php echo form_input(['name'=>'t_hut_mst_nobuk','value'=>$nobuk,'readonly'=>'true','class'=>'form-control']); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NAMA PROPOSAL KEGIATAN'); ?></td>
									<td><?php echo form_input(['name'=>'t_hut_mst_ket','value'=>$ket,'class'=>'form-control']); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TANGGAL PELAKSANAAN'); ?></td>
									<td><?php echo form_input(['name' => 't_hut_mst_tglrnc','value'=>$tglrnc,'type' => 'date','class'=>'form-control']); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('POS ANGGARAN'); ?></td>
									<td><?php echo form_dropdown(['name'=>'t_hut_det_rek','options'=>$rekkode,'','class'=>"form-control"]); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('RENCANA ANGGARAN'); ?></td>
									<td><?php echo form_input(['name' => 't_hut_det_rnc','type' => 'number','class'=>'form-control','value'=>'0']); ?></td>
								</tr>
								<tr>
									<th></th>
									<td><?php echo form_submit(['name'=>'btnKirim','value'=>'TAMBAH','class'=>'btn btn-primary btn-sm']); ?> 
										<?php echo form_submit(['name'=>'btnKirim','value'=>'SELESAI','class'=>'btn btn-success btn-sm']); ?>
										<?php echo form_close(); ?>						
									</td>
								</tr>
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
							<strong>TABEL ANGGARAN</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblHutDet">
								<thead>
									<tr>
										<th>URUT</th>
										<th>NO.BUKTI</th>
										<th>POS</th>
										<th>RENCANA</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($daftar_hutang_detail as $hd){ ?>
										<tr>
											<td><?php echo $hd->hutprm; ?></td>
											<td><?php echo $hd->hut_det_nobuk; ?></td>
											<td><?php echo $hd->rek_mst_ket; ?></td>
											<td><?php echo 'Rp'. number_format($hd->hut_det_rnc,2,",",".") ?></td>
											<td><a href="<?php echo base_url().'index.php/c_hutang/hapus_hutang_detail_ok/'.$hd->hutprm.'/'.$hd->hut_det_nobuk ?>" class="btn btn-sm btn-danger">HAPUS</a></td>
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
</body>
</html>