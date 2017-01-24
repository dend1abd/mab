<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "BUKTI PENERIMAAN GUDANG BAHAN"; 
	
	$sqlCmd = "SELECT * FROM trx_master a WHERE a.transaksi_kode ='$kode'";
    $rs = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rs);		
			
	if($numRows =0)
		eror("Data tidak ada");
	else{				
		$data	=	mysql_fetch_array($rs);	
		$transaksi_kode = $data["transaksi_kode"];
		$transaksi_tgl = $data["transaksi_tgl"];
		$contact_code = $data["contact_code"];
		$sub_total = $data["sub_total"];
		$sub_qty = $data["sub_qty"];
		$disc_amount = $data["disc_amount"];
		$disc_amount2 = $data["disc_amount2"];
		$disc_amount3 = $data["disc_amount3"];
		$ppn_amount = $data["ppn_amount"];
		$total = $data["total"];
		$bayar = $data["bayar"];
		$sisa = $data["sisa"];
		$keterangan = $data["keterangan"];
	}

	
	$sqlCmd = "SELECT * from trx_detail a WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
        
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 4"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd); 
	
	//$sqlCmd = "SELECT * FROM mst_contact where contact_code='$contact_code'"; 
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_code='$contact_code'"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);   	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle;?></title>
</head>

<?php include("include/headerfile.php"); ?>

<body leftmargin="0" topmargin="0" onload="window.print();">

<table width="100%" cellpadding="1" cellspacing="1" align="center">
	

	<tr>
	<td >
		
		<table width="100%">
			
			<tr class="invoiceTitle" bgcolor="white">
<td colspan="2">
<?php
	echo $_SESSION["param_company_name"];
?> 
</td>
</tr>
<tr class="notaTitle">
<td colspan="2">
<?php
	echo $pageTitle;
?>
</td> 
</tr>

		
			<tr>
				<td width=50% valign="top"> <!-- kiri-->
					<table width="100%"> 
						<tr class="font10blackNota">
						  <td width="3%" ></td>
						  <td width="30%"  nowrap>  No Transaksi</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $transaksi_kode; ?> </td>
						</tr > 
						<tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Tanggal</td>
						  <td >:</td>
						  <td > <?php  echo $transaksi_tgl; ?> </td>
						</tr >  
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">
                    	<tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>Petugas Gudang</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSales", $data["petugas_kode"], $rsKaryawan, ""); ?> </td>
						</tr >  
                        
                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>Customer</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtcontact_code", $data["contact_code"], $rsCustomer, ""); ?> </td>
						</tr >  
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid'>  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Nama Barang</td>  
							<td style='border-bottom: #B1B1B1 1px solid' >Qty</td>
                            <td style='border-bottom: #B1B1B1 1px solid' >Qty / Size</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Ket</td>  
						</tr> 
						
						<?php
							$i = 0;
							$sub_qty = 0;
							$sub_total = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
								$sub_qty += $datadetail["qty"];
								$sub_total += $datadetail["total"];
								
								$qty_size = "";
								
								if ($datadetail["qty_size1"] != "" && $datadetail["qty_size1"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size1"] . "/" .$datadetail["qty_size1"] . " ";
									
								if ($datadetail["qty_size2"] != "" && $datadetail["qty_size2"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size2"] . "/" .$datadetail["qty_size2"] . " ";
								
								if ($datadetail["qty_size3"] != "" && $datadetail["qty_size3"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size3"] . "/" .$datadetail["qty_size3"] . " ";
									
								if ($datadetail["qty_size4"] != "" && $datadetail["qty_size4"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size4"] . "/" .$datadetail["qty_size4"] . " ";
									
								if ($datadetail["qty_size5"] != "" && $datadetail["qty_size5"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size5"] . "/" .$datadetail["qty_size5"] . " ";
									
								if ($datadetail["qty_size6"] != "" && $datadetail["qty_size6"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size6"] . "/" .$datadetail["qty_size6"] . " ";
									
								if ($datadetail["qty_size7"] != "" && $datadetail["qty_size7"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size7"] . "/" .$datadetail["qty_size7"] . " ";
									
								
								if ($datadetail["qty_size8"] != "" && $datadetail["qty_size8"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size8"] . "/" .$datadetail["qty_size8"] . " ";							
									
								if ($datadetail["qty_size9"] != "" && $datadetail["qty_size9"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size9"] . "/" .$datadetail["qty_size9"] . " ";
								
								if ($datadetail["qty_size10"] != "" && $datadetail["qty_size10"] != "0")
									$qty_size = $qty_size . $datadetail["kode_size10"] . "/" .$datadetail["qty_size10"] . " ";
									
								echo "<tr bgcolor='#ffffff' class='font10blackNota'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetail["product_code"]; 
								echo "-"; 
								echo $datadetail["product_name"];
								echo "</td>"; 
								
								echo "<td align='center'>";
								echo setNumber($datadetail["qty"]);
								echo "</td>";
								
								echo "<td align='center'>";
								echo $qty_size ;
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetail["ket_detail"];
								echo "</td>";
								
								echo "</tr>";
							}
						?>
						
						<tr bgcolor="white" class='font10blackNota'>
							<td colspan="2" align="right">Jumlah</td>  
							<td align="center">
							<?php  echo setNumber($sub_qty);?>  
							</td>
							<td colspan="2" align="right"></td>
						</tr>
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td colspan=2  class="font10blackNota"> <!-- kiri-->
                Keterangan : <?php echo $keterangan; ?> 
                </td>
			</tr> 
            <tr>
				<td colspan=2  class="font10blackNota">&nbsp;
                 </td>
			</tr> 
			
			<tr class="font10blackNota">  
<td colspan="2" align="center">
<table width="80%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font10blackNota' align="center">  
			<td>Menyetujui</td>
			<td>Mengetahui</td>  
			<td>Penerima</td>
			<td>Dibuat Oleh</td> 
</tr>

<tr bgcolor='#ffffff' class='font10blackNota' height="50"> 
 
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
    <tr><td class="font10blackNota">Tgl Cetak : <?php 
	//date_default_timezone_set('Asia/Jakara');
	echo date("Y-m-d H:i:s", time()+60*60*7);
	?></td></tr> 
</table> 
</BODY>
</HTML>

