<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]);
		
		$sql = "select id, kode, ket, int_value, des_value, string_value, date1_value, date2_value from mst_config where kode='$kode' or ket like '%$kode%' "; 
		$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);  
		
	}
	else
	{
		$kode = ""; 
	}
	//echo $sql;
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List config</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="config_entry.php?op=1"; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr  class="font12Bold" >
		<td>List config</td>
	</tr> 
	<tr class="font10black">
		<td>		
			<table >
				<tr >
					<td>Kode / Ket </td>
					<td>:</td>
					<td>
 						<?php  echo getTextBox(1, "txtKode", $kode, 50, 20, ""); ?>
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
					<td>kode</td><td>ket</td><td>integer value</td><td>desimal value</td><td>string value</td><td>date1 value</td><td>date2 value</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if (isset($_POST["txtKode"])){ 
					if ($numRows == 0)
					{
					?>
					<tr >
						<td colspan="9" bgcolor="white">Data tidak ada</td> 
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
								<td><?php echo $data[1] ?> </td><td><?php echo $data[2] ?> </td><td><?php echo $data[3] ?> </td><td><?php echo $data[4] ?> </td><td><?php echo $data[5] ?> </td><td><?php echo $data[6] ?> </td><td><?php echo $data[7] ?> </td>
								<td>
								<a href="config_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
								|
								<a href="config_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
								|
								<a href="config_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
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

