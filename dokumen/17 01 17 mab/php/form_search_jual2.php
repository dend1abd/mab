<tr>
		<td>		
			<table >
				<tr class='font10black'>
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePicMand(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePicMand(1, "txtTgl2", $tgl2, ""); ?>
					</td>
				</tr>
                <tr class='font10black'>
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtDivisi", $divisi, $rsArtikel, ""); ?>
					</td>
				</tr>
                <tr class='font10black'>
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getAutoComplete(1, "txtCustomer", $customer, 50, $rsCustomer, ""); ?>
					</td>
				</tr>
				<!-- 
				<tr class='font10black'>
					<td>Status Faktur</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtStFaktur", $stfaktur, $rsStatusFaktur, ""); ?>
					</td>
				</tr> -->
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onClick="frmCari();" />
		&nbsp;
		<input type="button" name="btTambah" value="Tambah" class ="button" onClick="frmNew();" />
		</td>
	</tr>