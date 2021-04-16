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

foreach	($daftar_rekening_master as $rm){
	$rekkode[$rm->rek_mst_sub_kode] = $rm->rek_mst_ket_sub_kode;
}

$formulir_prm = array();

if($this->session->userdata('operator_b2') == "UBAH" && empty($this->session->userdata('validasi_b2'))){
	$tombol_tambah = array(
	'name' => 'btnKirim',
	'value' => 'UBAH',
	'class' => 'btn btn-success btn-sm'
	);
	
	foreach ($daftar_rutin_master as $hm){
		$t_hut_mst_nobuk = $hm->hut_mst_nobuk;
		$t_hut_mst_ket = $hm->hut_mst_ket;
		$t_hut_mst_tglrnc = $hm->hut_mst_tglrnc;
		$t_hut_mst_rek = $hm->hut_mst_rek;
		
		$formulir_prm = array(
			"hutprm" => $hm->hutprm
		);

		$formulir_nobuk = array(
			'name' => 't_hut_mst_nobuk',
			'value' => $t_hut_mst_nobuk,
			'readonly' => 'true',
			'class' => 'form-control',
			'id' => 't_hut_mst_nobuk'
		);
			
		$formulir_nama = array(
			'name' => 't_hut_mst_ket',
			'value' => $t_hut_mst_ket,
			'class'=>'form-control',
			'id' => 't_hut_mst_ket'
		);

		$formulir_tglrnc = array(
			'name' => 't_hut_mst_tglrnc',
			'value' => $t_hut_mst_tglrnc,
			'type' => 'date',
			'class'=>'form-control',
			'id' => 't_hut_mst_tglrnc'
		);

		$formulir_rek = array(
			'name' => 't_hut_mst_rek',
			'options' => $rekkode,
			'class' => 'form-control',
			'id' => 't_hut_mst_rek'
		);
			
		$formulir_rnc = array(
			'name' => 't_hut_mst_rnc',
			'type' => 'number',
			'class' => 'form-control',
			'value' => '0',
			'id' => 't_hut_mst_rnc'
		);
	}
} else {
		
	$tombol_tambah = array(
		'name' => 'btnKirim',
		'value' => 'TAMBAH',
		'class' => 'btn btn-success btn-sm'
	);
	
	$formulir_nobuk = array(
		'name' => 't_hut_mst_nobuk',
		'class' => 'form-control',
		'readonly' => 'true',
		'id' => 't_hut_mst_nobuk'
	);
		
	$formulir_nama = array(
		'name' => 't_hut_mst_ket',
		'class'=>'form-control',
		'id' => 't_hut_mst_ket'
	);

	$formulir_tglrnc = array(
		'name' => 't_hut_mst_tglrnc',
		'type' => 'date',
		'class' => 'form-control',
		'id' => 't_hut_mst_tglrnc'
	);

	$formulir_rek = array(
		'name' => 't_hut_mst_rek',
		'options' => $rekkode,
		'class'=> 'form-control',
		'id' => 't_hut_mst_rek'
	);
		
	$formulir_rnc = array(
		'name' => 't_hut_mst_rnc',
		'type' => 'number',
		'class' => 'form-control',
		'value' => '0',
		'id' => 't_hut_mst_rnc'
	);
}
	
$tombol_reset = array(
	'name' => 'btnBersih',
	'value' => 'BERSIH',
	'class' => 'btn btn-sm btn-secondary'
);

$tombol_batal = array(
	"name" => "btnKirim",
	"value" => "BATAL",
	"class" => "btn btn-sm btn-danger"
);

$formulir_csv = array(
	"name" => "t_hut_mst_doc",
	"class"=>"form-control",
	"placeholder" => "Masukan file...",
	"id" => "t_hut_mst_doc",
	"type" => "file",
	"accept" => "image/*"
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
					<a class="nav-link" href="<?php echo base_url().'index.php/klik_b/index'?>"><strong>B1. PROGRAM</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_b/pilihan_b2/'?>"><strong>B2. RUTIN</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN BIAYA RUTIN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah pengajuan sila terlebih dahulu untuk mengisi formulir pengajuan anggaran dan diakhiri dengan tekan <strong>TAMBAH</strong> pada baris navigasi.</li>
						<li>Tombol operator <strong>UBAH</strong> dan <strong>HAPUS</strong> untuk melakukan perubahan atau menghapus pengajuan.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian pengajuan anggaran.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata('validasi_b2'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_b2'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmHutDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL BIAYA RUTIN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmHutDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-borderless table-light">
								<?php 

								echo form_open_multipart('klik_b/tambah_rutin_ok','',$formulir_prm);
								?>
								<tr>
									<td><?php echo form_label('NOMOR BUKTI PENGAJUAN ANGGARAN'); ?></td>
									<td><?php echo form_input($formulir_nobuk); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('NAMA PROPOSAL KEGIATAN'); ?></td>
									<td><?php echo form_input($formulir_nama); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('TANGGAL PELAKSANAAN'); ?></td>
									<td><?php echo form_input($formulir_tglrnc); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('POS ANGGARAN'); ?></td>
									<td><?php echo form_dropdown($formulir_rek); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label('RENCANA ANGGARAN'); ?></td>
									<td><?php echo form_input($formulir_rnc); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("UNGGAH FOTO NOTA (FILE PNG/JPG/JPEG)"); ?></td>
									<td><?php echo form_input($formulir_csv); ?></td>
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
				<div class="accordion-item" id="frmhutDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR BIAYA RUTIN</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmhutDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table table-hover" id="tblHut">
									<thead>
										<tr>
											<th>NO.MUTASI</th>
											<th>KELOMPOK</th>
											<th>STATUS</th>
											<th>PELAKSANAAN</th>
											<th>KETERANGAN</th>
											<th>RENCANA</th>
											<th>CAIR</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_rutin_master as $hm){ ?>
										<tr>
											<td><?php echo $hm->hut_mst_nobuk ?></td>
											<td><?php echo $hm->kel_mst_subket ?></td>
											<td><?php echo $hm->hut_mst_sts ?></td>
											<td><?php echo $hm->hut_mst_tglrnc ?></td>
											<td><?php echo $hm->hut_mst_ket ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_ttl,2,",",".") ?></td>
											<td>
												<a href="<?php echo base_url().'index.php/klik_b/ubah_rutin_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-warning">UBAH</a>
												<a href="<?php echo base_url().'index.php/klik_b/hapus_rutin_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
var inputan1 = document.getElementById('t_hut_mst_ket');

$(document).ready(
function () {
	$('#tblHut').DataTable();
});


function kasihfokuslah(){
	inputan1.focus();
}

</script>

</html>