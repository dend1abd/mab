<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "Delivery Order"; 
	
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
	}

	
	/* $sqlCmd = "SELECT a.*, b.kode_sat, c.contact_name, c.alamat from trx_detail a 
	inner join mst_product b on a.product_code=b.product_code 
	left join mst_contact c on a.kode_cust = c.contact_code 
	WHERE a.transaksi_kode ='$kode'"; */
	
	
	$sqlCmd = "SELECT a.*, c.kode_sat, d.contact_name as customer, d.alamat,  e.contact_name as sales 
from trx_detail a 
inner join trx_master b on a.no_order = b.transaksi_kode 
inner join mst_product c on a.product_code=c.product_code 
left join mst_contact d on b.contact_code = d.contact_code 
left join mst_contact e on b.sales_code = e.contact_code 
WHERE a.transaksi_kode ='$kode'"; 

	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
	
	$sqlCmd = "SELECT a.product_name, c.kode_sat, sum(qty) as qty from trx_detail a inner join mst_product c on a.product_code=c.product_code 
WHERE a.transaksi_kode ='$kode' 
group by product_name, kode_sat"; 

	//eror($sqlCmd); 
    $rsSummary = $oDB->ExecuteReader($sqlCmd);
        
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 4"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd); 
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
						  <td width="30%"  nowrap>  No DO</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $transaksi_kode; ?> </td>
						</tr >
                        <tr class="font10blackNota">
						  <td width="3%" ></td>
						  <td width="30%"  nowrap> Divisi</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $divisi; ?> </td>
						</tr >                        
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">  
					<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap colspan=3>  Bandung, <?php  echo $transaksi_tgl; ?> </td>
						</tr > 
                        <tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap width='30'> Nama Supir</td>
						  <td width='3'>:</td>
						  <td align="left"> <?php  echo getComboBox(2, "txtSupir", $data["supir_code"], $rsKaryawan, ""); ?> </td>
						</tr >
                        
                        <tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap> No Polisi Mobil</td>
						  <td >:</td>
						  <td align="left"> <?php  echo $data["no_mobil"]; ?> </td>
						</tr >
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid' height="200">  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Customer</td> 
							<td style='border-bottom: #B1B1B1 1px solid' >Nama Barang</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Qty / Sat</td>	 
							<td style='border-bottom: #B1B1B1 1px solid' >Sales</td>  
							
							
						</tr> 
						
						<?php
							$i = 0;
							$sub_qty = 0;
							$sub_total = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
								$sub_qty += $datadetail["qty"]; 
									
								echo "<tr bgcolor='#ffffff' class='font12blackNota'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetail["customer"]. "-". $datadetail["alamat"];
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetail["product_name"]; 
								echo "</td>";								
								
								echo "<td align='right'>";
								echo setNumber($datadetail["qty"]) . " " . $datadetail["kode_sat"];
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetail["sales"];
								echo "</td>"; 		 
								
								echo "</tr>";
							}
						?> 
						
						<!-- summary -->
						<tr bgcolor='#ffffff' class='font12blackNota'><td colspan=5>&nbsp;</td></tr>
						<tr bgcolor='#ffffff' class='font12blackNota'><td colspan=5><b>Summary</b></td></tr>
						<tr bgcolor='#ffffff' class='font12blackNota'><td colspan=5>
							<table>
								<?php
								$i = 0;
								while ($datasummary = mysql_fetch_array($rsSummary)) 
								{
									$i++;
									$sub_qty += $datasummary["qty"]; 
										
									echo "<tr bgcolor='#ffffff' class='font12blackNota'>";
									
									echo "<td align='left'>";
									echo $datasummary["product_name"]; 
									echo "</td>";								
									
									echo "<td align='right'>";
									echo setNumber($datasummary["qty"]) . " " . $datasummary["kode_sat"];
									echo "</td>";		 
									
									echo "</tr>";
								}
							?> 
							</table>							
						</td></tr>
						<!-- end summary -->						
					</table>
				</td> 
			</tr>
			
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
                    
                        
                        <tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Ket</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $keterangan; ?> </td>
						</tr >
					</table>
				</td>
				
				<td valign="top"> <!-- kanan--> 
				</td> 
			</tr> 
			
			<tr class="font12blackNota">  
<td colspan="2" align="center">
<table width="80%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font12blackNota' align="center">  
			<td>Dibuat</td>
			<td>Mengetahui</td>  
			<td>Pengirim</td>
			<td>Penerima</td>
</tr>

<tr bgcolor='#ffffff' class='font12blackNota' height="50"> 
 
							<td>&nbsp;</td>  
							<td>&nbsp;</td>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
</tr>

</table>

</td> 
</tr> 

		</table>
	</td>
	</tr> 
	
<tr><td class="font10blackNota">Putih : Gudang&nbsp;&nbsp;&nbsp; Merah : Admin&nbsp;&nbsp;&nbsp;Kuning : Supir</td></tr>
	
<tr><td class="font10blackNota">Tgl Cetak : <?php 
	//date_default_timezone_set('Asia/Jakara');
	echo date("Y-m-d H:i:s", time()+60*60*7);
	?></td></tr>    
</table> 
</BODY>
</HTML>

