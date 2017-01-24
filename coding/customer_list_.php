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
	
	echo $sql
 
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
		<td> List Barang </td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr >
					<td>Kelompok Barang</td>
					<td>:</td>
					<td><input type="text" class="thin"></td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Cari" class ="button"/>
		&nbsp;
		<input type="button" name="btCari" value="Tambah" class ="button"/>
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>Kode</td>  
					<td>Nama</td>
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
