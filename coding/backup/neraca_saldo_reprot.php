<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]);
	}
	else
	{
		$kode = ""; 
	}
	
	$sql = "select * from mst_customer" ;
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);  
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Customer List</title>
</head>

<?php include("include/headerfile.php"); ?>

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold"> Laporan Jurnal Transaksi</td>
	</tr> 
	<tr>
		<td style="height: 53px">		
			<table >
				<tr class="font10black">
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePic(1, "txtTgl1", "", ""); ?>
					 s/d 
					<?php  echo getDatePic(1, "txtTgl2", "", ""); ?>

					</td>
				</tr>
				<tr class="font10black"> 
					<td>Tipe Jurnal</td>
					<td>:</td>
					<td></td>
				</tr>

			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button"/>&nbsp; 
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp;  
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>Tanggal</td>  
					<td>Perkiraan</td>
					<td>No Dok</td>  
					<td>Debet</td>
					<td>Kredit</td>
					<td>Ket</td> 
				</tr>
				<?php
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="3" bgcolor="white">Data tidak ada</td> 
				</tr>
				
				<?php
				}
				else
				{
					$i = 0;
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
					}
				}
				?>
			</table>
		</td>
	</tr>	
</table>

</form>

</body>

</html>
