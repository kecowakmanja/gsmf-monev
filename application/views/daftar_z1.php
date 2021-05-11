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
<?php 
$formulir_urut=array(
	'id'=>'t_pstprm',
	'name'=>'t_pstprm',
	'readonly'=>'true',
	'class'=>'form-control-plaintext',
	'hidden'=>'true'
);
$formulir_kode=array(
	'id'=>'t_pstkode',
	'name'=>'t_pstkode',
	'readonly'=>'true',
	'class'=>'form-control'
);
$formulir_nama=array(
	'id'=>'t_pstnama',
	'name'=>'t_pstnama',
	'readonly'=>'true',
	'class'=>'form-control'
);
$formulir_kel=array(
	'id'=>'t_pstkel',
	'name'=>'t_pstkel',
	'readonly'=>'true',
	'class'=>'form-control'
);
$formulir_hak=array(
	'id'=>'t_psthak',
	'name'=>'t_psthak',
	'readonly'=>'true',
	'class'=>'form-control'
);
$formulir_kunci=array(
	'name'=>'t_pstpswd',
	'class'=>'form-control',
	'placeholder'=>'Silahkan masukin kata kunci yang baru...',
	'id'=>'t_pstpswd',
	'type'=>'password'
);
$tombol_ubah=array(
	'name'=>'btnKirim',
	'class'=>'btn btn-lg btn-outline-dark',
	'value'=>'UBAH'
);
$tombol_batal=array(
	'name'=>'btnKirim',
	'class'=>'btn btn-lg btn-outline-dark',
	'value'=>'BATAL'
);
?>
<body>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-1">
					<img src="<?php echo base_url().'assets/img/logo_gsmf.png'?>" width="80" height="70">
				</div>
				<div class="col-sm-3 text-start">
					<h1><strong>GSMF-MONEV</h1></strong>
				</div>
				<div class="col-sm-6 text-start">
					<a class="btn btn-sm btn-outline-dark" href="#">[kode=<strong><?php echo $this->session->userdata('kode') ?></strong>]</a>
					<a class="btn btn-sm btn-outline-dark" href="#">[hak=<strong><?php echo $this->session->userdata('hak') ?></strong>]</a>
					<a class="btn btn-sm btn-outline-dark" href="#">[nama=<strong><?php echo $this->session->userdata('nama') ?></strong>]</a>
					<a class="btn btn-sm btn-outline-dark" href="#">[kelompok=<strong><?php echo $this->session->userdata('nmkel') ?></strong>]</a>
					<a class="btn btn-sm btn-outline-dark" href="#">[alamat=<strong><?php echo $_SERVER['REMOTE_ADDR'] ?></strong>]</a>
				</div>
				<div class="col-sm-2 text-start">
					<div class="btn-group">
						<a class="btn btn-lg btn-dark" href=# onclick="profil_peserta('<?php echo $this->session->userdata('prm'); ?>')">PROFIL</a>
						<a class="btn btn-lg btn-dark" href="<?php echo base_url().'index.php/klik_z/kepareng/'?>">PAMIT</a>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row text-start">
				<div class="col-sm-12">	
					<?php if(!empty($this->session->userdata('validasi_z1'))) { ?>
					<div class="alert alert-sm alert-danger alert-dismissible fade show">
						<?php echo $this->session->userdata('validasi_z1'); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="<?php echo $this->session->unset_userdata('validasi_z1') ?>"></button>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="row align-items-start">
				<div class="col-sm-3">	
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>A. SETELAN AWAL</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_a/index/'?>">
								DAFTAR BIDANG, TIMPEL, PENGGUNA dan POS-REKENING
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>B. ANGGARAN BELANJA</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_b/index/'?>">
								PENGAJUAN PROPOSAL PROGRAM DAN BIAYA RUTIN
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>C. ANGGARAN PENDAPATAN</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_c/index/'?>">
								PENGAJUAN ANGGARAN PENDAPATAN
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>D. VERIFIKASI</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_d/index/'?>">
								VERIFIKASI PROPOSAL KEGIATAN DAN NOTA BIAYA RUTIN
							</a>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row align-items-start">
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>E. REALISASI</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_e/index/'?>">
								PENCAIRAN ANGGARAN BELANJA DAN REALISASI PENDAPATAN
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>F. PERSONALIA</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_f/index/'?>">
								DAFTAR KARYAWAN, PEKERJAAN DAN UPAH
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card text-dark bg-warning border-dark">
						<div class="card-header">
							<strong>G. UMUM</strong>
						</div>
						<div class="card-body">
							<a class="nav nav-link active btn btn-sm" aria-current="true" href="<?php echo base_url().'index.php/klik_g/index/'?>">
								TANAH, BANGUNAN, KENDARAAN DAN PERALATAN LAIN
							</a>
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
</body>
<!-- Modal -->
<div class="modal" id="mdlPst" tabindex="-1" aria-labelledby="mdlPstLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('klik_z/ngubah/','',$formulir_urut); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="mdlPstLbl"><strong>GANTI KATA KUNCI</strong></h5>
			</div>
			<div class="modal-body">
				<table class="table table-sm table-borderless">
					<tbody>
						<tr>
							<td><?php echo form_input($formulir_urut); ?></td>
							<td><?php echo form_input($formulir_kunci); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<?php 
					echo form_submit($tombol_ubah);
					echo form_submit($tombol_batal);
				?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
var url_profil_peserta="<?php echo base_url()."index.php/klik_z/njenengan/"?>"

function profil_peserta(t_pstprm){
	$('#mdlPst').modal('toggle');
	$.ajax({
		type: "POST",
		url: url_profil_peserta,
		dataType: 'json',
		data: {pstprm:t_pstprm},
		success: function(data){
			$('#t_pstprm').val(data[0].pstprm);
		}
	})
}
</script>
</html>