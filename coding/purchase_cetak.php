<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "Transaksi Pembelian"; 
	
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
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 2"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle;?></title>
</head>

<?php include("include/headerfile.php"); ?>

<body leftmargin="0" topmargin="0" onload="window.print();">

<table width="80%" cellpadding="0" cellspacing="1" bgcolor="#000000" align="center">
	

	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
			
			<tr class="notaCompany" bgcolor="white">
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
						  <td width="30%"  nowrap>  No Pembelian</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $transaksi_kode; ?> </td>
						</tr >
						<tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Tanggal</td>
						  <td >:</td>
						  <td > <?php  echo $transaksi_tgl; ?> </td>
						</tr >  
                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  No Invoice</td>
						  <td >:</td>
						  <td > <?php  echo $data["no_invoice"]; ?> </td>
						</tr >  
                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Tgl Invoice</td>
						  <td >:</td>
						  <td > <?php  echo $data["tgl_invoice"]; ?> </td>
						</tr >  
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">
                    	<tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Petugas</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSales", $data["sales_code"], $rsKaryawan, ""); ?> </td>
						</tr >  
                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Supplier</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSales", $data["contact_code"], $rsSupplier, ""); ?> </td>
						</tr >  
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" >  
					
						<tr class="headerTableNota" align="center" bgcolor="white">  
							<td >No</td>
							<td >Nama Barang</td> 
							<td >Harga</td>
							<td >Qty</td>
                            <td >Qty / Size</td>
							<td >Sub Total</td> 
							<td >Disc</td>
							<td >Total</td> 
							<td >Ket</td>  
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
								echo " "; 
								echo $datadetail["kode_warna"];
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["harga"]);
								echo "</td>";
								
								echo "<td align='center'>";
								echo setNumber($datadetail["qty"]);
								echo "</td>";
								
								echo "<td align='center'>";
								echo $qty_size ;
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["sub_total"]);
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["disc_amount"]);
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["total"]);
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetail["ket_detail"];
								echo "</td>";
								
								echo "</tr>";
							}
						?>
						
						<tr bgcolor="white" class='font10blackNota'>
							<td colspan="3" align="right">Jumlah</td>  
							<td align="center">
							<?php  echo setNumber($sub_qty);?>  
							</td>
							<td colspan="3" align="right"></td>
							<td align="right">
							<?php  echo setNumber($sub_total); ?>
							</td> 
							<td colspan="2" align="right">&nbsp;</td> 
						</tr>
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Discount</td>
						  <td width="1%" >:</td>
						  <td  align="right"> 
						  <?php echo setNumber($disc_amount); ?> 
						  </td>
						</tr >
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >PPN</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($ppn_amount); ?> 
						  </td>
						</tr > 
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Total</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($total); ?> </td>
						</tr >
						

					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
						
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Bayar Tunai</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($bayar); ?>
						</td>
						</tr >
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Hutang</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($sisa); ?> </td>
						</tr >
						<tr class="font10blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Keterangan</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $keterangan; ?> </td>
						</tr >
					</table>
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
</table> 
</BODY>
</HTML>

