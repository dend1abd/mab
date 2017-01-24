<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "FAKTUR PENJUALAN"; 
	
	$sql = "update trx_master set stfaktur=1 where transaksi_kode='$kode'";
	$oDB->ExecuteNonQuery($sql);
	
	$sqlCmd = "SELECT a.*, b.reff as divisi FROM trx_master a left join mst_reff b on a.kode_divisi=b.kodereff and tipereff=23 WHERE a.transaksi_kode ='$kode'";
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
		$divisi = $data["divisi"];
		$no_order= $data["no_reff"];
		$kode_wilayah= $data["kode_wilayah"];
	}

	
	$sqlCmd = "SELECT a.*, b.kode_sat from trx_detail a inner join mst_product b on a.product_code=b.product_code WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
        
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 4"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=27";
	$rsWilayah = $oDB->ExecuteReader($sqlCmd); 
	
	
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
        

<tr class="notaTitle">
<td colspan="2"><b>
<?php
	echo $pageTitle;
?></b>
</td> 
</tr>
<!--			
			<tr class="invoiceTitle" bgcolor="white">
<td colspan="2">
<?php
	echo $_SESSION["param_company_name"];
?> 
</td>
</tr>
-->

		
			<tr>
				<td width=50% valign="top"> <!-- kiri-->
					<table width="100%"> 
                    	<tr class="notaTitle"> 
						  <td ></td>
						  <td  colspan=3>  <?php echo $_SESSION["param_company_name"];?></td>
						</tr >  
						<tr class="font12blackNota">
						  <td width="3%" ></td>
						  <td width="30%"  nowrap>  No.</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $transaksi_kode; ?> </td>
						</tr >
						<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>  Sales</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSales", $data["sales_code"], $rsKaryawan, ""); ?> </td>
						</tr >
<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>  Wilayah</td>
						  <td >:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtWilayah", $data["kode_wilayah"], $rsWilayah, ""); ?> </td>
						</tr >						
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%"> 
                        <tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap colspan=3>  Bandung, <?php  echo setDateIndo($transaksi_tgl); ?> </td>
						</tr >
                        <tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap width=35> Kpd.Yth.</td>
						  <td width=3>:</td>
						  <td > <?php  echo $dataCustomer["contact_name"]; ?> </td>
						</tr >  
                        
						<tr class="font12blackNota">
                        <td ></td>
						  <td colspan=3>
                          <?php
						  echo $dataCustomer["alamat"];
						  echo "<br />";
						  echo "Telp : " . $dataCustomer["telp"];
						  ?></td>						  
						</tr >
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid' height="200">  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Nama Barang</td>                             
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Banyaknya</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Satuan</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Harga</td>
                            <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' colspan=2>Discount</td>
                            <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Jumlah(rp)</td>
                            <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid'' >Keterangan</td>							 
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
								
								echo "<tr bgcolor='#ffffff' class='font12blackNota' >";
								
								echo "<td align='center' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >$i";
								echo "</td>"; 
								
								echo "<td align='left' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' nowrap>";
								echo $datadetail["product_name"];
								echo "</td>";
								
								echo "<td align='center' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo setNumber($datadetail["qty"]);
								echo "</td>";

								echo "<td align='left' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo $datadetail["kode_sat"];
								echo "</td>";																
								
								echo "<td align='right' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo setNumber($datadetail["harga"]);
								echo "</td>";												
													

								echo "<td align='right' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo $datadetail["disc_persen"] . "%" ;
								echo "</td>";
								
								echo "<td align='right' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo setNumber($datadetail["disc_amount"]);
								echo "</td>";																
															
								echo "<td align='right' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >";
								echo setNumber($datadetail["total"]);
								echo "</td>";
								
								echo "<td align='left' valign='top' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid' >";
								echo $datadetail["ket_detail"];
								echo "</td>";
								
								echo "</tr>";
							}
						?> 
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50% style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid;'> <!-- kiri-->
					<table width="100%">   
						<tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Sub Total</td>
						  <td width="1%" >:</td>
						  <td  align="right"> 
						  <?php  echo setNumber($sub_total); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						  </td>
						</tr >
                        <tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Discount</td>
						  <td width="1%" >:</td>
						  <td  align="right"> 
						  <?php 
						  echo $data["disc_persen"] . 	"% = ";
						  echo setNumber($disc_amount); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						  </td>
						</tr >
                        <tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >PPN</td>
						  <td width="1%" >:</td>
						  <td  align="right"> 
						  <?php 
						  echo $data["ppn_persen"] . 	"% = ";
						  echo setNumber($ppn_amount); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						  </td>
						</tr >
                        <tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Ket</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $keterangan; ?> </td>
						</tr >
					</table>
				</td>
				
				<td valign="top" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid;'> <!-- kanan-->
					<table width="100%"> 
						<tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Biaya Kirim</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($data["biaya_kirim"]); ?>
                          </td>
						</tr >
                        <tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Jml Net</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($total); ?>
                          </td>
						</tr >
                        
						<tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Bayar</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($bayar); ?>
						</td>
						</tr >
						<tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Sisa</td>
						  <td width="1%" >:</td>
						  <td  align="right"> <?php  echo setNumber($sisa); ?>
                           </td>
						</tr >
					</table>
				</td> 
			</tr> 
			<tr class="font12blackNota">  
			<td colspan="2" align="left" >
			TERBILANG : <?php  echo strtoupper(terbilang($sisa)); ?> RUPIAH
			</td> 
			</tr> 

			<tr class="font12blackNota">  
<td colspan="2" align="left" >
<table width="90%"  cellspacing="0" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font12blackNota' align="center">  
			<td style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid;' align='center' rowspan=2  width=150 >Pembayaran Transfer ke :<br />BCA 3461630098<br />a/n Ir. Salim</td>
			<td width=100>Penerima</td>
			<td width=100>Mengetahui</td>  
			<td width=100>Hormat Kami</td>
</tr>

<tr bgcolor='#ffffff' class='font12blackNota' height="50"> 
 
							<td >&nbsp;</td>  
							<td >&nbsp;</td>
							<td >&nbsp;</td> 
</tr>

</table>

</td> 
</tr> 

		</table>
	</td>
	</tr> 
<!--	<tr><td class="font10blackNota">Merah : Admin&nbsp;&nbsp;&nbsp;Kuning : Supir</td></tr> -->
	
<tr><td class="font10blackNota">Tgl Cetak : <?php 
	//date_default_timezone_set('Asia/Jakara');
	echo date("Y-m-d H:i:s", time()+60*60*7);
	?></td></tr>    
</table> 
</BODY>
</HTML>

