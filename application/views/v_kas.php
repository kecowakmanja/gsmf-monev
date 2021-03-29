<!DOCTYPE html>
<html>
<head>
	<title>[ANGGARAN-GSMF]</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="row justify-content-md-center">
		<div class="col col-lg-10">
			<div class="table thead-light">
				<h1>[ANGGARAN-GSMF]</h1>
				<table border="0">
					<tr>
						<th><?php echo anchor('c_depan/index','[AWAL]'); ?></th>
						<th><?php echo anchor('c_kas/daftar_kas','[LIHAT]'); ?></th>
					</tr>
				</table>
				<table border="0">
					<?php 
					echo form_open('c_kas/daftar_kas_saring'); 
					$c_mtssts = [
						'' => 'SEMUA',
						'SELESAI' => 'SELESAI'
					];
					$c_mtsrekprm = array('' => 'SEMUA');
					foreach	($daftar_rekening_kas as $rk){
						$c_mtsrekprm[$rk->rekprm] = $rk->rekket;
					}
					$c_hutrekprm = array('' => 'SEMUA');
					foreach	($daftar_rekening_beban as $rb){
						$c_hutrekprm[$rb->rekprm] = $rb->rekket;
					}
					?>
					<tr>
						<th>SARING</th>
						<td>Status: <?php echo form_dropdown('c_mtssts',$c_mtssts); ?></td>
						<td>Waktu: <?php echo form_input(['name' => 'c_mtstgl','type' => 'date']); ?></td>
						<td>RekKas: <?php echo form_dropdown('c_mtsrekprm',$c_mtsrekprm); ?></td>
						<td>RekBiaya: <?php echo form_dropdown('c_hutrekprm',$c_hutrekprm); ?></td>
						<th><?php echo form_submit('btnSubmit','CARI'); echo form_close() ?></th>
					</tr>
				</table>
				<table border="1" class="table-bordered table-striped">
					<tr>
						<th>Urut</th>
						<th>NoMutasi</th>
						<th>NoReferensi</th>
						<th>Status</th>
						<th>Waktu</th>
						<th>RekKas</th>
						<th>RekBiaya</th>
						<th>Keterangan</th>
						<th>Nominal</th>
					</tr>
					<?php foreach($daftar_kas as $p){ ?>
					<tr>
						<td><?php echo $p->mtsprm; ?></td>
						<td><?php echo $p->mtsnobuk ?></td>
						<td><?php echo $p->hutnobuk ?></td>
						<td><?php echo $p->mtssts ?></td>
						<td><?php echo $p->mtstgl ?></td>
						<td><?php echo $p->rkrekket ?></td>
						<td><?php echo $p->rbrekket ?></td>
						<td><?php echo $p->mtsket ?></td>
						<td><?php echo number_format($p->mtstotal,2,",","."); ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>