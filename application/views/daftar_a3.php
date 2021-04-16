<!DOCTYPE html>
<html>
<head>
<title>HALAMANDEPAN-GSMF</title>
	<link href="<?php echo base_url()."assets/css/bootstrap.css"?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()."assets/css/bs-jq.css"?>" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url()."assets/js/bootstrap.bundle.js"?>"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	
</head>
<body onload=kasihfokuslah();>
<?php


foreach ($daftar_info_level_1_sts as $lv1_sts) {
	$t_rek_mst_sts[$lv1_sts->in_lv_1_kd] = $lv1_sts->in_lv_1_ket;
}

$t_rek_mst_kel[""] = "Pilihan kelompok rekening...";
foreach ($daftar_info_level_1_rek as $lv1_rek) {
	$t_rek_mst_kel[$lv1_rek->in_lv_1_kd] = $lv1_rek->in_lv_1_ket;
}

foreach ($daftar_info_level_1_ap as $lv1_ap) {
	$t_rek_mst_pos[$lv1_ap->in_lv_1_kd] = $lv1_ap->in_lv_1_ket;
}


$formulir_prm = array();

if(!empty($this->session->userdata("operator_a3"))){
	if($this->session->userdata("operator_a3")!="TAMBAH"){
		$tombol_tambah = array(
			"name" => "btnKirim",
			"value" => "UBAH",
			"class" => "btn btn-sm btn-success"
		);
		foreach($daftar_rekening_master as $rm){
			$formulir_status = array(
				"name" => "t_rek_mst_sts",
				"options" => $t_rek_mst_sts,
				"selected" => $rm->rek_mst_sts,
				"class"=>"form-control custom-select"
			);
			
			$formulir_pos = array(
				"name" => "t_rek_mst_pos",
				"options" => $t_rek_mst_pos,
				"selected" => $rm->rek_mst_pos,
				"class"=>"form-control custom-select"
			);
			
			$formulir_prm = array(
				"rekprm" => $rm->rekprm
			);

			$formulir_kel = array(
				"name" => "t_rek_mst_kel",
				"class"=>"form-control custom-select",
				"options" => $t_rek_mst_kel,
				"id" => "t_rek_mst_kel"
			);
			
			$formulir_gol = array(
				"name" => "t_rek_mst_gol",
				"class"=>"form-control",
				"id" => "t_rek_mst_gol"
			);
			
			$formulir_sub_gol  = array(
				"name" => "t_rek_mst_sub_gol",
				"class"=>"form-control",
				"id" => "t_rek_mst_sub_gol"
			);
			
			$formulir_kode  = array(
				"name" => "t_rek_mst_kode",
				"class"=>"form-control",
				"id" => "t_rek_mst_kode"
			);
			
			$formulir_sub_kode = array(
				"name" => "t_rek_mst_sub_kode",
				"value" => $rm->rek_mst_sub_kode,
				"class"=>"form-control",
				"id" => "t_rek_mst_sub_kode"
			);
			
			$formulir_sub_ket_kode = array(
				"name" => "t_rek_mst_ket_sub_kode",
				"value" => $rm->rek_mst_ket_sub_kode,
				"class"=>"form-control",
				"id" => "t_rek_mst_ket_sub_kode"
			);
			
		}
	} 
} else {
	$tombol_tambah = array(
		"name" => "btnKirim",
		"value" => "TAMBAH",
		"class" => "btn btn-sm btn-success"
	);
	$formulir_status = array(
		"name" => "t_rek_mst_sts",
		"options" => $t_rek_mst_sts,
		"class"=>"form-control custom-select"
	);
	
	$formulir_pos = array(
		"name" => "t_rek_mst_pos",
		"options" => $t_rek_mst_pos,
		"class"=>"form-control custom-select"
	);

	$formulir_kel = array(
		"name" => "t_rek_mst_kel",
		"options" => $t_rek_mst_kel,
		"class"=>"form-control custom-select",
		"id" => "t_rek_mst_kel"
	);
	
	$formulir_gol = array(
		"name" => "t_rek_mst_gol",
		"class"=>"form-control",
		"id" => "t_rek_mst_gol"
	);

	$formulir_sub_gol  = array(
		"name" => "t_rek_mst_sub_gol",
		"class"=>"form-control",
		"id" => "t_rek_mst_sub_gol"
	);
	
	$formulir_kode  = array(
		"name" => "t_rek_mst_kode",
		"class"=>"form-control",
		"id" => "t_rek_mst_kode"
	);
	
	$formulir_sub_kode = array(
		"name" => "t_rek_mst_sub_kode",
		"class"=>"form-control",
		"id" => "t_rek_mst_sub_kode"
	);
	
	$formulir_sub_ket_kode = array(
		"name" => "t_rek_mst_ket_sub_kode",
		"class"=>"form-control",
		"id" => "t_rek_mst_ket_sub_kode"
	);
	
}
$tombol_reset = array(
	"name" => "btnBersih",
	"value" => "BERSIH",
	"class" => "btn btn-sm btn-secondary"
);

