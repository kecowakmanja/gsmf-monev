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


$t_inv_mst_tipe=array(
    'BANGUNAN'=>'BANGUNAN'
);

foreach($daftar_sts as $ds){
	$t_inv_mst_sts[$ds->in_lv_1_kd]=$ds->in_lv_1_ket;
}

foreach($daftar_rekening_master as $rm){
	$t_inv_mst_rek[$rm->rek_mst_sub_kode]=$rm->rek_mst_ket_sub_kode;
	$t_inv_mst_rek_sst[$rm->rek_mst_sub_kode]=$rm->rek_mst_ket_sub_kode;
}


$formulir_sts=array(
	'name'=>'t_inv_mst_sts',
	'class'=>'form-control',
	'id'=>'t_inv_mst_sts',
	'options'=>$t_inv_mst_sts
);

$formulir_kode=array(
	'name'=>'t_inv_mst_kode',
	'class'=>'form-control',
	'id'=>'t_inv_mst_kode',
	'placeholder'=>'isi nomor sertifikat...',
	'required'=>'true'
);

$formulir_tipe=array(
	'name'=>'t_inv_mst_tipe',
	'class'=>'form-control',
	'id'=>'t_inv_mst_tipe',
	'options'=>$t_inv_mst_tipe,
	'placeholder'=>'tipe aktiva...',
	'required'=>'true'
);

$formulir_nop=array(
	'name'=>'t_inv_mst_barang',
	'class'=>'form-control',
	'id'=>'t_inv_mst_barang',
	'placeholder'=>'isi nomor objek pajak...',
	'required'=>'true'
);

$formulir_alamat=array(
	'name'=>'t_inv_mst_ket',
	'class'=>'form-control',
	'id'=>'t_inv_mst_ket',
	'placeholder'=>'isi alamat...',
	'required'=>'true'
);

$formulir_nama=array(
	'name'=>'t_inv_mst_nm',
	'class'=>'form-control',
	'id'=>'t_inv_mst_nm',
	'placeholder'=>'atas nama sertifikat...',
	'required'=>'true'
);
$formulir_masa=array(
	'name'=>'t_inv_mst_masa',
	'class'=>'form-control',
	'id'=>'t_inv_mst_masa',
	'placeholder'=>'isi masa pemakaian...',
	'required'=>'true'
);
$formulir_tglbeli=array(
	'name'=>'t_inv_mst_tgl',
	'type'=>'date',
	'class'=>'form-control',
	'id'=>'t_inv_mst_tgl',
	'placeholder'=>'isi tgl beli...',
	'required'=>'true'
);
$formulir_tgljtppajak=array(
	'name'=>'t_inv_mst_jthtmp1',
	'type'=>'date',
	'class'=>'form-control',
	'id'=>'t_inv_mst_jthtmp1',
	'placeholder'=>'isi tgl jtp pajak pbb...',
	'required'=>'true'
);
$formulir_tgljtpstnk=array(
	'name'=>'t_inv_mst_jthtmp2',
	'type'=>'date',
	'class'=>'form-control',
	'id'=>'t_inv_mst_jthtmp2',
	'placeholder'=>'isi tgl jtp stnk...',
	'required'=>'true'
);

$formulir_hrgbl=array(
	'name'=>'t_inv_mst_awal',
	'class'=>'form-control',
	'id'=>'t_inv_mst_awal',
	'type'=>'number',
	'placeholder'=>'isi harga beli...',
	'required'=>'true'
);

$formulir_rek=array(
	'name'=>'t_inv_mst_rek',
	'class'=>'form-control',
	'id'=>'t_inv_mst_rek',
	'placeholder'=>'isi pos rekening...',
	'options'=>$t_inv_mst_rek,
	'required'=>'true'
);

