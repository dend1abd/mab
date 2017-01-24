<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "Transaksi Retur Penjualan"; 
	
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
		$kode_divisi = $data["kode_divisi"];
	}

	//eror($sqlCmd);
	
	$sqlCmd = "SELECT a.*, b.kode_sat from trx_detail a inner join mst_product b on a.product_code=b.product_code WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);

    $sql = "select transaksi_kode, concat(transaksi_kode, '/', transaksi_tgl, '/', ifnull(c.contact_name,'')) as no_faktur
from trx_master a
inner join mst_contact b on a.contact_code=b.contact_code
left join  mst_contact c on a.sales_code=c.contact_code
where transaksi_tipe in (6,7) and a.contact_code='$contact_code' ";
	$rsFaktur = $oDB->ExecuteReader($sql); 	
	
	
	$sqlCmd = "SELECT * FROM mst_contact where contact_code='$contact_code'"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 	
	$dataCustomer = mysql_fetch_array($rsCustomer); 	
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
						  <td width="30%"  nowrap>  No Retur Penjualan</td>
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
						  <td  nowrap>  Divisi</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtDivisi", $kode_divisi, $rsArtikel, ""); ?> </td>
						</tr >  
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">                    	
                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  Customer</td>
						  <td >:</td>
						  <td align="left"> <?php  echo $dataCustomer["contact_name"]; ?> </td>
						</tr >


                        <tr class="font10blackNota"> 
						  <td ></td>
						  <td  nowrap>  No Faktur / Tanggal / Sales</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSales", $data["no_reff"], $rsFaktur, ""); ?> </td>
						</tr >

					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid' height="200"> 
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Nama Barang</td> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Harga</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Qty</td>
                            <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Satuan</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Sub Total</td> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Disc</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Total</td> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid' >Ket</td>  
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
									
								echo "<tr bgcolor='#ffffff' class='font10blackNota'>";
								
								echo "<td align='center' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>$i";
								echo "</td>"; 
								
								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								//echo $datadetail["product_code"]; 
								//echo "-"; 
								echo $datadetail["product_name"];
								echo " "; 
								echo $datadetail["kode_warna"];
								echo "</td>";
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["harga"]);
								echo "</td>";
								
								echo "<td align='center' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["qty"]);
								echo "</td>";
								
								echo "<td align='center' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo $datadetail["kode_sat"];
								echo "</td>";
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["sub_total"]);
								echo "</td>";
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["disc_amount"]);
								echo "</td>";
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["total"]);
								echo "</td>"; 
								
								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid'>";
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
    <tr><td class="font10blackNota">Tgl Cetak : <?php 
	//date_default_timezone_set('Asia/Jakara');
	echo date("Y-m-d H:i:s", time()+60*60*7);
	?></td></tr> 
</table> 
</BODY>
</HTML>

