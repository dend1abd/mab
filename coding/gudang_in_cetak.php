<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = trim($_GET["kode"]); 
	
	$sqlCmd = "SELECT transaksi_kode, transaksi_tipe, transaksi_tgl, contact_code, sales_code, sub_total, sub_qty, disc_persen, disc_amount, ppn_persen, ppn_amount, total, bayar, sisa, keterangan FROM trx_master a WHERE a.transaksi_kode ='$kode'";
    $rs = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rs);		
			
	if($numRows =0)
		eror("Data tidak ada");
	else{				
		$data	=	mysql_fetch_array($rs);	
		$_SESSION["transaksi_kode"] = $data[0];
		$_SESSION["transaksi_tipe"] = $data[1];
		$_SESSION["transaksi_tgl"] = $data[2];
		$_SESSION["contact_code"] = $data[3];
		$_SESSION["sales_code"] = $data[4];
		$_SESSION["sub_total"] = $data[5];
		$_SESSION["sub_qty"] = $data[6];
		$_SESSION["disc_persen"] = $data[7];
		$_SESSION["disc_amount"] = $data[8];
		$_SESSION["ppn_persen"] = $data[9];
		$_SESSION["ppn_amount"] = $data[10];
		$_SESSION["total"] = $data[11];
		$_SESSION["bayar"] = $data[12];
		$_SESSION["sisa"] = $data[13]; 
		$_SESSION["keterangan"] = $data[14]; 

	 	FormLoad();
	 	ClearSession();
	}

function FormLoad()
{	
	
	global $oDB;  
	global $clsformatInteger;
	global $ajaxgetproduct_name; 
	global $kode;  
	
	$sqlCmd = "SELECT transaksi_kode, product_code, product_name, satuan, qty, harga_beli, harga_jual, sub_total, disc_persen, disc_amount, total, ket_detail from trx_detail a WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
    
    $sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 5"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
    
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 4"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd); 

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Cetak Pembelian</title>
</head>

<?php include("include/headerfile.php"); ?>


<body leftmargin="0" topmargin="0" onload="window.print();">

<table width="80%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	

	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
			
			<tr class="invoiceTitle" bgcolor="white">
<td colspan="2">
<?php
	echo $_SESSION["param_company_name"];
?> 
</td>
</tr>
<tr class="invoiceTitle2">
<td colspan="2">Nota Gudang - Terima Barang</td> 
</tr>

		
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%"> 
						<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px" nowrap>  Kode Transaksi</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox(2, "txttransaksi_kode", $_SESSION["transaksi_kode"], 20, 20, " readonly"); ?> </td>
						</tr >
						<tr class="font10black"> 
						  <td style="height: 23px"></td>
						  <td style="height: 23px" nowrap>  Tgl Transaksi</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getDatePic(2, "txttransaksi_tgl", $_SESSION["transaksi_tgl"], ""); ?> </td>
						</tr >  
					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Gudang</td>
						  <td width="1%">:</td> 
						  <td> <?php  echo getComboBox(2, "txtcontact_code", $_SESSION["contact_code"], $rsSupplier, ""); ?> </td>
						  
						</tr >
						<tr class="font10black">
						  <td style="width: 3%; height: 23px;"></td>
						  <td style="height: 23px">  Petugas</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> 
						   <?php  echo getComboBox(2, "txtsales_code", $_SESSION["sales_code"], $rsKaryawan, ""); ?>  
						  </td>
						</tr > 


					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" >  
					
						<tr class="contentTitleTable" align="center"> 
							<td style="height: 22px">No</td>
							<td style="height: 22px">Produk / Barang</td> 
							<td style="height: 22px">Banyak</td>
							<td style="height: 22px">Ket</td>  
						</tr> 
						
						<?php
							$i = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
								echo "<tr bgcolor='#ffffff' class='font10black'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo getTextBox(2, "txtDetailproduct_code$i", $datadetail["product_code"], 50, 10, " readonly"); 
								echo "-"; 
								echo getTextBox(2, "txtDetailproduct_name$i", $datadetail["product_name"], 255, 25, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox(2, "txtDetailqty$i", setNumber($datadetail["qty"]), 20, 5, $clsformatInteger . " readonly");
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo getTextBox(2, "txtDetailket_detail$i", $datadetail["ket_detail"], 50, 20, " readonly");
								echo "</td>";
								
								echo "</tr>";
							}
						?>
						
						<tr bgcolor="white" class='font10black'>
							<td colspan="2" align="right">Jumlah</td>  
							<td align="center">
							<?php  echo getTextBox(2, "txtsub_qty", setNumber($_SESSION["sub_qty"]), 20, 5, $clsformatInteger); ?>  
							</td>
							<td colspan="2" align="right"></td>
						</tr>
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" align="left"> 
						  <?php  echo getTextBox(2, "txtketerangan", $_SESSION["keterangan"], 255, 40, ""); ?> 
						  </td>
						</tr >

					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
						
						
					</table>
				</td> 
			</tr> 
			
			<tr class="font10black">  
<td colspan="2" align="center">
<table width="80%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font10black' align="center">  
			<td>Menyetujui</td>
			<td>Mengetahui</td>  
			<td>Penerima</td>
			<td>Dibuat Oleh</td> 
</tr>

<tr bgcolor='#ffffff' class='font10black' height="50"> 
 
							<td>&nbsp;</td>  
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td> 
</tr>

</table>

</td> 
</tr>

           
           <tr height="10">
				<td colspan=2 align='center'>
				</td>				
			</tr>

		</table>
	</td>
	</tr> 
</table> 
</BODY>
</HTML>

<?php
}

function ClearSession()
{
//$_SESSION["op"] = ""
$_SESSION["btnLabel"] = "";
$_SESSION["lblTitle"] = "";
$_SESSION["errAlert"] 	= false;
$_SESSION["errMsg"] 	= "";
$_SESSION["ID"] = "";
$_SESSION["transaksi_kode"] = "";
$_SESSION["transaksi_tipe"] = "";
$_SESSION["transaksi_tgl"] = "";
$_SESSION["contact_code"] = "";
$_SESSION["sales_code"] = "";
$_SESSION["sub_total"] = "";
$_SESSION["sub_qty"] = "";
$_SESSION["disc_persen"] = "";
$_SESSION["disc_amount"] = "";
$_SESSION["ppn_persen"] = "";
$_SESSION["ppn_amount"] = "";
$_SESSION["total"] = "";
$_SESSION["bayar"] = "";
$_SESSION["sisa"] = ""; 
$_SESSION["keterangan"] = ""; 
}
?>

