<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession(); 
	
	$elid1 = $_GET["elid1"];
	$elid2 = $_GET["elid2"];
	
	$sql = "select perkiraan_code, perkiraan_name, kode_divisi from mst_perkiraan";
	
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

function submit1(elid1, elid2, value1, value2){
	window.opener.document.getElementById(elid1).value=value1;
	window.opener.document.getElementById(elid2).value=value2;
	window.close();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td>List Perkiraan</td>
	</tr>  
	
	<tr>
		<td>		
			<table width="70%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>Perkiraan Code</td><td>Perkiraan Name</td> <td>Kode Divisi</td> 
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
							<?php echo "<td><a href=# onClick=\"submit1('$elid1', '$elid2', '$data[0]', '" . str_replace("'","\'", $data[1]) . "')\">$data[0]</a></td>"; ?> 
							 <td><?php echo $data[1] ?> </td> 
							 <td><?php echo $data[2] ?> </td> 
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