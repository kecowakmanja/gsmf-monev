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
<?php
foreach ($daftar_info_level_1_sts as $lv1_sts) {
	$t_kel_mst_sts[$lv1_sts->in_lv_1_kd]=$lv1_sts->in_lv_1_ket;
}

$formulir_prm=array();

$formulir_status=array(
	'name'=>'t_kel_mst_sts',
	'options'=>$t_kel_mst_sts,
	'class'=>'form-control custom-select'
);
$formulir_kode=array(
	'name'=>'t_kel_mst_kode',
	'class'=>'form-control',
	'placeholder'=>'Kode bidang...',
	'id'=>'t_kel_mst_kode'
);
$formulir_nama=array(
	'name'=>'t_kel_mst_ket',
	'class'=>'form-control',
	'placeholder'=>'Nama bidang...',
	'id'=>'t_kel_mst_ket'
);
$formulir_subkode=array(
	'name'=>'t_kel_mst_subkode',
	'class'=>'form-control',
	'placeholder'=>'Kode tim pelayanan...',
	'id'=>'t_kel_mst_subkode'
);
$formulir_prefix=array(
	'name'=>'t_kel_mst_prefix',
	'class'=>'form-control',
	'readonly'=>'true',
	'id'=>'t_kel_mst_prefix'
);
$formulir_subnama=array(
	'name'=>'t_kel_mst_subket',
	'class'=>'form-control',
	'placeholder'=>'Nama tim pelayanan...',
	'id'=>'t_kel_mst_subket'
);

$tombol_tambah=array(
	'name'=>'btnKirim',
	'value'=>'TAMBAH',
	'class'=>'btn btn-lg btn-outline-dark'
);

$tombol_proses=array(
	"name"=>"btnProses",
	"value"=>"PROSES",
	"class"=>"btn btn-lg btn-outline-dark"
);

$tombol_unduh=array(
	"name"=>"btnProses",
	"value"=>"UNDUH",
	"class"=>"btn btn-lg btn-outline-dark"
);


$tombol_batal=array(
	"name"=>"btnKirim",
	"value"=>"BATAL",
	"class"=>"btn btn-lg btn-outline-dark"
);

$formulir_csv=array(
	"name"=>"t_kel_csv",
	"class"=>"form-control",
	"placeholder"=>"Masukan file...",
	"id"=>"t_kel_csv",
	"type"=>"file",
	"accept"=>".csv"
);

if($this->session->userdata('operator_a1')=="UBAH"){
	foreach($daftar_kelompok_master as $km){
		$formulir_prm=array("kelprm"=>$km->kelprm);
		$tombol_tambah_ubah=array('value'=>'UBAH');
		$formulir_kode_ubah=array('readonly'=>'true','value'=>$km->kel_mst_kode);
		$formulir_nama_ubah=array('readonly'=>'true','value'=>$km->kel_mst_ket);
		$formulir_subkode_ubah=array('readonly'=>'true','value'=>substr($km->kel_mst_subkode,strlen($km->kel_mst_kode)));
		$formulir_prefix_ubah=array('readonly'=>'true','value'=>$km->kel_mst_kode);
		$formulir_subnama_ubah=array('value'=>$km->kel_mst_subket);

		$tombol_tambah=array_merge($tombol_tambah,$tombol_tambah_ubah);
		$formulir_kode=array_merge($formulir_kode,$formulir_kode_ubah);
		$formulir_nama=array_merge($formulir_nama,$formulir_nama_ubah);
		$formulir_subkode=array_merge($formulir_subkode,$formulir_subkode_ubah);
		$formulir_prefix=array_merge($formulir_prefix,$formulir_prefix_ubah);
		$formulir_subnama=array_merge($formulir_subnama,$formulir_subnama_ubah);
	}
}

