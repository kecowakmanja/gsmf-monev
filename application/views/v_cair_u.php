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
						<th><?php echo anchor('c_cair/daftar_hutang','[LIHAT]'); ?></th>
					</tr>
				</table>
				
				<table border="1">	
					<?php 
					$u_nol = "0";
					$rekprm = array();
					foreach	($daftar_rekening_kas as $rk){
						$rekprm[$rk->rekprm] = $rk->rekket;
					}
					
					foreach ($daftar_hutang as $h){
						$u_hutnobuk = $h->hutnobuk;
						$u_pgnkel = $h->pgnkel;
						$u_rekket = $h->rekket;
						$u_hutket = $h->hutket;
						$u_hutrnc = $h->hutrnc;
						$u_huttotal = $h->huttotal;
						$u_hutprm = $h->hutprm;
					}

					echo form_open('c_cair/cair_hutang_ok');
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
						<td><?php echo form_label(number_format($u_hutrnc,2,",",".")); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Sudah Cair'); ?></th>
						<td><?php echo form_label(number_format($u_huttotal,2,",","."));
						          echo form_input(['name' => 'u_huttotal', 'type' => 'hidden', 'value' => $u_huttotal]) ?></td>
						</td>
					</tr>
					<tr>
						<th><?php echo form_label('Rekening Pencairan'); ?></th>
						<td><?php echo form_dropdown('u_mtsrekprm',$rekprm); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Pencairan'); ?></th>
						<td><?php echo form_input(['name' => 'u_mtstotal','type' => 'number','value' => $u_nol]); ?></td>
					</tr>
					<tr>
						<th><?php echo form_label('Referensi'); ?></th>
						<td><?php echo form_textarea('u_mtsket'); ?></td>
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