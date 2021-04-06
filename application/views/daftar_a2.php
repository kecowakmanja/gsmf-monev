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
	$t_pst_mst_sts[$lv1_sts->in_lv_1_kd] = $lv1_sts->in_lv_1_ket;
}

$formulir_prm = array();

$t_pst_mst_hak = array(
	'PEMAKAI' => 'PEMAKAI',
	'PENGAWAS' => 'PENGAWAS',
	'PEMILIK' => 'PEMILIK'
);

foreach($daftar_kelompok_master as $km){
	$kelsubkode[$km->kel_mst_subkode] = $km->kel_mst_subket;
}

if(!empty($this->session->userdata('operator_a2'))){
	if($this->session->userdata('operator_a2')!="TAMBAH"){
		$judul_navigasi = "UBAH";
		$tombol_tambah = array(
			'name' => 'btnKirim',
			'value' => 'UBAH',
			'class' => 'btn btn-sm btn-primary'
		);
		foreach($daftar_peserta_master as $pm){
			$formulir_prm = array(
				"pstprm" => $pm->pstprm
			);
			
			$formulir_status = array(
				'name' => 't_pst_mst_sts',
				'options' => $t_pst_mst_sts,
				'class'=>'form-control custom-select'
			);
			$formulir_kode = array(
				'name' => 't_pst_mst_kode',
				'readonly' => 'true',
				'value' => $pm->pst_mst_kode,
				'class'=>'form-control',
				'placeholder' => 'Kode peserta...',
				'id' => 't_pst_mst_kode'
			);
			$formulir_kelompok = array(
				'name' => 't_pst_mst_kel',
				'options' => $kelsubkode,
				'selected' => $pm->pst_mst_kel,
				'class'=>'form-control',
				'placeholder' => 'Kelompok...',
				'id' => 't_pst_mst_kel'
			);
			$formulir_hak = array(
				'name' => 't_pst_mst_hak',
				'options' => $t_pst_mst_hak,
				'selected' => $pm->pst_mst_hak,
				'class'=>'form-control',
				'placeholder' => 'Hak akses...',
				'id' => 't_pst_mst_hak'
			);
			$formulir_nama = array(
				'name' => 't_pst_mst_nm',
				'readonly' => 'true',
				'value' => $pm->pst_mst_nm,
				'class'=>'form-control',
				'placeholder' => 'Nama peserta...',
				'id' => 't_pst_mst_nm'
			);
			$formulir_kunci = array(
				'name' => 't_pst_mst_pswd',
				'class'=>'form-control',
				'placeholder' => 'Kata kunci...',
				'id' => 't_pst_mst_pswd',
				'type' => 'password'
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
		'name' => 't_pst_mst_sts',
		'options' => $t_pst_mst_sts,
		'class'=>'form-control custom-select'
	);
	$formulir_kode = array(
		'name' => 't_pst_mst_kode',
		'class'=>'form-control',
		'placeholder' => 'Kode peserta...',
		'id' => 't_pst_mst_kode'
	);
	$formulir_kelompok = array(
		'name' => 't_pst_mst_kel',
		'class'=>'form-control',
		'options' => $kelsubkode,
		'placeholder' => 'Kelompok...',
		'id' => 't_pst_mst_kel'
	);
	$formulir_hak = array(
		'name' => 't_pst_mst_hak',
		'options' => $t_pst_mst_hak,
		'class'=>'form-control',
		'placeholder' => 'Hak akses...',
		'id' => 't_pst_mst_hak'
	);
	$formulir_nama = array(
		'name' => 't_pst_mst_nm',
		'class'=>'form-control',
		'placeholder' => 'Nama peserta...',
		'id' => 't_pst_mst_nm'
	);
	$formulir_kunci = array(
		'name' => 't_pst_mst_pswd',
		'class'=>'form-control',
		'placeholder' => 'Kata kunci...',
		'id' => 't_pst_mst_pswd',
		'type' => 'password'
	);
}
$tombol_reset = array(
	'name' => 'btnBersih',
	'value' => 'BERSIH',
	'class' => 'btn btn-sm btn-secondary'
);

$tombol_proses = array(
	"name" => "btnProses",
	"value" => "PROSES",
	"class" => "btn btn-sm btn-primary"
);

$tombol_unduh = array(
	"name" => "btnProses",
	"value" => "UNDUH",
	"class" => "btn btn-sm btn-warning"
);

$tombol_batal = array(
	"name" => "btnKirim",
	"value" => "BATAL",
	"class" => "btn btn-sm btn-danger"
);

$formulir_csv = array(
	"name" => "t_pst_csv",
	"class"=>"form-control",
	"placeholder" => "Masukan file...",
	"id" => "t_pst_csv",
	"type" => "file",
	"accept" => ".csv"
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
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_a/pilihan_a2'?>"><strong>A2.PESERTA</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_a/pilihan_a3'?>"><strong>A3.REKENING</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR PESERTA
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah, sila tekan tombol <strong>TAMBAH</strong> pada <strong>DETAIL PESERTA</strong>.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian.</li>
						<li><strong>JUDUL TABEL</strong> dapat di tekan untuk melakukan pengurutan untuk membantu permudah pencarian.</li>
						<li>Tombol operator <strong>UBAH</strong>, <strong>HAPUS</strong> pada <strong>DAFTAR PESERTA</strong> untuk melakukan perubahan dan menghapus.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_a2'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_a2') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmpstDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL PESERTA</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmpstDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-bordered table-light">
								<?php 
									echo form_open('klik_a/tambah_peserta_ok','',$formulir_prm);
								?> 	 
								<tr>
									<td><?php echo form_label('STATUS'); ?></td>
									<td><?php echo form_dropdown($formulir_status); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KODE'); ?></td>
									<td><?php echo form_input($formulir_kode); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KELOMPOK'); ?></td>
									<td><?php echo form_dropdown($formulir_kelompok); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('HAK'); ?></td>
									<td><?php echo form_dropdown($formulir_hak); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NAMA'); ?></td>
									<td><?php echo form_input($formulir_nama); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('KATA KUNCI'); ?></td>
									<td><?php echo form_input($formulir_kunci); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><?php
											echo form_submit($tombol_tambah);
											echo form_reset($tombol_reset);
											echo form_submit($tombol_batal);
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
									echo form_open_multipart("klik_a/proses_peserta_ok");
								?> 	 
								<tr>
									<td><?php echo form_label("MASUKAN NAMA FILE (FORMAT CSV) UNTUK DI PROSES"); ?></td>
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
				<div class="accordion-item" id="frmpstDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR PESERTA</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmpstDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table" id="tblpst">
									<thead>
										<tr>
											<th>URUT</th>
											<th>STATUS</th>
											<th>KODE</th>
											<th>KELOMPOK</th>
											<th>HAK</th>
											<th>NAMA</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_peserta_master as $pm){ ?>
										<tr>
											<td><?php echo $pm->pstprm ?></td>
											<td><?php echo $pm->pst_mst_sts ?></td>
											<td><?php echo $pm->pst_mst_kode ?></td>
											<td><?php echo $pm->kel_mst_subket ?></td>
											<td><?php echo $pm->pst_mst_hak ?></td>
											<td><?php echo $pm->pst_mst_nm ?></td>
											<td><a href="<?php echo base_url().'index.php/klik_a/ubah_peserta_ok/'.$pm->pstprm ?>" class="btn btn-sm btn-warning">UBAH</a>
												<a href="<?php echo base_url().'index.php/klik_a/hapus_peserta_ok/'.$pm->pstprm?>" class="btn btn-sm btn-danger">HAPUS</a>
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
var alamat1 = '<?php echo base_url().'index.php/klik_a/cari_auto_peserta_ok/?'?>'
var inputan1 = document.getElementById('t_pst_mst_kode');

$('#tblpst').DataTable({
	"order": [[ 3, "asc" ]]
});

function kasihfokuslah(){
	inputan1.focus();
}


$('#t_pst_mst_kode').autocomplete({
	source: alamat1,
	select: function (event, ui){
		$('#t_pst_mst_kode').val(ui.item.label);
		$('#t_pst_mst_nm').val(ui.item.value);
		$('#t_pst_mst_nm').prop("readonly",true);
		event.preventDefault();
	},
	change: function (event,ui){
		if (ui.item === null) {
			$('#t_pst_mst_nm').removeAttr('readonly');
		} else{
			$('#t_pst_mst_kode').val(ui.item.label);
			$('#t_pst_mst_nm').val(ui.item.value);
			$('#t_pst_mst_nm').prop("readonly",true);
			event.preventDefault();
		}
	}
});

</script>
</body>
</html>
