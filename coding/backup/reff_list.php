<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	$sqlCmd = "SELECT tipe_reff, tipe_reff_desc FROM mst_tipe_reff"; 
    $rsTipeReff = $oDB->ExecuteReader($sqlCmd);
	
	if (isset($_POST["txttipeReff"])){
		$kode = trim($_POST["txttipeReff"]); 
		
		$sql = "select a.id, a.tipeReff, a.KodeReff, a.Reff, b.tipe_reff_desc from mst_reff a inner join mst_tipe_reff b on a.tipeReff = b.tipe_reff"; 
		if ($kode != "")
			$sql = $sql . " where a.tipeReff=$kode"	;
			
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs); 
	}
	else
	{
		$kode = ""; 
	} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List reff</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="reff_entry.php?op=1"; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td  class="font12Bold" >List Data Reff</td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr  class="font10black">
					<td>Tipe </td>
					<td>:</td>
					<td>
					<?php  echo getComboBox4(1, "txttipeReff", $kode, $rsTipeReff, ""); ?>
					</td>
				</tr>
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
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>tipeReff</td><td>KodeReff</td><td>Reff</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if (isset($_POST["txttipeReff"])){
					if ($numRows == 0)
					{
					?>
					<tr >
						<td colspan="5" bgcolor="white">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
								<td><?php echo $data[1] . "-" . $data["tipe_reff_desc"]; ?> </td><td><?php echo $data[2] ?> </td><td><?php echo $data[3] ?> </td>
								<td>
								<a href="reff_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
								|
								<a href="reff_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
								|
								<a href="reff_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
								</td>
							</tr>	
							<?php
						}
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

