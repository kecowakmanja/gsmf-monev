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

$formulir_prm=array();


foreach($daftar_pendidikan as $dp){
	$t_kry_mst_pddk[$dp->in_lv_1_kd]=$dp->in_lv_1_ket;
}

foreach($daftar_stsnkh as $dn){
	$t_kry_mst_stsanak[$dn->in_lv_1_kd]=$dn->in_lv_1_ket;
}

foreach($daftar_stskry as $ds){
	$t_kry_mst_gol[$ds->in_lv_1_kd]=$ds->in_lv_1_ket;	
}

foreach($daftar_rekening_master as $rm){
	$t_kry_mst_rek[$rm->rek_mst_sub_kode]=$rm->rek_mst_ket_sub_kode;	
}


$formulir_sts=array(
	'name'=>'t_kry_mst_sts',
	'class'=>'form-control',
	'id'=>'t_kry_mst_sts',
	'readonly'=>'true'
);

$formulir_kode=array(
	'name'=>'t_kry_mst_kode',
	'class'=>'form-control',
	'id'=>'t_kry_mst_kode',
	'placeholder'=>'isi kode peserta...'
);

$formulir_ktp=array(
	'name'=>'t_kry_mst_ic',
	'class'=>'form-control',
	'id'=>'t_kry_mst_ic',
	'placeholder'=>'isi no.ktp...'
);
$formulir_nama=array(
	'name'=>'t_kry_mst_nm',
	'class'=>'form-control',
	'id'=>'t_kry_mst_nm',
	'placeholder'=>'isi nama...',
	'readonly'=>'true'
);
$formulir_alamat=array(
	'name'=>'t_kry_mst_alamat',
	'class'=>'form-control',
	'id'=>'t_kry_mst_alamat',
	'placeholder'=>'isi alamat...',
	'rows'=>'8'
);
$formulir_tgllhr=array(
	'name'=>'t_kry_mst_tgllhr',
	'type'=>'date',
	'class'=>'form-control',
	'id'=>'t_kry_mst_tgllhr',
	'placeholder'=>'isi tgl lahir...'
);
$formulir_tglkry=array(
	'name'=>'t_kry_mst_tglkry',
	'type'=>'date',
	'class'=>'form-control',
	'id'=>'t_kry_mst_tglkry',
	'placeholder'=>'isi tgl mulai berkarya...'
);
$formulir_pddk=array(
	'name'=>'t_kry_mst_pddk',
	'class'=>'form-control',
	'id'=>'t_kry_mst_pddk',
	'placeholder'=>'isi tingkat pendidikan...',
	'options'=>$t_kry_mst_pddk
);
$formulir_stsanak=array(
	'name'=>'t_kry_mst_stsanak',
	'class'=>'form-control',
	'id'=>'t_kry_mst_stsanak',
	'options'=>$t_kry_mst_stsanak,
	'placeholder'=>'isi status/anak...'
);
$formulir_kel=array(
	'name'=>'t_kry_mst_kel',
	'class'=>'form-control',
	'id'=>'t_kry_mst_kel',
	'placeholder'=>'isi kelompok bidang kerja...',
	'readonly'=>'true'
);
$formulir_ket_kry=array(
	'name'=>'t_kry_mst_ket',
	'class'=>'form-control',
	'id'=>'t_kry_mst_ket',
	'placeholder'=>'isi kelompok bidang kerja...',
	'readonly'=>'true'
);
$formulir_stskry=array(
	'name'=>'t_kry_mst_gol',
	'class'=>'form-control',
	'id'=>'t_kry_mst_gol',
	'options'=>$t_kry_mst_gol,
	'placeholder'=>'isi status karyawan...'
);
$formulir_up=array(
	'name'=>'t_kry_mst_upah_pokok',
	'class'=>'form-control',
	'id'=>'t_kry_mst_upah_pokok',
	'placeholder'=>'total upah pokok...',
	'type'=>'number',
	'value'=>'0'
);
$formulir_tt=array(
	'name'=>'t_kry_mst_tunj_ttp',
	'class'=>'form-control',
	'id'=>'t_kry_mst_tunj_ttp',
	'placeholder'=>'isi tunjangan tetap...',
	'type'=>'number',
	'value'=>'0'
);
$formulir_ttt=array(
	'name'=>'t_kry_mst_tunj_t_ttp',
	'class'=>'form-control',
	'id'=>'t_kry_mst_tunj_t_ttp',
	'placeholder'=>'isi tunjangan tidak tetap...',
	'type'=>'number',
	'value'=>'0'
);
$formulir_rek=array(
	'name'=>'t_kry_mst_rek',
	'class'=>'form-control',
	'id'=>'t_kry_mst_rek',
	'placeholder'=>'isi tunjangan tidak tetap...',
	'options'=>$t_kry_mst_rek
);

