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
	
	$sql = "select tipe_reff, tipe_reff_desc from mst_tipe_reff";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List tipe_reff</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="tipe_reff_entry.php?op=1"; 
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
		<td  class="font12Bold" style="height: 24px">List tipe reff</td>
	</tr>  
	<tr>
		<td>  
		<input type="button" name="btTambah" value="Tambah" class ="button" onClick="frmNew();" />
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>tipe_reff</td><td>tipe_reff_desc</td>
					<td>&nbsp;</td>
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
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $i; ?></td>
							<td><?php echo $data[0] ?> </td><td><?php echo $data[1] ?> </td>
							<td>
							<a href="tipe_reff_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
							|
							<a href="tipe_reff_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
							|
							<a href="tipe_reff_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
							</td>
						</tr>	
						<?php
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

