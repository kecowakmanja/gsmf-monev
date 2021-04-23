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
	'placeholder' => 'isi nama kegiatan...',
	'required' => 'required'
);

$formulir_tglrnc = array(
	'name' => 't_hut_mst_tglrnc',
	'type' => 'date',
	'class'=>'form-control',
	'id' => 't_hut_mst_tglrnc',
	'required' => 'required'
);

$formulir_rek = array(
	'name' => 't_hut_mst_rek',
	'class' => 'form-control',
	'id' => 't_hut_mst_rek',
	'required' => 'required',
	'options' => '[kosong]-Pilih jenis pengajuan dulu...'
);
	
$formulir_rnc = array(
	'name' => 't_hut_mst_rnc',
	'type' => 'number',
	'class' => 'form-control',
	'value' => '1',
	'id' => 't_hut_mst_rnc',
	'required' => 'required'
);


$tombol_tambah = array(
	'name' => 'btnKirim',
	'value' => 'TAMBAH',
	'class' => 'btn btn-outline-dark btn-lg'
);

	
$tombol_reset = array(
	'name' => 'btnBersih',
	'value' => 'BERSIH',
	'class' => 'btn btn-lg btn-outline-dark'
);

$tombol_catal = array(
	"name" => "btnKirim",
	"value" => "BATAL",
	"class" => "btn btn-lg btn-outline-dark",
	'data-bs-dismiss' => 'modal'
);

$formulir_csv = array(
	"name" => "t_hut_mst_doc",
	"class"=>"form-control",
	"placeholder" => "Masukan file...",
	"id" => "t_hut_mst_doc",
	"type" => "file",
	"accept" => "application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*",
	'required' => 'required'
);




$formulir_catatan_cek = array(
	'name' => 't_cek_mst_ket',
	'class '=> 'form-control',
	'rows' => '3',
	'id' => 't_cek_mst_ket',
	'placeholder' => 'Alasan tidak di sertakan...',
	'disabled' => 'true'
);

$formulir_nobuk_cek = array(
	'id' => 't_cek_mst_nobuk',
	'name' => 't_cek_mst_nobuk',
	'disabled' => 'true',
	'class' => 'form-control'
);

$formulir_tgl_cek = array(
	'id' => 't_cek_mst_tgl',
	'name' => 't_cek_mst_tgl',
	'disabled' => 'true',
	'class' => 'form-control'
);

$formulir_sts_cek = array(
	'id' => 't_cek_mst_sts',
	'name' => 't_cek_mst_sts',
	'disabled' => 'true',
	'class' => 'form-control'
);

$tombol_catal_cek = array(
		'name' => 'btnKirim',
		'value' => 'TUTUP',
		'data-bs-dismiss' => 'modal',
		'class' => 'btn btn-lg btn-secondary'
);

?>

<div class="container-fluid">
	<div class="card text-center">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_c/index'?>"><strong>C1. ANGGARAN</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR ANGGARAN PENDAPATAN
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
			<?php if(!empty($this->session->userdata('validasi_c1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_c1'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			</div>
			<div class="text-end mb-3">
				<a href="#" data-bs-toggle="modal" data-bs-target="#mdlProgram" class="btn btn-lg btn-dark">TAMBAH</a>
			</div>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmhutDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
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
												<a href="#" onclick="detail_hutang_ok('<?php echo $hm->hut_mst_nobuk ?>')" class="btn btn-sm btn-outline-dark">DETAIL</a>
												<a href="<?php echo base_url().'index.php/klik_c/hapus_hutang_ok/'.$hm->hutprm ?>" class="btn btn-sm btn-outline-dark">HAPUS</a>
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
		<div class="card-footer">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>

<!--- modal untuk program -->
<div class="container-fluid">
	<div class="modal" id="mdlProgram" tabindex="-1" aria-labelledby="mdlProgramLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<?php echo form_open_multipart('klik_c/tambah_hutang_ok','',$formulir_prm); ?>
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
						echo form_submit($tombol_catal);
					?>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<!--- MODAL untuk hasil verifikasi -->
<div class="container-fluid">
	<div class="modal" id="mdlVer" tabindex="-1" aria-labelledby="mdlVerLbl" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdlVerLbl"><strong>HASIL</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-sm table-borderless">
						<tbody>
							<tr>
								<td><?php echo form_label('MUTASI'); ?></td>
								<td><?php echo form_input($formulir_nobuk_cek); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('HASIL'); ?></td>
								<td><?php echo form_input($formulir_sts_cek); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('TANGGAL VERIFIKASI') ?></td>
								<td><?php echo form_input($formulir_tgl_cek); ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('CATATAN') ?></td>
								<td><?php echo form_textarea($formulir_catatan_cek); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<?php 
						echo form_submit($tombol_catal_cek); 
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
var url_cari_rek = "<?php echo base_url()."index.php/klik_c/cari_rek/"?>"
var url_detail_verifikasi_ok = "<?php echo base_url()."index.php/klik_d/detail_verifikasi_ok/"?>";

$('#tblHut').DataTable({
	"order": [[ 2 , "asc" ]]
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
	
function detail_hutang_ok(t_hut_mst_nobuk){
	$.ajax({
		type: "POST",
		url: url_detail_verifikasi_ok,
		dataType: 'json',
		data: {per_mst_nobuk:t_hut_mst_nobuk},
		success: function(data){
			console.log(data);
			if(!$.trim(data)){
				$('#t_cek_mst_nobuk').val(t_hut_mst_nobuk);
				$('#t_cek_mst_sts').val('BELUM VERIFIKASI');
				$('#t_cek_mst_tgl').val('0000-00-00');
				$('#t_cek_mst_ket').val('Pengajuan belum di verifikasi...');
			} else {
				$('#t_cek_mst_nobuk').val(data[0].pernobuk);
				$('#t_cek_mst_sts').val(data[0].persts);
				$('#t_cek_mst_tgl').val(data[0].pertgl);
				$('#t_cek_mst_ket').val(data[0].perket);
			}
			$('#mdlVer').modal('toggle');
		}
	})
}


</script>

</html>