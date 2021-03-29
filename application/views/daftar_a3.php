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
$t_rek_mst_sts = array(
	'AKTIF' => 'AKTIF',
	'PASIF' => 'PASIF'
);

$t_rek_mst_kel = array(
	'ANGGARAN' => 'ANGGARAN',
	'NERACA' => 'NERACA'
);

if(!empty($this->session->userdata('operator_a3'))){
	if($this->session->userdata('operator_a3')!="TAMBAH"){
		$judul_navigasi = "UBAH";
		$tombol_tambah = array(
			'name' => 'btnKirim',
			'value' => 'UBAH',
			'class' => 'btn btn-sm btn-primary'
		);
		foreach($daftar_rekening_master as $rm){
			$formulir_status = array(
				'name' => 't_rek_mst_sts',
				'options' => $t_rek_mst_sts,
				'selected' => $rm->rek_mst_sts,
				'class'=>'form-control custom-select'
			);

			$formulir_lap = array(
				'name' => 't_rek_mst_kel',
				'options' => $t_rek_mst_kel,
				'selected' => $rm->rek_mst_kel,
				'class'=>'form-control custom-select',
				'id' => 't_rek_mst_kel'
			);
			
			$formulir_kd_kel = array(
				'name' => 't_rek_mst_gol',
				'readonly' => 'true',
				'value' => $rm->rek_mst_gol,
				'class'=>'form-control',
				'placeholder' => 'Kode golongan...',
				'id' => 't_rek_mst_gol'
			);

			$formulir_ket_kel  = array(
				'name' => 't_rek_mst_ket_gol',
				'readonly' => 'true',
				'value' => $rm->rek_mst_ket_gol,
				'class'=>'form-control',
				'placeholder' => 'Keterangan golongan...',
				'id' => 't_rek_mst_ket_gol'
			);
			
			$formulir_kd_subkel  = array(
				'name' => 't_rek_mst_sub_gol',
				'readonly' => 'true',
				'value' => $rm->rek_mst_sub_gol,
				'class'=>'form-control',
				'placeholder' => 'Kode sub-golongan...',
				'id' => 't_rek_mst_sub_gol'
			);
			
			$formulir_ket_subkel  = array(
				'name' => 't_rek_mst_ket_sub_gol',
				'readonly' => 'true',
				'value' => $rm->rek_mst_ket_sub_gol,
				'class'=>'form-control',
				'placeholder' => 'Keterangan sub-golongan...',
				'id' => 't_rek_mst_ket_sub_gol'
			);
			
			$formulir_kd_rek  = array(
				'name' => 't_rek_mst_kode',
				'readonly' => 'true',
				'value' => $rm->rek_mst_kode,
				'class'=>'form-control',
				'placeholder' => 'Kode rekening...',
				'id' => 't_rek_mst_kode'
			);
			
			$formulir_ket_rek  = array(
				'name' => 't_rek_mst_ket_kode',
				'readonly' => 'true',
				'value' => $rm->rek_mst_ket_kode,
				'class'=>'form-control',
				'placeholder' => 'Keterangan rekening...',
				'id' => 't_rek_mst_ket_kode'
			);
			
			$formulir_kd_subrek = array(
				'name' => 't_rek_mst_sub_kode',
				'readonly' => 'true',
				'value' => $rm->rek_mst_sub_kode,
				'class'=>'form-control',
				'placeholder' => 'Kode sub-rekening...',
				'id' => 't_rek_mst_sub_kode'
			);
			
			$formulir_ket_subrek = array(
				'name' => 't_rek_mst_ket_sub_kode',
				'readonly' => 'true',
				'value' => $rm->rek_mst_ket_sub_kode,
				'class'=>'form-control',
				'placeholder' => 'Keterangan sub-rekening...',
				'id' => 't_rek_mst_ket_sub_kode'
			);
			
		}
	} 
} else {
	$judul_navigasi = "TAMBAH";
	$tombol_tambah = array(
		'name' => 'btnKirim',
		'value' => 'TAMBAH',
		'class' => 'btn btn-sm btn-primary'
	);
	$formulir_status = array(
		'name' => 't_rek_mst_sts',
		'options' => $t_rek_mst_sts,
		'class'=>'form-control custom-select'
	);

	$formulir_lap = array(
		'name' => 't_rek_mst_kel',
		'options' => $t_rek_mst_kel,
		'class'=>'form-control custom-select',
		'selected' => 'ANGGARAN',
		'id' => 't_rek_mst_kel'
	);
	
	$formulir_kd_kel = array(
		'name' => 't_rek_mst_gol',
		'class'=>'form-control',
		'placeholder' => 'Kode golongan...',
		'id' => 't_rek_mst_gol'
	);

	$formulir_ket_kel  = array(
		'name' => 't_rek_mst_ket_gol',
		'class'=>'form-control',
		'placeholder' => 'Keterangan golongan...',
		'id' => 't_rek_mst_ket_gol'
	);
	
	$formulir_kd_subkel  = array(
		'name' => 't_rek_mst_sub_gol',
		'class'=>'form-control',
		'placeholder' => 'Kode sub-golongan...',
		'id' => 't_rek_mst_sub_gol'
	);
	
	$formulir_ket_subkel  = array(
		'name' => 't_rek_mst_ket_sub_gol',
		'class'=>'form-control',
		'placeholder' => 'Keterangan sub-golongan...',
		'id' => 't_rek_mst_ket_sub_gol'
	);
	
	$formulir_kd_rek  = array(
		'name' => 't_rek_mst_kode',
		'class'=>'form-control',
		'placeholder' => 'Kode rekening...',
		'id' => 't_rek_mst_kode'
	);
	
	$formulir_ket_rek  = array(
		'name' => 't_rek_mst_ket_kode',
		'class'=>'form-control',
		'placeholder' => 'Keterangan rekening...',
		'id' => 't_rek_mst_ket_kode'
	);
	
	$formulir_kd_subrek = array(
		'name' => 't_rek_mst_sub_kode',
		'class'=>'form-control',
		'placeholder' => 'Kode sub-rekening...',
		'id' => 't_rek_mst_sub_kode'
	);
	
	$formulir_ket_subrek = array(
		'name' => 't_rek_mst_ket_sub_kode',
		'class'=>'form-control',
		'placeholder' => 'Keterangan sub-rekening...',
		'id' => 't_rek_mst_ket_sub_kode'
	);
	
}
$tombol_reset = array(
	'name' => 'btnBersih',
	'value' => 'BERSIH',
	'class' => 'btn btn-sm btn-secondary'
);

