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
	
	$sql = "select customer_id, customer_code, customer_name from mst_customer";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Customer</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="Customer_entry.asp?op=1"; 
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
		<td>List Customer</td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr >
					<td>Kriteria</td>
					<td>:</td>
					<td><input type="text" class="thin" name="txt"></td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Cari" class ="button" onClick="frmCari();" />
		&nbsp;
		<input type="button" name="btTambah" value="Tambah" class ="button" onClick="frmNew();" />
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>Cutomer Code</td><td>Customer Name</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="4" bgcolor="white">Data tidak ada</td> 
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
							<td><?php echo $data[1] ?> </td><td><?php echo $data[2] ?> </td>
							<td>
							<a href="Customer_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
							|
							<a href="Customer_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
							|
							<a href="Customer_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
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