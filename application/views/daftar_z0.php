<!DOCTYPE html>
<html>
<head>
	<title>HALAMANDEPAN-GSMF</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url().'assets/js/bootstrap.bundle.js'?>"></script>
</head>
<body onload="kasihfokuslah()">
<?php
$formulir_kode = array(
	'name' => 't_pst_mst_kode',
	'class'=>'form-control',
	'placeholder' => 'Kode...',
	'id' => 't_pst_mst_kode'
);
$formulir_kunci = array(
	'name' => 't_pst_mst_pswd',
	'class'=>'form-control',
	'placeholder' => 'Kunci...',
	'id' => 't_pst_mst_kode',
	'type' => 'password'
);
$tombol_masuk = array(
	'name' => 'btnKirim',
	'value' => 'MASUK',
	'class' => 'btn btn-sm btn-primary'	
)
?>

<div class="container" style="margin-top: 5rem">
		<div class="row justify-content-center">
			<div class="col col-sm-4">
				<div class="card text-center bg-light shadow">
					<div class="card-header"> 
						<h1><strong>GSMF-MONEV</strong></h1>
					</div>
					<?php echo form_open('klik_z/kulonuwun'); ?>
					<div class="card-body">
						<div class="mb-1">	
							<label class="form-label">KODE PENGGUNA</label>
							<?php echo form_input($formulir_kode); ?>
						</div>
						<div class="mb-2">
							<label class="form-label">KATA KUNCI</label>
							<?php echo form_password($formulir_kunci); ?>
						</div>
						<div class="mb-0">
							<?php echo form_submit($tombol_masuk); ?>
						</div>
					</div>
					<?php echo form_close(); ?>
					<?php if(!empty($this->session->userdata('validasi_z0'))) { ?>
						<div class="alert alert-sm alert-danger alert-dismissible fade show">
							<?php echo $this->session->userdata('validasi_z0'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="<?php echo $this->session->unset_userdata('validasi_z0') ?>"></button>
						</div>
					<?php } ?>
					<div class="card-footer text-muted">
						<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>
var inputan1 = document.getElementById('t_pst_mst_kode');

function kasihfokuslah(){
	inputan1.focus();
}
</script>
</html>