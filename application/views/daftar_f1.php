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

$t_kry_mst_kode['']='Pilih kode peserta...';
foreach($daftar_peserta_master as $pm){
	$t_kry_mst_kode[$pm->pst_mst_kode]=$pm->pst_mst_kode;
}

foreach($daftar_pendidikan as $dp){
	$t_kry_mst_pddk[$dp->in_lv_1_kd]=$dp->in_lv_1_ket;
}

foreach($daftar_stsnkh as $dn){
	$t_kry_mst_stsanak[$dn->in_lv_1_kd]=$dn->in_lv_1_ket;
}

foreach($daftar_stskry as $ds){
	$t_kry_mst_gol[$ds->in_lv_1_kd]=$ds->in_lv_1_ket;	
}

$formulir_sts=array(
	'name' => 't_kry_mst_sts',
	'class'=>'form-control',
	'id' => 't_kry_mst_sts',
	'required' => 'required',
	'readonly' => 'true'
);

$formulir_kode=array(
	'name' => 't_kry_mst_kode',
	'class'=>'form-control',
	'id' => 't_kry_mst_kode',
	'placeholder' => 'isi kode peserta...',
	'options' => $t_kry_mst_kode,
	'required' => 'required'
);

$formulir_ktp=array(
	'name' => 't_kry_mst_ic',
	'class'=>'form-control',
	'id' => 't_kry_mst_ic',
	'placeholder' => 'isi no.ktp...',
	'required' => 'required'
);
$formulir_nama=array(
	'name' => 't_kry_mst_nm',
	'class'=>'form-control',
	'id' => 't_kry_mst_nm',
	'placeholder' => 'isi nama...',
	'required' => 'required',
	'readonly' => 'true'
);
$formulir_alamat=array(
	'name' => 't_kry_mst_alamat',
	'class'=>'form-control',
	'id' => 't_kry_mst_alamat',
	'placeholder' => 'isi alamat...',
	'rows' => '6',
	'required' => 'required'
);
$formulir_tgllhr=array(
	'name' => 't_kry_mst_tgllhr',
	'type' => 'date',
	'class'=>'form-control',
	'id' => 't_kry_mst_tgllhr',
	'placeholder' => 'isi tgl lahir...',
	'required' => 'required'
);
$formulir_tglkry=array(
	'name' => 't_kry_mst_tglkry',
	'type' => 'date',
	'class'=>'form-control',
	'id' => 't_kry_mst_tglkry',
	'placeholder' => 'isi tgl mulai berkarya...',
	'required' => 'required'
);
$formulir_pddk=array(
	'name' => 't_kry_mst_pddk',
	'class'=>'form-control',
	'id' => 't_kry_mst_pddk',
	'placeholder' => 'isi tingkat pendidikan...',
	'options' => $t_kry_mst_pddk,
	'required' => 'required'
);
$formulir_stsanak=array(
	'name' => 't_kry_mst_stsanak',
	'class'=>'form-control',
	'id' => 't_kry_mst_stsanak',
	'options' => $t_kry_mst_stsanak,
	'placeholder' => 'isi status/anak...',
	'required' => 'required'
);
$formulir_kel=array(
	'name' => 't_kry_mst_kel',
	'class'=>'form-control',
	'id' => 't_kry_mst_kel',
	'placeholder' => 'isi kelompok bidang kerja...',
	'required' => 'required',
	'readonly' => 'true'
);
$formulir_ket_kel=array(
	'name' => 't_kry_mst_ket',
	'class'=>'form-control',
	'id' => 't_kry_mst_ket',
	'placeholder' => 'isi kelompok bidang kerja...',
	'required' => 'required',
	'readonly' => 'true'
);
$formulir_stskry=array(
	'name' => 't_kry_mst_gol',
	'class'=>'form-control',
	'id' => 't_kry_mst_gol',
	'placeholder' => 'isi status karyawan...',
	'options' => $t_kry_mst_gol,
	'required' => 'required'
);
$formulir_up=array(
	'name' => 't_kry_mst_upah_pokok',
	'class'=>'form-control',
	'id' => 't_kry_mst_upah_pokok',
	'placeholder' => 'total upah pokok...',
	'type' => 'number',
	'value' => '1',
	'required' => 'required'
);
$formulir_tt=array(
	'name' => 't_kry_mst_tunj_ttp',
	'class'=>'form-control',
	'id' => 't_kry_mst_tunj_ttp',
	'placeholder' => 'isi tunjangan tetap...',
	'type' => 'number',
	'value' => '1'
);
$formulir_ttt=array(
	'name' => 't_kry_mst_tunj_t_ttp',
	'class'=>'form-control',
	'id' => 't_kry_mst_tunj_t_ttp',
	'placeholder' => 'isi tunjangan tidak tetap...',
	'type' => 'number',
	'value' => '1'
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

$tombol_batal = array(
	"name" => "btnKirim",
	"value" => "BATAL",
	"class" => "btn btn-lg btn-outline-dark",
	'data-bs-dismiss' => 'modal'
);

$tombol_tutup = array(
	"name" => "btnKirim",
	"value" => "TUTUP",
	"class" => "btn btn-lg btn-outline-dark",
	'data-bs-dismiss' => 'modal'
);

?>


<div class="container-fluid">
	<div class="card text-center bg-light">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/'?>"><strong>DEPAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo base_url().'index.php/klik_f/pilihan_f1'?>"><strong>F1. KARYAWAN</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR KARYAWAN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah sila terlebih dahulu untuk tekan tombol <strong>TAMBAH</strong>.</li>
						<li>Tekan <strong>DETAIL</strong> di <strong>DAFTAR KARYAWAN</strong> dulu supaya bisa melihat detail jurnal.</li>
					</ul>
				</p>
			</div>
			<div>
			<?php if(!empty($this->session->userdata('validasi_f1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_f1') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			</div>
			<div class="text-end mb-3">
				<a href="#" data-bs-toggle="modal" data-bs-target="#mdlKaryawan" class="btn btn-lg btn-dark">TAMBAH</a>
			</div>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkelDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DAFTAR KARYAWAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkelDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblKasDet">
								<thead>
									<tr>
										<th>NO.KTP</th>
										<th>NAMA</th>
										<th>ALAMAT</th>
										<th>TGL.LHR</th>
										<th>KELOMPOK</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_kry_master as $km){ ?>
									<tr>
										<td><?php echo $km->kry_mst_ic ?></td>
										<td><?php echo $km->kry_mst_nm ?></td>
										<td><?php echo $km->kry_mst_alamat ?></td>
										<td><?php echo $km->kry_mst_tgllhr ?></td>
										<td><?php echo $km->kel_mst_subket ?></td>
										<td>
											<a href="#" class="btn btn-outline-dark btn-sm" onClick="cari_karyawan('<?php echo $km->kry_mst_ic; ?>')">DETAIL</a>
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
		<div class="card-footer">
			<h6 class="card-text text-start">LitBang GSMF Banyumanik 2021</h6>
		</div>
	</div>
</div>

<!--- modal untuk isi karyawan -->
<div class="container-fluid">
	<div class="modal" id="mdlKaryawan" tabindex="-1" aria-labelledby="mdlKaryawanLbl" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<?php echo form_open('klik_f/tambah_karyawan_ok'); ?>
				<div class="modal-header">
					<h5 class="modal-title" id="mdlKaryawanLbl"><strong>DATA KARYAWAN</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-md table-borderless table-light">
						<tbody>
							<tr>
								<td class="col-md-3">KODE<?php echo form_dropdown($formulir_kode); ?></td>
								<td class="col-md-3">STATUS<?php echo form_input($formulir_sts); ?></td>
							</tr>
							<tr>
								<td class="col-md-3">KTP<?php echo form_input($formulir_ktp); ?></td>
								<td class="col-md-3">PENDIDIKAN<?php echo form_dropdown($formulir_pddk); ?></td>
							</tr>
							<tr>
								<td class="col-md-3">NAMA<?php echo form_input($formulir_nama); ?></td>
								<td class="col-md-3">BIDANG PEKERJAAN
									<div class="input-group">
										<?php 
										echo form_input($formulir_kel);
										echo form_input($formulir_ket_kel); 
										?>
									</div>
								</td>
							</tr>
							<tr>
								<td class="col-md-3">TGL LAHIR<?php echo form_input($formulir_tgllhr); ?></td>
								<td class="col-md-3">TGL BERKARYA<?php echo form_input($formulir_tglkry); ?></td>
							</tr>
							<tr>
								<td class="col-md-3">PERNIKAHAN/ANAK<?php echo form_dropdown($formulir_stsanak); ?></td>
								<td class="col-md-3">JENIS KARYAWAN<?php echo form_dropdown($formulir_stskry); ?></td>
							</tr>
							<tr>
								<td class="col-md-3">ALAMAT<?php echo form_textarea($formulir_alamat); ?></td>
								<td class="col-md-3">UPAH POKOK<?php echo form_input($formulir_up); ?>
								TUNJANGAN TETAP<?php echo form_input($formulir_tt); ?>
								TUNJANGAN TIDAK TETAP<?php echo form_input($formulir_ttt); ?></td>
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

<!--- modal untuk lihat isi karyawan -->
<div class="container-fluid">
	<div class="modal" id="mdlDetKry" tabindex="-1" aria-labelledby="mdlDetKryLbl" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdlDetKryLbl"><strong>DATA KARYAWAN</strong></h5>
				</div>
				<div class="modal-body">
					<table class="table table-sm">
						<thead>
							<th>PARAMETER</th>
							<th>ISIAN</th>
						</thead>
						<tbody id="hasilajax">
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<?php 
						echo form_submit($tombol_tutup);
					?>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var url_cari_jurnal = "<?php echo base_url()."index.php/klik_f/cari_jurnal/"?>"
var url_cari_peserta = "<?php echo base_url()."index.php/klik_f/cari_peserta/"?>"
var url_cari_karyawan = "<?php echo base_url()."index.php/klik_f/cari_karyawan/"?>"

$('#tblKasDet').DataTable({
	"order": [[ 0, "asc" ]]
});

$("#t_kry_mst_kode").change(function(){
        var pilih_t_kry_mst_kode = $("#t_kry_mst_kode option:selected").val();
		$.ajax({
            type: "POST",
            url: url_cari_peserta,
			dataType: 'json',
            data: {t_pst_mst_sts:'AKTIF',t_pst_mst_kode:pilih_t_kry_mst_kode},
			success: function(data){
				$.each(data,function(key,value){
					$('#t_kry_mst_nm').val(data[0].pstnm);
					$('#t_kry_mst_sts').val(data[0].pststs);
					$('#t_kry_mst_kel').val(data[0].pstkel);
					$('#t_kry_mst_ket').val(data[0].pstket);
				})
			}
		})
	});

function cari_karyawan(t_kry_mst_ic){
	$('#hasilajax').empty();
	$.ajax({
        type: "POST",
        url: url_cari_karyawan,
		dataType: 'json',
        data: {krymstic:t_kry_mst_ic},
		success: function(data){
			$.each(data,function(key,value){
				$('#hasilajax').append(
					"<tr><td>NOMOR IDENTITAS </td><td>"+value.kryic+"</td></tr>"+
					"<tr><td>NAMA KARYAWAN </td><td>"+value.krynm+"</td></tr>"+
					"<tr><td>TANGGAL LAHIR </td><td>"+value.krytgllhr+"</td></tr>"+
					"<tr><td>ALAMAT </td><td>"+value.kryalamat+"</td></tr>"+
					"<tr><td>TANGGAL BERKARYA </td><td>"+value.krytglkry+"</td></tr>"+
					"<tr><td>TINGKAT PENDIDIKAN </td><td>"+value.krypddk+"</td></tr>"+
					"<tr><td>STATUS PERNIKAHAN </td><td>"+value.krystsanak+"</td></tr>"+
					"<tr><td>BIDANG PEKERJAAN </td><td>"+value.krykel+"-"+value.kryket+"</td></tr>"+
					"<tr><td>STATUS KARYAWAN </td><td>"+value.krygol+"</td></tr>"+
					"<tr><td>UPAH POKOK </td><td>"+value.kryupah_pokok+"</td></tr>"+
					"<tr><td>TUNJANGAN TETAP </td><td>"+value.krytunj_ttp+"</td></tr>"+
					"<tr><td>TUNJANGAN TIDAK TETAP </td><td>"+value.krytunj_t_ttp+"</td></tr>"
					);
			})
			$('#mdlDetKry').modal('toggle');
		}
	})
}


</script>
</body>
</html>