$tombol_proses = array(
	"name" => "btnProses",
	"value" => "PROSES",
	"class" => "btn btn-sm btn-success"
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
	"name" => "t_rek_csv",
	"class"=>"form-control",
	"placeholder" => "Masukan file...",
	"id" => "t_rek_csv",
	"type" => "file",
	"accept" => ".csv"
);

?>
<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()."index.php/"?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()."index.php/klik_a/pilihan_a1"?>"><strong>A1.KELOMPOK</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()."index.php/klik_a/pilihan_a2"?>"><strong>A2.PESERTA</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url()."index.php/klik_a/pilihan_a3"?>"><strong>A3.REKENING</strong></a>
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
						<li>Tombol operator <strong>UBAH</strong>, <strong>HAPUS</strong> pada <strong>DAFTAR REKENING</strong> untuk melakukan perubahan dan menghapus.</li>
					</ul>
				</p>
			</div>
			<?php if(!empty($this->session->userdata("validasi_a3"))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata("validasi_a3") ?>
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
							<table class="table table-sm table-borderless">
								<?php 
									echo form_open("klik_a/tambah_rekening_ok","",$formulir_prm);
								?> 	 
								<tr>
									<td><?php echo form_label("STATUS"); ?></td>
									<td><?php echo form_dropdown($formulir_status); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("POSISI JURNAL"); ?></td>
									<td><?php echo form_dropdown($formulir_pos); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("KELOMPOK"); ?></td>
									<td><?php echo form_dropdown($formulir_kel); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("GOLONGAN"); ?></td>
									<td><?php echo form_dropdown($formulir_gol); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("SUB-GOLONGAN"); ?></td>
									<td><?php echo form_dropdown($formulir_sub_gol); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("KODE REKENING"); ?></td>
									<td><?php echo form_dropdown($formulir_kode); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("KODE SUB-REKENING"); ?></td>
									<td><?php echo form_input($formulir_sub_kode); ?></td>
								</tr>
								<tr>
									<td><?php echo form_label("KETERANGAN SUB-REKENING"); ?></td>
									<td><?php echo form_input($formulir_sub_ket_kode); ?></td>
								</tr>
								<tr>
									<td>
									</td>
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
							<table class="table table-sm table-borderless">
								<?php 
									echo form_open_multipart("klik_a/proses_rekening_ok");
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
				<div class="accordion-item" id="frmrekDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR REKENING</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse show" data-bs-parent="#frmrekDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<div class="table thead-light text-start">
								<table class="table table-hover" id="tblrek">
									<thead>
										<tr>
											<th>GOLONGAN</th>
											<th>SUB-GOLONGAN</th>
											<th>KODE</th>
											<th>SUB-KODE</th>
											<th>KETERANGAN</th>
											<th>OPERATOR</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($daftar_rekening_master as $rm){ ?>
										<tr>
											<td><?php echo $rm->rek_mst_gol ?></td>
											<td><?php echo $rm->rek_mst_sub_gol ?></td>
											<td><?php echo $rm->rek_mst_kode ?></td>
											<td><?php echo $rm->rek_mst_sub_kode ?></td>
											<td><?php echo $rm->rek_mst_ket_sub_kode ?></td>
											<td><a href="<?php echo base_url()."index.php/klik_a/ubah_rekening_ok/".$rm->rekprm ?>" class="btn btn-sm btn-warning">UBAH</a>
												<a href="<?php echo base_url()."index.php/klik_a/hapus_rekening_ok/".$rm->rek_mst_sub_kode ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
var url_cari_level_2 = "<?php echo base_url()."index.php/klik_a/cari_info_level_2/"?>"
var url_cari_level_3 = "<?php echo base_url()."index.php/klik_a/cari_info_level_3/"?>"
var url_cari_level_4 = "<?php echo base_url()."index.php/klik_a/cari_info_level_4/"?>"
var url_cari_auto_sub_kode = '<?php echo base_url().'index.php/klik_a/cari_auto_rekening_ok/?'?>'



$("#tblrek").DataTable({
	"order": [[ 1, "asc" ]]
});

function lanjut_level_1(){
	$("#t_rek_mst_gol").empty();				
	$("#t_rek_mst_gol").prop("disabled",true);
	$("#t_rek_mst_sub_gol").empty();
	$("#t_rek_mst_sub_gol").prop("disabled",true);
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",true);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function lanjut_level_2(){
	$("#t_rek_mst_gol").empty();				
	$("#t_rek_mst_gol").prop("disabled",false);
	$("#t_rek_mst_sub_gol").empty();
	$("#t_rek_mst_sub_gol").prop("disabled",true);
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",true);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function matikan_level_3(){
	$("#t_rek_mst_sub_gol").empty();
	$("#t_rek_mst_sub_gol").prop("disabled",true);
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",true);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function lanjut_level_3(){
	$("#t_rek_mst_sub_gol").empty();
	$("#t_rek_mst_sub_gol").prop("disabled",false);
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",true);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function matikan_level_4(){
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",true);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function lanjut_level_4(){
	$("#t_rek_mst_kode").empty();
	$("#t_rek_mst_kode").prop("disabled",false);
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function matikan_level_5(){
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",true);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",true);
}

function lanjut_level_5(){
	$("#t_rek_mst_sub_kode").value="";
	$("#t_rek_mst_sub_kode").prop("disabled",false);
	$("#t_rek_mst_ket_sub_kode").value="";
	$("#t_rek_mst_ket_sub_kode").prop("disabled",false);
}


function kasihfokuslah(){
	lanjut_level_1();
}

$("#t_rek_mst_kel").change(function(){
        var pilih_t_rek_mst_kel = $("#t_rek_mst_kel option:selected").val();
		$.ajax({
            type: "POST",
            url: url_cari_level_2,
			dataType: 'json',
            data: {kode_level_1:pilih_t_rek_mst_kel},
			success: function(data){
				if(pilih_t_rek_mst_kel != ""){
					lanjut_level_2();
					$.each(data,function(key,value){
						$("#t_rek_mst_gol").append('<option value="'+key+'">'+value+'</option>');
					})					
				} else {
					lanjut_level_1();
				}
			}
		})
	});

$("#t_rek_mst_gol").change(function(){
        var pilih_t_rek_mst_kel = $("#t_rek_mst_kel option:selected").val();
		var pilih_t_rek_mst_gol = $("#t_rek_mst_gol option:selected").val();
		$.ajax({
            type: "POST",
            url: url_cari_level_3,
			dataType: 'json',
            data: {kode_level_1:pilih_t_rek_mst_kel,kode_level_2:pilih_t_rek_mst_gol},
			success: function(data){
				if(pilih_t_rek_mst_gol != ""){
					lanjut_level_3();
					$.each(data,function(key,value){
						$("#t_rek_mst_sub_gol").append('<option value="'+key+'">'+value+'</option>');
					})
				} else {
					matikan_level_3();
				}
			}
		})
	});

$("#t_rek_mst_sub_gol").change(function(){
        var pilih_t_rek_mst_kel = $("#t_rek_mst_kel option:selected").val();
		var pilih_t_rek_mst_gol = $("#t_rek_mst_gol option:selected").val();
		var pilih_t_rek_mst_sub_gol = $("#t_rek_mst_sub_gol option:selected").val();
		$.ajax({
            type: "POST",
            url: url_cari_level_4,
			dataType: 'json',
            data: {kode_level_1:pilih_t_rek_mst_kel,kode_level_2:pilih_t_rek_mst_gol,kode_level_3:pilih_t_rek_mst_sub_gol},
			success: function(data){
				if(pilih_t_rek_mst_sub_gol != ""){
					lanjut_level_4();
					$.each(data,function(key,value){
						$("#t_rek_mst_kode").append('<option value="'+key+'">'+value+'</option>');
					})
				} else {
					matikan_level_4();
				} 
			}
		})
	});
	
$("#t_rek_mst_kode").change(function(){
        var pilih_t_rek_mst_kel = $("#t_rek_mst_kel option:selected").val();
		var pilih_t_rek_mst_gol = $("#t_rek_mst_gol option:selected").val();
		var pilih_t_rek_mst_sub_gol = $("#t_rek_mst_sub_gol option:selected").val();
		var pilih_t_rek_mst_kode = $("#t_rek_mst_kode option:selected").val();
				if(pilih_t_rek_mst_kode != ""){
					lanjut_level_5();
				} else {
					matikan_level_5();
				} 
		});
		
$('#t_rek_mst_sub_kode').autocomplete({
	source: function(request, response) {
	$.getJSON(url_cari_auto_sub_kode, 
		{	extra1: $('#t_rek_mst_kel').val(),
			extra2: $('#t_rek_mst_gol').val(), 
			extra3: $('#t_rek_mst_sub_gol').val(),
			extra4: $('#t_rek_mst_kode').val(), 
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