$tombol_proses = array(
	'name' => 'btnProses',
	'value' => 'PROSES',
	'class' => 'btn btn-sm btn-primary'
);

$tombol_unduh = array(
	'name' => 'btnProses',
	'value' => 'UNDUH',
	'class' => 'btn btn-sm btn-warning'
);

$formulir_csv = array(
	'name' => 't_rek_csv',
	'class'=>'form-control',
	'placeholder' => 'Masukan file...',
	'id' => 't_rek_csv',
	'type' => 'file',
	'accept' => '.csv'
);

?>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_a/pilihan_a1'?>"><strong>A1.KELOMPOK</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_a/pilihan_a2'?>"><strong>A2.PESERTA</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_a/pilihan_a3'?>"><strong>A3.REKENING</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR REKENING
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah, sila tekan tombol <strong>TAMBAH</strong> pada <strong>DETAIL REKENING</strong>.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian.</li>
						<li><strong>JUDUL TABEL</strong> dapat di tekan untuk melakukan pengurutan untuk membantu permudah pencarian.</li>
						<li>Tombol operator <strong>UBAH</strong>, <strong>HAPUS</strong> pada <strong>DAFTAR REKENING</strong> untuk melakukan perubahan dan menghapus.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_a3'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_a3') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmrekDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL REKENING</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmrekDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-bordered table-light">
								<?php 
									echo form_open('klik_a/tambah_rekening_ok');
								?> 	 
								<tr>
									<td><?php echo form_label('STATUS'); ?></td>
									<td><?php echo form_dropdown($formulir_status); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('JENIS'); ?></td>
									<td><?php echo form_dropdown($formulir_lap); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KODE KELOMPOK'); ?></td>
									<td><?php echo form_input($formulir_kd_kel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KETERANGAN KELOMPOK'); ?></td>
									<td><?php echo form_input($formulir_ket_kel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('SUB-KELOMPOK'); ?></td>
									<td><?php echo form_input($formulir_kd_subkel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KETERANGAN SUB-KELOMPOK'); ?></td>
									<td><?php echo form_input($formulir_ket_subkel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KODE REKENING'); ?></td>
									<td><?php echo form_input($formulir_kd_rek); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KETERANGAN REKENING'); ?></td>
									<td><?php echo form_input($formulir_ket_rek); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KODE SUB-REKENING'); ?></td>
									<td><?php echo form_input($formulir_kd_subrek); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KETERANGAN SUB-REKENING'); ?></td>
									<td><?php echo form_input($formulir_ket_subrek); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><?php
											echo form_submit($tombol_tambah);
											echo form_reset($tombol_reset);
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
				<div class="accordion-item" id="frmrekDet3">
					<h6 class="accordion-header" id="judulTiga">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiTiga" aria-expanded="true" aria-control="isiTiga">
							<strong>IMPORT CSV</strong>
						</button>
					</h6>
					<div id="isiTiga" class="accordion-collapse collapse show" data-bs-parent="#frmrekDet3" aria-labelledby="judulTiga">
						<div class="accordion-body">
							<table class="table table-sm table-bordered table-light">
								<?php 
									echo form_open_multipart('klik_a/proses_rekening_ok');
								?> 	 
								<tr>
									<td><?php echo form_label('MASUKAN NAMA FILE (FORMAT CSV) UNTUK DI PROSES'); ?></td>
									<td><?php echo form_input($formulir_csv); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><?php
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
				<div class="accordion-item" id="frmrekDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR REKENING</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmrekDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table" id="tblrek">
									<thead>
										<tr>
											<th>URUT</th>
											<th>SANDI</th>
											<th>STATUS</th>
											<th>KELOMPOK</th>
											<th>GOLONGAN</th>
											<th>SUB-GOLONGAN</th>
											<th>KODE</th>
											<th>SUB-KODE</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_rekening_master as $rm){ ?>
										<tr>
											<td><?php echo $rm->rekprm ?></td>
											<td><?php echo $rm->rek_mst_sub_kode ?></td>
											<td><?php echo $rm->rek_mst_sts ?></td>
											<td><?php echo $rm->rek_mst_kel ?></td>
											<td><?php echo $rm->rek_mst_ket_gol ?></td>
											<td><?php echo $rm->rek_mst_ket_sub_gol ?></td>
											<td><?php echo $rm->rek_mst_ket_kode ?></td>
											<td><?php echo $rm->rek_mst_ket_sub_kode ?></td>
											<td><a href="<?php echo base_url().'index.php/klik_a/ubah_rekening_ok/'.$rm->rekprm ?>" class="btn btn-sm btn-warning">UBAH</a>
												<a href="<?php echo base_url().'index.php/klik_a/hapus_rekening_ok/'.$rm->rekprm?>" class="btn btn-sm btn-danger">HAPUS</a>
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
var alamat1 = '<?php echo base_url().'index.php/klik_a/cari_rekening_1_ok/?'?>'
var alamat2 = '<?php echo base_url().'index.php/klik_a/cari_rekening_2_ok/'?>'
var alamat3 = '<?php echo base_url().'index.php/klik_a/cari_rekening_3_ok/'?>'
var alamat4 = '<?php echo base_url().'index.php/klik_a/cari_rekening_4_ok/'?>'
var inputan1 = document.getElementById('t_rek_mst_gol');

$('#tblrek').DataTable({
	"order": [[ 1, "asc" ]]
});

function kasihfokuslah(){
	inputan1.focus();
	inputan1.scrollIntoView();
}


$('#t_rek_mst_gol').autocomplete({
	source: function(request, response) {
	$.getJSON(alamat1, 
		{	extra1: $('#t_rek_mst_kel').val(), 
			term: $('#t_rek_mst_gol').val() 
		}, 
			response);
	},
	select: function (event, ui){
		$('#t_rek_mst_gol').val(ui.item.label);
		$('#t_rek_mst_ket_gol').val(ui.item.value);
		$('#t_rek_mst_ket_gol').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item === null) {
			$('#t_rek_mst_ket_gol').removeAttr('readonly');
		} else{
			$('#t_rek_mst_gol').val(ui.item.label);
			$('#t_rek_mst_ket_gol').val(ui.item.value);
			$('#t_rek_mst_ket_gol').prop("readonly",true);
			event.preventDefault();
		}
	}
});

$('#t_rek_mst_sub_gol').autocomplete({
	source: function(request, response) {
	$.getJSON(alamat2, 
		{	extra1: $('#t_rek_mst_kel').val(), 
			extra2: $('#t_rek_mst_gol').val(), 
			term: $('#t_rek_mst_sub_gol').val() 
		}, 
			response);
	},

	select: function (event, ui){
		$('#t_rek_mst_sub_gol').val(ui.item.label);
		$('#t_rek_mst_ket_sub_gol').val(ui.item.value);
		$('#t_rek_mst_ket_sub_gol').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item === null) {
			$('#t_rek_mst_ket_sub_gol').removeAttr('readonly');
		} else{
			$('#t_rek_mst_sub_gol').val(ui.item.label);
			$('#t_rek_mst_ket_sub_gol').val(ui.item.value);
			$('#t_rek_mst_ket_sub_gol').prop("readonly",true);
			event.preventDefault();
		}
	}
});

$('#t_rek_mst_kode').autocomplete({
	source: function(request, response) {
	$.getJSON(alamat3, 
		{	extra1: $('#t_rek_mst_kel').val(),
			extra2: $('#t_rek_mst_gol').val(), 
			extra3: $('#t_rek_mst_gol').val()+$('#t_rek_mst_sub_gol').val(), 
			term: $('#t_rek_mst_kode').val() 
		}, 
			response);
	},

	select: function (event, ui){
		$('#t_rek_mst_kode').val(ui.item.label);
		$('#t_rek_mst_ket_kode').val(ui.item.value);
		$('#t_rek_mst_ket_kode').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item === null) {
			$('#t_rek_mst_ket_kode').removeAttr('readonly');
		} else{
			$('#t_rek_mst_kode').val(ui.item.label);
			$('#t_rek_mst_ket_kode').val(ui.item.value);
			$('#t_rek_mst_ket_kode').prop("readonly",true);
			event.preventDefault();
		}
	}
});

$('#t_rek_mst_sub_kode').autocomplete({
	source: function(request, response) {
	$.getJSON(alamat4, 
		{	extra1: $('#t_rek_mst_kel').val(),
			extra2: $('#t_rek_mst_gol').val(), 
			extra3: $('#t_rek_mst_gol').val()+$('#t_rek_mst_sub_gol').val(), 
			extra4: $('#t_rek_mst_gol').val()+$('#t_rek_mst_sub_gol').val()+$('#t_rek_mst_kode').val(), 
			term: $('#t_rek_mst_sub_kode').val() 
		}, 
			response);
	},

	select: function (event, ui){
		$('#t_rek_mst_sub_kode').val(ui.item.label);
		$('#t_rek_mst_ket_sub_kode').val(ui.item.value);
		$('#t_rek_mst_ket_sub_kode').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item === null) {
			$('#t_rek_mst_ket_sub_kode').removeAttr('readonly');
		} else{
			$('#t_rek_mst_sub_kode').val(ui.item.label);
			$('#t_rek_mst_ket_sub_kode').val(ui.item.value);
			$('#t_rek_mst_ket_sub_kode').prop("readonly",true);
			event.preventDefault();
		}
	}
});



</script>
</body>
</html>
