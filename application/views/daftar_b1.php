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
<?php

$tombol_tambah = array(
'name' => 'btnKirim',
'value' => 'UBAH',
'class' => 'btn btn-success btn-sm'
);
		
$formulir_prm = array(
	'name' => 't_hutprm',
	'readonly' => 'true',
	'class' => 'form-control form-control-sm'
);

$formulir_nobuk = array(
	'name' => 't_hut_mst_nobuk',
	'class' => 'form-control',
	'readonly' => 'true',
	'id' => 't_hut_mst_nobuk'
);

$t_hut_jenis[""] = "Pilihan jenis pengajuan...";
foreach ($daftar_rekening_master as $rm) {
	$t_hut_jenis[$rm->rek_mst_kode] = $rm->rek_mst_kode;
}

$formulir_jns = array(
	'id' => 't_hut_jenis',
	'name' => 't_hut_jenis',
	'class' => 'form-control',
	'options' => $t_hut_jenis
);

	
$formulir_nama = array(
	'name' => 't_hut_mst_ket',
	'class'=>'form-control',
	'id' => 't_hut_mst_ket',
	'placeholder' => 'isi nama kegiatan...'
);

$formulir_tglrnc = array(
	'name' => 't_hut_mst_tglrnc',
	'type' => 'date',
	'class'=>'form-control',
	'id' => 't_hut_mst_tglrnc'
);

$formulir_rek = array(
	'name' => 't_hut_mst_rek',
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


$tombol_tambah = array(
	'name' => 'btnKirim',
	'value' => 'TAMBAH',
	'class' => 'btn btn-success btn-lg'
);

	
$tombol_reset = array(
	'name' => 'btnBersih',
	'value' => 'BERSIH',
	'class' => 'btn btn-lg btn-secondary'
);

$tombol_batal = array(
	"name" => "btnKirim",
	"value" => "BATAL",
	"class" => "btn btn-lg btn-danger"
);

$formulir_csv = array(
	"name" => "t_hut_mst_doc",
	"class"=>"form-control",
	"placeholder" => "Masukan file...",
	"id" => "t_hut_mst_doc",
	"type" => "file",
	"accept" => "application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*"
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
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_b/index'?>"><strong>B1. PROGRAM</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-info text-start">
				<h5 class="card-title">
					DAFTAR PENGAJUAN PROGRAM DAN BIAYA RUTIN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah pengajuan sila terlebih dahulu untuk tekan tombol <strong>TAMBAH</strong>.</li>
						<li>Jangan lupa untuk pengajuan program supaya dokumen proposal ikut di unggah atau bukti biaya/nota/struk bila pengajuan rutin.</li>
						<li>Bila ada kesalahan untuk data yang sudah ter-input, sila tekan <strong>HAPUS</strong> lanjut input ulang.</li>
						<li>Silahkan manfaatkan kotak <strong>SEARCH</strong> untuk melakukan pencarian pengajuan anggaran.</li>
					</ul>
				</p>
			</div>
			<div>
			<?php if(!empty($this->session->userdata('validasi_b1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_b1'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			</div>
			<div class="text-end mb-3">
				<a href="#" data-bs-toggle="modal" data-bs-target="#mdlProgram" class="btn btn-lg btn-primary">TAMBAH</a>
			</div>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmhutDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR PROGRAM</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmhutDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table table-hover" id="tblHut">
									<thead>
										<tr>
											<th>NO.MUTASI</th>
											<th>JENIS</th>
											<th>STATUS</th>
											<th>PELAKSANAAN</th>
											<th>KETERANGAN</th>
											<th>RENCANA</th>
											<th>CAIR</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_hutang_master as $hm){ ?>
										<tr>
											<td><?php echo $hm->hut_mst_nobuk ?></td>
											<td><?php echo $hm->rek_mst_kode ?></td>
											<td><?php echo $hm->hut_mst_sts ?></td>
											<td><?php echo $hm->hut_mst_tglrnc ?></td>
											<td><?php echo $hm->hut_mst_ket ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_rnc,2,",",".") ?></td>
											<td><?php echo 'Rp'. number_format($hm->hut_mst_ttl,2,",",".") ?></td>
											<td>
												<a href="<?php echo base_url().'index.php/klik_b/hapus_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-danger">HAPUS</a>
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

<!--- modal untuk program -->
<div class="container-fluid">
	<div class="modal" id="mdlProgram" tabindex="-1" aria-labelledby="mdlProgramLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<?php echo form_open_multipart('klik_b/tambah_hutang_ok','',$formulir_prm); ?>
				<div class="modal-header">
					<h5 class="modal-title" id="mdlProgramLbl"><strong>PROGRAM DAN BIAYA RUTIN</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-sm table-borderless">
						<tbody>
							<tr>
								<td><?php echo form_label('JENIS'); ?></td>
								<td><?php echo form_dropdown($formulir_jns); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('KEGIATAN'); ?></td>
								<td><?php echo form_input($formulir_nama); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('PELAKSANAAN'); ?></td>
								<td><?php echo form_input($formulir_tglrnc); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('POS'); ?></td>
								<td><?php echo form_dropdown($formulir_rek); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('RENCANA'); ?></td>
								<td><?php echo form_input($formulir_rnc); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label("UNGGAH PROPOSAL"); ?></td>
								<td><?php echo form_input($formulir_csv); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<?php 
						echo form_submit($tombol_tambah);
						echo form_reset($tombol_reset);
						echo form_submit($tombol_batal);
					?>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

</body>
<script type="text/javascript">
var inputan1 = document.getElementById('t_hut_mst_ket');
var url_cari_rek = "<?php echo base_url()."index.php/klik_b/cari_rek/"?>"

$(document).ready(
function () {
	$('#tblHut').DataTable();
});

$("#t_hut_jenis").change(function(){
        var pilih_t_hut_jenis = $("#t_hut_jenis option:selected").val();
		$("#t_hut_mst_rek").empty();
		$.ajax({
            type: "POST",
            url: url_cari_rek,
			dataType: 'json',
            data: {t_kode_rek:pilih_t_hut_jenis},
			success: function(data){
				console.log(data);
				if(pilih_t_hut_jenis != ""){
					$.each(data,function(key,value){
						$("#t_hut_mst_rek").append('<option value="'+key+'">'+value+'</option>');
					})
				}
			}
		})
	});


</script>

</html>