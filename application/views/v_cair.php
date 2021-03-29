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
						<th><?php echo anchor('c_cair/daftar_hutang','[LIHAT]'); ?></th>
					</tr>
				</table>
				<table border="0">
					<?php 
					echo form_open('c_cair/daftar_hutang_saring'); 
					$c_hutsts = [
						'' => 'SEMUA',
						'SETUJU' => 'SETUJU',
						'CAIR' => 'CAIR'
					];
					$c_hutrekprm = array('' => 'SEMUA');
					foreach	($daftar_rekening_beban as $rb){
						$c_hutrekprm[$rb->rekprm] = $rb->rekket;
					}
					?>
					<tr>
						<th>SARING</th>
						<td>Status: <?php echo form_dropdown('c_hutsts',$c_hutsts); ?></td>
						<td>Waktu: <?php echo form_input(['name' => 'c_huttglrnc','type' => 'date']); ?></td>
						<td>Rekening: <?php echo form_dropdown('c_hutrekprm',$c_hutrekprm); ?></td>
						<th><?php echo form_submit('btnSubmit','CARI'); echo form_close() ?></th>
					</tr>
				</table>		
				<table border="1" class="table-bordered table-striped">
					<tr>
						<th>Urut</th>
						<th>NoMutasi</th>
						<th>Status</th>
						<th>Waktu</th>
						<th>Bidang</th>
						<th>Rekening</th>
						<th>Keterangan</th>
						<th>Rencana</th>
						<th>Cair</th>
						<th>OPERATOR</th>
					</tr>
					<?php foreach($daftar_hutang as $p){ ?>
					<tr>
						<td><?php echo $p->hutprm ?></td>
						<td><?php echo $p->hutnobuk ?></td>
						<td><?php echo $p->hutsts ?></td>
						<td><?php echo $p->huttglrnc ?></td>
						<td><?php echo $p->pgnkel ?></td>
						<td><?php echo $p->rekket ?></td>
						<td><?php echo $p->hutket ?></td>
						<td><?php echo number_format($p->hutrnc,2,",","."); ?></td>
						<td><?php echo number_format($p->huttotal,2,",","."); ?></td>
						<td><?php echo anchor('c_cair/cair_hutang/'.$p->hutprm,'[CAIR]'); ?></td>
					</tr>
					<?php } ?>
				</table>
</body>
</html>