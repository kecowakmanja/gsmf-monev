<!DOCTYPE html>
<html>
<head>
	<title>[ANGGARAN-GSMF]</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="row justify-content-md-center">
		<div class="col col-lg-10">
			<div class="table">
				<h1>[ANGGARAN-GSMF]</h1>
				<table border="0">
					<tr>
						<th><?php echo anchor('c_depan/index','[AWAL]'); ?></th>
						<th><?php echo anchor('c_setuju/daftar_hutang','[LIHAT]'); ?></th>
					</tr>
				</table>
				
				<table border="1">	
					<?php 
					foreach ($daftar_hutang as $h){
						$u_hutnobuk = $h->hutnobuk;
						$u_pgnkel = $h->pgnkel;
						$u_rekket = $h->rekket;
						$u_hutket = $h->hutket;
						$u_hutrnc = $h->hutrnc;
						$u_hutprm = $h->hutprm;
					}

					echo form_open('c_setuju/tolak_hutang_ok');
					?>
								
					</tr>
					<tr>
						<th><?php echo form_label('Nomor Mutasi'); ?></th>
						<td><?php echo form_label($u_hutnobuk);?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Bidang'); ?></th>
						<td><?php echo form_label($u_pgnkel); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Rekening Beban'); ?></th>
						<td><?php echo form_label($u_rekket);
								echo form_input(['name' => 'u_hutprm', 'type' => 'hidden', 'value' => $u_hutprm]) ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Keterangan'); ?></th>
						<td><?php echo form_label($u_hutket); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Rencana Anggaran'); ?></th>
						<td><?php echo form_label(number_format($u_hutrnc)); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Alasan'); ?></th>
						<td><?php echo form_checkbox('u_accket[]','DANA TIDAK TERSEDIA',FALSE);
								echo form_label('DANA TIDAK TERSEDIA'); ?>
								<br>
							<?php echo form_checkbox('u_accket[]','KEGIATAN SUDAH PERNAH',FALSE); 
								echo form_label('KEGIATAN SUDAH PERNAH'); ?>
								<br>
							<?php
								echo form_checkbox('u_accket[]','PROGRAM TIDAK MENARIK',FALSE); 
								echo form_label('PROGRAM TIDAK MENARIK'); ?>
								<br>
							<?php echo form_checkbox('u_accket[]','BERKAS TIDAK LENGKAP',FALSE); 
								echo form_label('BERKAS TIDAK LENGKAP'); ?>
								<br>
							<?php echo form_label('LAINNYA:'); ?> <br>
							<?php echo form_textarea('u_accket[]'); ?></td>
					</tr>
					<tr>
						<th></th>
						<td><?php echo form_submit('btnSubmit', 'UBAH'); echo form_close(); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>