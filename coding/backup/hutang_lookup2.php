<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession(); 
	
	$kode = $_GET["kode"];
	//eror($tipe);
	
	if($kode == ""){
		eror("Kode SUpplier Kosong");
	}
	
	$sql = "select contact_code, no_invoice, tgl_invoice, sum(jml_in) as jml_invoice, sum(jml_out) as telah_bayar, sum(jml_in) - sum(jml_out) as sisa_bayar from trx_invoice ";
	$sql = $sql . "where contact_code='$kode' ";
	$sql = $sql . "group by contact_code, no_invoice, tgl_invoice ";
	
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

function submit1(value1, value2, value3, value4, value5){

	window.opener.document.getElementById("txtDetailno_invoice0").value=value1;
	window.opener.document.getElementById("txtDetailtgl_invoice0").value=value2;
	window.opener.document.getElementById("txtDetailjml_invoice0").value= formatCurrency3(value3);
	window.opener.document.getElementById("txtDetailtelah_bayar0").value=formatCurrency3(value4);
	window.opener.document.getElementById("txtDetailjml_hutang0").value=formatCurrency3(value5); 

	window.close();
	
} 


-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr class="font12Bold">
		<td style="height: 24px">List Hutang</td>
	</tr>  
	
	<tr>
		<td>		
			<table width="75%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td >Kode Supplier</td>
					<td>No Invoice</td> 
					<td>Tgl Invoice</td>
					<td>Amount</td>
					<td>Telah Bayar</td>
					<td>Hutang</td>
				</tr>
				<?php
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="7" bgcolor="white">Data tidak ada</td> 
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
							<td>
							<?php //echo "<a href=# onClick=\"submit1('$elid1', '$elid2', '$elid3', '$data[0]', '" . str_replace("'","\'", $data[1]) . "', '$harga')\">$data[0]</a>"; ?> 
							<?php echo "<a href=# onClick=\"submit1('$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')\">$data[1]</a>"; ?> 
							</td>
							  
							 <td><?php echo $data[2] ?> </td>
							 <td align="right"><?php echo setNumber($data[3]) ?> </td>
							 <td align="right"><?php echo setNumber($data[4]) ?> </td>
							 <td align="right"><?php echo setNumber($data[5]) ?> </td>
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