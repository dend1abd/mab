<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	$sqlCmd = "SELECT KodeReff, Reff FROM mst_reff where tipeReff =2 and KodeReff<>1";  
    $rsContactType= $oDB->ExecuteReader($sqlCmd);
	
	if (isset($_POST["txtcontact_tipe"])){		
		$contact_tipe= trim($_POST["txtcontact_tipe"]);
		$kode = trim($_POST["txtKode"]);
		
		$sql = "select contact_code, contact_name, contact_tipe, b.Reff  from mst_contact a inner join mst_reff b on a.contact_tipe = b.KodeReff and tipeReff =2 where contact_tipe=$contact_tipe";	 
		if ($kode != "") 
			$sql = $sql . " and contact_code='$kode' or contact_name like '%$kode%'";
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs); 
		
	}
	else
	{
		$kode = ""; 
		$contact_tipe="";
	}
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List contact</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="contact_entry.php?op=1"; 
}

function frmCari(){  
	if (document.frmList.txtcontact_tipe.value== ""){
		alert("Silahkan pilih jenis contact");
		document.frmList.txtcontact_tipe.focus();
		return false;
	}
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr class="font12Bold">
		<td>Contact Report</td>
	</tr> 
	<tr class="font10black">
		<td>		
			<table >
			<tr >
					<td>Jenis Contacts</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtcontact_tipe", $contact_tipe, $rsContactType, ""); ?> 
					</td>
				</tr>
				
				<tr >
					<td>Kode / Nama</td>
					<td>:</td>
					<td>
					<?php  echo getTextBox(1, "txtKode", $kode, 20, 20, ""); ?>					</td>
				</tr> 
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmCari()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp; 
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp;

		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>Contact Code</td><td>Contact Name</td>
				</tr>
				<?php
				if (isset($_POST["txtcontact_tipe"])){
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
								<td><?php echo $data[0] ?> </td>
								<td><?php echo $data[1] ?> </td>
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