$formulir_rek_sst=array(
	'name'=>'t_inv_mst_rek_sst',
	'class'=>'form-control',
	'id'=>'t_inv_mst_rek_sst',
	'placeholder'=>'isi pos rekening penyusutan...',
	'options'=>$t_inv_mst_rek_sst,
	'required'=>'true'
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

if($this->session->userdata("operator_g1")=="UBAH"){
	foreach($daftar_inventaris_master as $im){		
		$formulir_prm=array("invprm"=>$im->invprm);
		$formulir_kode_ubah=array('value'=>$im->inv_mst_kode,'readonly'=>'true');
		$formulir_sts_ubah=array('selected'=>$im->inv_mst_sts);
		$formulir_tipe_ubah=array('selected'=>$im->inv_mst_tipe);
        $formulir_nop=array('value'=>$im->inv_mst_barang);
		$formulir_alamat_ubah=array('value'=>$im->inv_mst_ket);
		$formulir_nama_ubah=array('value'=> $im->inv_mst_nm);
		$formulir_masa_ubah=array('value'=>$im->inv_mst_masa);
		$formulir_hrgbl_ubah=array('value'=>$im->inv_mst_awal);
		$formulir_tglbeli_ubah=array('value'=>$im->inv_mst_tgl);
		$formulir_rek_ubah=array('selected'=>$im->inv_mst_rek);
		$formulir_tgljtpstnk_ubah=array('value'=>$im->inv_mst_jthtmp2);
		$formulir_rek_sst_ubah=array('selected'=>$im->inv_mst_rek_sst);
		$formulir_tgljtppajak_ubah=array('value'=>$im->inv_mst_jthtmp1);
		
		$tombol_tambah_ubah=array('value'=>'UBAH');

		$formulir_kode=array_merge($formulir_kode,$formulir_kode_ubah);
		$formulir_sts=array_merge($formulir_sts,$formulir_sts_ubah);
		$formulir_tipe=array_merge($formulir_tipe,$formulir_tipe_ubah);
        $formulir_nop=array_merge($formulir_nop,$formulir_nop_ubah);
		$formulir_alamat=array_merge($formulir_alamat,$formulir_alamat_ubah);
		$formulir_nama=array_merge($formulir_nama,$formulir_nama_ubah);
		$formulir_masa=array_merge($formulir_masa,$formulir_masa_ubah);
		$formulir_hrgbl=array_merge($formulir_hrgbl,$formulir_hrgbl_ubah);
		$formulir_tglbeli=array_merge($formulir_tglbeli,$formulir_tglbeli_ubah);
		$formulir_rek=array_merge($formulir_rek,$formulir_rek_ubah);
		$formulir_tgljtpstnk=array_merge($formulir_tgljtpstnk,$formulir_tgljtpstnk_ubah);
		$formulir_rek_sst=array_merge($formulir_rek_sst,$formulir_rek_sst_ubah);
		$formulir_tgljtppajak=array_merge($formulir_tgljtppajak,$formulir_tgljtppajak_ubah);
	
		$tombol_tambah=array_merge($tombol_tambah,$tombol_tambah_ubah);
	}
} else {
	$tombol_tambah_tambah=array('value'=>'TAMBAH');
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
                    <a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_g/pilihan_g1'?>"><strong>G1. STNK</strong></a>
				</li>
                <li class="nav-item">
                    <a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_g/pilihan_g2'?>"><strong>G2. PBB</strong></a>
				</li>
                <li class="nav-item">
					<a class="nav-link bg-dark text-light" href="<?php echo base_url().'index.php/klik_g/pilihan_g3'?>"><strong>G3. BANGUNAN</strong></a>
				</li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url().'index.php/klik_g/pilihan_g4'?>"><strong>G4. PERALATAN</strong></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="alert alert-warning text-start">
				<h5 class="card-title">
					DAFTAR BANGUNAN
				</h5>
				<p class="card-text">
					<ul>
						<li>Untuk menambah sila lengkapi dulu isian di <strong>DETAIL BARANG</strong> dilanjutkan dengan tekan tombol <strong>TAMBAH</strong>.</li>
						<li>Tekan <strong>DETAIL</strong> di <strong>DAFTAR BARANG</strong> dulu supaya bisa melihat data barang.</li>
					</ul>
				</p>
			</div>
			<div>
			<?php if(!empty($this->session->userdata('validasi_g1'))) { ?>
				<div class="alert alert-sm alert-danger alert-dismissible fade show text-start">
					<?php echo $this->session->userdata('validasi_g1') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			</div>
			<div class="accordion text-start">
				<div class="accordion-item" id="frmkryDet1">
					<h6 class="accordion-header" id="judulSatu">
						<button type="button" class="accordion-button bg-warning text-dark" data-bs-toGgle="collapse" data-bs-target="#isiSatu" aria-expanded="true" aria-control="isiSatu">
							<strong>DETAIL BARANG</strong>
						</button>
					</h6>
					<div id="isiSatu" class="accordion-collapse collapse show" data-bs-parent="#frmkryDet1" aria-labelledby="judulSatu">
						<div class="accordion-body">
							<table class="table table-lg table-borderless">
								<?php 
									echo form_open("klik_g/tambah_aktiva_ok","",$formulir_prm);
								?> 	 
								<tbody>
									<tr>
										<td class="col-md-3">TIPE INVENTARIS<?php echo form_dropdown($formulir_tipe); ?></td>
										<td class="col-md-3">STATUS<?php echo form_dropdown($formulir_sts); ?></td>
									</tr>
									<tr>
										<td class="col-md-3">NOMOR SERTIFIKAT<?php echo form_input($formulir_kode); ?></td>
                                        <td class="col-md-3">NOMOR OBJEK PAJAK<?php echo form_input($formulir_nop); ?></td>
									</tr>
									<tr>
										<td class="col-md-3">ATAS NAMA<?php echo form_input($formulir_nama); ?></td>
										<td class="col-md-3">ALAMAT<?php echo form_input($formulir_alamat); ?></td>
									</tr>
									<tr>
										<td class="col-md-3">HARGA BELI<?php echo form_input($formulir_hrgbl); ?></td>
										<td class="col-md-3">TGL BELI<?php echo form_input($formulir_tglbeli); ?></td>
									</tr>
									<tr>
										<td class="col-md-3">POS REKENING BANGUNAN<?php echo form_dropdown($formulir_rek); ?>
									</tr>
									<tr>
										<td class="col-md-3">POS REKENING PENYUSUTAN<?php echo form_dropdown($formulir_rek_sst); ?></td>
										<td class="col-md-3">TGL JATUH TEMPO PAJAK PBB<?php echo form_input($formulir_tgljtppajak); ?></td>
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
							<strong>DAFTAR BARANG</strong>
						</button>
					</h6>
					<div id="isiDua" class="accordion-collapse collapse" data-bs-parent="#frmkryDet2" aria-labelledby="judulDua">
						<div class="accordion-body">
							<table class="table table-sm table-hover" id="tblAktDet">
								<thead>
									<tr>
										<th>NO.POLISI</th>
										<th>TIPE</th>
										<th>MERK</th>
										<th>ATASNAMA</th>
										<th>JTP-PAJAK</th>
										<th>JTP-STNK</th>
										<th>OPERATOR</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($daftar_inventaris_master as $im){ ?>
									<tr>
										<td><?php echo $im->inv_mst_kode ?></td>
										<td><?php echo $im->inv_mst_tipe ?></td>
										<td><?php echo $im->inv_mst_barang ?></td>
										<td><?php echo $im->inv_mst_nm ?></td>
										<td><?php echo $im->inv_mst_jthtmp1 ?></td>
										<td><?php echo $im->inv_mst_jthtmp2 ?></td>
										<td>
											<a href="#" class="btn btn-outline-dark btn-sm" onClick="cari_aktiva('<?php echo $im->invprm; ?>')">DETAIL</a>
											<a href="<?php echo base_url().'index.php/klik_g/ubah_aktiva_ok/'.$im->invprm ?>" class="btn btn-outline-dark btn-sm">UBAH</a>
											<a href="<?php echo base_url().'index.php/klik_g/hapus_aktiva_ok/'.$im->invprm ?>" class="btn btn-outline-dark btn-sm">HAPUS</a>
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

<!--- modal untuk lihat isi aktiva -->
<div class="container-fluid">
	<div class="modal" id="mdlDetAkt" tabindex="-1" aria-labelledby="mdlDetAktLbl" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdlDetAktLbl"><strong>DATA AKTIVA</strong></h5>
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
var url_cari_aktiva="<?php echo base_url()."index.php/klik_g/cari_aktiva/"?>"

$('#tblAktDet').DataTable({
	"order": [[ 0, "asc" ]]
});

function cari_aktiva(t_invprm){
	$('#hasilajax').empty();
	$.ajax({
        type: "POST",
        url: url_cari_aktiva,
		dataType: 'json',
        data: {invprm:t_invprm},
		success: function(data){
			console.log(data);
			$.each(data,function(key,value){
				$('#hasilajax').append(
					"<tr><td>TIPE INVENTARIS </td><td>"+value.invtipe+"</td></tr>"+
					"<tr><td>ALAMAT </td><td>"+value.invbarang+"</td></tr>"+
					"<tr><td>NOMOR SERTIFIKAT </td><td>"+value.invkode+"</td></tr>"+
					"<tr><td>ATAS NAMA SERTIFKAT </td><td>"+value.invnm+"</td></tr>"+
					"<tr><td>KEPEMILIKAN </td><td>"+value.invpemilik+"</td></tr>"+
					"<tr><td>JATUH TEMPO PAJAK BUMI BANGUNAN </td><td>"+value.invjthtmp1+"</td></tr>"+
					"<tr><td>JATUH TEMPO STNK </td><td>"+value.invjthtmp2+"</td></tr>"+
					"<tr><td>TANGGAL PEMBELIAN </td><td>"+value.invtgl+"</td></tr>"+
					"<tr><td>MASA PAKAI AKTIVA </td><td>"+value.invmasa+"</td></tr>"+
					"<tr><td>HARGA PEMBELIAN </td><td>"+value.invawal+"</td></tr>"+
					"<tr><td>BIAYA PERBAIKAN </td><td>"+value.invtambah+"</td></tr>"+
					"<tr><td>PENYUSUTAN </td><td>"+value.invkurang+"</td></tr>"+
					"<tr><td>NILAI AKTIVA </td><td>"+value.invkurang+"</td></tr>"
					);
			})
			$('#mdlDetAkt').modal('toggle');
		}
	})
}

</script>
</body>
</html>