$tombol_tambah=array(
	'name'=>'btnKirim',
	'class'=>'btn btn-outline-dark btn-lg'
);

$tombol_batal=array(
	"name"=>"btnKirim",
	"value"=>"BATAL",
	"class"=>"btn btn-lg btn-outline-dark",

);
$tombol_tutup=array(
	"name"=>"btnKirim",
	"value"=>"TUTUP",
	"class"=>"btn btn-lg btn-outline-dark",
	'data-bs-dismiss'=>'modal'
);

if($this->session->userdata("operator_f1")=="UBAH"){
	foreach($daftar_kry_master as $km){
		$t_kry_mst_kode[$km->kry_mst_kode]=$km->kry_mst_kode;
		
		$formulir_prm=array("kryprm"=>$km->kryprm);
		$formulir_kode_ubah=array('options'=>$t_kry_mst_kode,'selected'=>$km->kry_mst_kode);
		$formulir_sts_ubah=array('value'=>$km->kry_mst_sts);
		$formulir_ktp_ubah=array('value'=>$km->kry_mst_ic);
		$formulir_nama_ubah=array('value'=> $km->pst_mst_nm);
		$formulir_alamat_ubah=array('value'=>$km->kry_mst_alamat);
		$formulir_tgllhr_ubah=array('value'=>$km->kry_mst_tgllhr);
		$formulir_tglkry_ubah=array('value'=>$km->kry_mst_tglkry);
		$formulir_pddk_ubah=array('selected'=>$km->kry_mst_pddk);
		$formulir_stsanak_ubah=array('selected'=>$km->kry_mst_stsanak);
		$formulir_kel_ubah=array('value'=>$km->pst_mst_kel);
		$formulir_ket_kry_ubah=array('value'=>$km->kel_mst_subket);
		$formulir_up_ubah=array('value'=>$km->kry_mst_upah_pokok);
		$formulir_tt_ubah=array('value'=>$km->kry_mst_tunj_ttp);
		$formulir_ttt_ubah=array('value'=>$km->kry_mst_tunj_t_ttp);
		$tombol_tambah_ubah=array('value'=>'UBAH');

		$formulir_kode=array_merge($formulir_kode,$formulir_kode_ubah);
		$formulir_sts=array_merge($formulir_sts,$formulir_sts_ubah);
		$formulir_ktp=array_merge($formulir_ktp,$formulir_ktp_ubah);
		$formulir_nama=array_merge($formulir_nama,$formulir_nama_ubah);
		$formulir_alamat=array_merge($formulir_alamat,$formulir_alamat_ubah);
		$formulir_tgllhr=array_merge($formulir_tgllhr,$formulir_tgllhr_ubah);
		$formulir_tglkry=array_merge($formulir_tglkry,$formulir_tglkry_ubah);
		$formulir_pddk=array_merge($formulir_pddk,$formulir_pddk_ubah);
		$formulir_stsanak=array_merge($formulir_stsanak,$formulir_stsanak_ubah);
		$formulir_kel=array_merge($formulir_kel,$formulir_kel_ubah);
		$formulir_ket_kry=array_merge($formulir_ket_kry,$formulir_ket_kry_ubah);
		$formulir_up=array_merge($formulir_up,$formulir_up_ubah);
		$formulir_tt=array_merge($formulir_tt,$formulir_tt_ubah);
		$formulir_ttt=array_merge($formulir_ttt,$formulir_ttt_ubah);
		$tombol_tambah=array_merge($tombol_tambah,$tombol_tambah_ubah);
	}
} else {
	$t_kry_mst_kode['']='Pilih kode peserta...';
	foreach($daftar_peserta_master as $pm){
		$t_kry_mst_kode[$pm->pst_mst_kode]=$pm->pst_mst_kode;
	}
	$formulir_kode_tambah=array('options'=>$t_kry_mst_kode);
	$tombol_tambah_tambah=array('value'=>'TAMBAH');
	$formulir_kode=array_merge($formulir_kode,$formulir_kode_tambah);
	$tombol_tambah=array_merge($tombol_tambah,$tombol_tambah_tambah);
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
						<li>Untuk menambah sila lengkapi dulu isian di <strong>DETAIL KARYAWAN</strong> dilanjutkan dengan tekan tombol <strong>TAMBAH</strong>.</li>
						<li>Karyawan harus terdaftar sebagai pengguna di form A2, silahkan hubungi administrator untuk menambah pengguna.</li>
						<li>Tekan <strong>DETAIL</strong> di <strong>DAFTAR KARYAWAN</strong> dulu supaya bisa melihat data karyawan.</li>
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
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkryDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL KARYAWAN</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkryDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-lg table-borderless">
								<?php 
									echo form_open("klik_f/tambah_karyawan_ok","",$formulir_prm);
								?> 	 
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
												echo form_input($formulir_ket_kry); 
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
										<td class="col-md-3">
											POS PENGUPAHAN<?php echo form_dropdown($formulir_rek); ?>
											UPAH POKOK<?php echo form_input($formulir_up); ?>
											TUNJANGAN TETAP<?php echo form_input($formulir_tt); ?>
											TUNJANGAN TIDAK TETAP<?php echo form_input($formulir_ttt); ?>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>
										</td>
										<td class="text-end">
											<?php 
												echo form_submit($tombol_tambah);
												echo form_submit($tombol_batal);
											?>
										</td>
									</tr>
								</tfoot>
							</table>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkryDet2">
					<h6 class="accordion-header" id="judulDua">
						<button type="button" class="accordion-button collapsed bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiDua" aria-expanded="true" aria-control="isiDua">
							<strong>DAFTAR KARYAWAN</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse" data-bs-parent="#frmkryDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblKryDet">
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
										<td><?php echo $km->pst_mst_nm ?></td>
										<td><?php echo $km->kry_mst_alamat ?></td>
										<td><?php echo $km->kry_mst_tgllhr ?></td>
										<td><?php echo $km->kel_mst_subket ?></td>
										<td>
											<a href="#" class="btn btn-outline-dark btn-sm" onClick="cari_karyawan('<?php echo $km->kryprm; ?>')">DETAIL</a>
											<a href="<?php echo base_url().'index.php/klik_f/ubah_karyawan_ok/'.$km->kryprm ?>" class="btn btn-outline-dark btn-sm">UBAH</a>
											<a href="<?php echo base_url().'index.php/klik_f/hapus_karyawan_ok/'.$km->kryprm ?>" class="btn btn-outline-dark btn-sm">HAPUS</a>
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
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var url_cari_peserta="<?php echo base_url()."index.php/klik_f/cari_peserta/"?>"
var url_cari_karyawan="<?php echo base_url()."index.php/klik_f/cari_karyawan/"?>"


$('#tblKryDet').DataTable({
	"order": [[ 0, "asc" ]]
});

$("#t_kry_mst_kode").change(function(){
        var pilih_t_kry_mst_kode=$("#t_kry_mst_kode option:selected").val();
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

function cari_karyawan(t_kryprm){
	$('#hasilajax').empty();
	$.ajax({
        type: "POST",
        url: url_cari_karyawan,
		dataType: 'json',
        data: {kryprm:t_kryprm},
		success: function(data){
			$.each(data,function(key,value){
				$('#hasilajax').append(
					"<tr><td>NOMOR IDENTITAS </td><td>"+value.kryic+"</td></tr>"+
					"<tr><td>NAMA KARYAWAN </td><td>"+value.krynm+"</td></tr>"+
					"<tr><td>TANGGAL BERKARYA </td><td>"+value.krytglkry+"</td></tr>"+
					"<tr><td>TINGKAT PENDIDIKAN </td><td>"+value.krypddk+"</td></tr>"+
					"<tr><td>STATUS PERNIKAHAN </td><td>"+value.krystsanak+"</td></tr>"+
					"<tr><td>BIDANG PEKERJAAN </td><td>"+value.krykel+"-"+value.kryket+"</td></tr>"+
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