?>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_a/pilihan_a1'?>"><strong>A1. KELOMPOK</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_a/pilihan_a2'?>"><strong>A2. PESERTA</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_a/pilihan_a3'?>"><strong>A3. REKENING</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR KELOMPOK
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah, sila tekan tombol <strong>TAMBAH</strong> pada <strong>DETAIL KELOMPOK</strong>.</li>
						<li>Tombol operator <strong>UBAH</strong>, <strong>HAPUS</strong> pada <strong>DAFTAR KELOMPOK</strong> untuk melakukan perubahan dan menghapus.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_a1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_a1') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL KELOMPOK</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-borderless table-light">
								<?php 
									echo form_open('klik_a/tambah_kelompok_ok','',$formulir_prm);
								?>
								<tbody>
									<tr>
										<td>STATUS</td>
										<td><?php echo form_dropdown($formulir_status); ?></td>
									</tr>
									<tr>
										<td>KODE</td>
										<td><?php echo form_input($formulir_kode); ?></td>
									</tr>
									<tr>
										<td>NAMA</td>
										<td><?php echo form_input($formulir_nama); ?></td>
									</tr>
									<tr>
										<td>SUB-KODE</td>
										<td>
											<div class="input-group">
												<div class="input-group-prepend">
													<?php echo form_input($formulir_prefix); ?>
												</div>
													<?php echo form_input($formulir_subkode); ?>	
											</div>
										</td>
									</tr>
									<tr>
										<td>SUB-NAMA</td>
										<td><?php echo form_input($formulir_subnama); ?></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td class="text-end"><?php
												echo form_submit($tombol_tambah);
												echo form_submit($tombol_batal);
												?>
										</td>
									</tr>
								</tfoot>
								<?php echo form_close(); ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmrekDet3">
					<h6 class="accordion-header" id="judulTiga">
						<button type="button" class="accordion-button collapsed bg-warning text-dark" data-bs-toggle="collapse" data-bs-target="#isiTiga" aria-expanded="true" aria-control="isiTiga">
							<strong>IMPORT CSV</strong>
						</button>
					</h6>
					<div id="isiTiga" class="accordion-collapse collapse" data-bs-parent="#frmrekDet3" aria-labelledby="judulTiga">
						<div class="accordion-body">
							<table class="table table-sm table-borderless table-light">
								<?php 
									echo form_open_multipart("klik_a/proses_kelompok_ok");
								?> 	 
								<tr>
									<td><?php echo form_label("MASUKAN NAMA FILE (FORMAT CSV) UNTUK DI PROSES"); ?></td>
									<td><?php echo form_input($formulir_csv); ?></td>
								</tr>
								<tr>
									<td></td>
									<td class="text-end"><?php
											echo form_submit($tombol_proses);
											echo form_submit($tombol_unduh);
											echo form_close(); ?>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button collapsed bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR KELOMPOK</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse" data-bs-parent="#frmkelDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table table-hover" id="tblKel">
									<thead>
										<tr>
											<th>KODE</th>
											<th>SUB-KODE</th>
											<th>SUB-KETERANGAN</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_kelompok_master as $km){ ?>
										<tr>
											<td><?php echo $km->kel_mst_kode ?></td>
											<td><?php echo $km->kel_mst_subkode ?></td>
											<td><?php echo $km->kel_mst_subket ?></td>
											<td><a href="<?php echo base_url().'index.php/klik_a/ubah_kelompok_ok/'.$km->kelprm ?>" class="btn btn-sm btn-outline-dark">UBAH</a>
												<a href="<?php echo base_url().'index.php/klik_a/hapus_kelompok_ok/'.$km->kel_mst_subkode ?>" class="btn btn-sm btn-outline-dark">HAPUS</a>
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
		<br>
		<div class="card-footer text-muted">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>

<script type="text/javascript">
var alamat1='<?php echo base_url().'index.php/klik_a/cari_auto_kelompok_ok/?'?>'
var alamat2='<?php echo base_url().'index.php/klik_a/cari_auto_kelompok_2_ok/'?>'
var inputan1=document.getElementById('t_kel_mst_kode');

$('#tblKel').DataTable({
	"order": [[ 3, "asc" ]]
});

function kasihfokuslah(){
	inputan1.focus();
}


$('#t_kel_mst_kode').autocomplete({
	source: alamat1,
	select: function (event, ui){
		$('#t_kel_mst_kode').val(ui.item.label);
		$('#t_kel_mst_prefix').val(ui.item.label);
		$('#t_kel_mst_ket').val(ui.item.value);
		$('#t_kel_mst_ket').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item===null) {
			$('#t_kel_mst_ket').removeAttr('readonly');
			$('#t_kel_mst_prefix').val($(this).val());
		} else{
			$('#t_kel_mst_kode').val(ui.item.label);
			$('#t_kel_mst_prefix').val(ui.item.label);
			$('#t_kel_mst_ket').val(ui.item.value);
			$('#t_kel_mst_ket').prop("readonly",true);
			event.preventDefault();
		}
	}
});

$('#t_kel_mst_subkode').autocomplete({
	/*source: alamat2 + isikondisi2,*/
	source: function(request, response) {
	$.getJSON(alamat2, { extra: $('#t_kel_mst_kode').val(), term: $('#t_kel_mst_subkode').val() }, 
			response);
	},

	select: function (event, ui){
		$('#t_kel_mst_subkode').val(ui.item.label);
		$('#t_kel_mst_subket').val(ui.item.value);
		$('#t_kel_mst_subket').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item===null) {
			$('#t_kel_mst_subket').removeAttr('readonly');
		} else{
			$('#t_kel_mst_subkode').val(ui.item.label);
			$('#t_kel_mst_subket').val(ui.item.value);
			$('#t_kel_mst_subket').prop("readonly",true);
			event.preventDefault();
		}
	}
});
</script>
</body>
</html>
