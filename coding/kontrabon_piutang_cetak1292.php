<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "TAGIHAN PIUTANG"; 
	
	$sqlCmd = "SELECT * FROM trx_master a WHERE a.transaksi_kode ='$kode'";
    $rs = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rs);		
			
	if($numRows =0)
		eror("Data tidak ada");
	else{				
		$data	=	mysql_fetch_array($rs);	
		$transaksi_kode = $data["transaksi_kode"];
		$transaksi_tgl = $data["transaksi_tgl"];
		$supir_code = $data["supir_code"];
		$no_mobil = $data["no_mobil"];
		$total = $data["total"];
		$keterangan = $data["keterangan"];
		$kode_divisi = $data["kode_divisi"];
	}

	
	$sqlCmd = "SELECT a.*, b.alamat from trx_kontrabon a left join mst_contact b on a.kode_customer=b.contact_code WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
        
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 4"; 
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
						  <td width="30%"  nowrap>  No Tagihan.</td>
						  <td width="1%" >:</td>
						  <td  > <?php  echo $transaksi_kode; ?> </td>
						</tr >  
						<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>  Tanggal</td>
						  <td >:</td>
						  <td > <?php  echo $transaksi_tgl; ?> </td>
						</tr >
                        
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">

                    	<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>  Kode Divisi</td>
						  <td >:</td>
						  <td > <?php  echo $kode_divisi; ?> </td>
						</tr >  

						<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>Sales/Supir</td>
						  <td >:</td>
						  <td > <?php  echo getComboBox(2, "txtsupir_code", $supir_code, $rsKaryawan, "");  ?> </td>
						</tr >  

						<tr class="font12blackNota"> 
						  <td ></td>
						  <td  nowrap>  No Mobil</td>
						  <td >:</td>
						  <td > <?php  echo $no_mobil; ?> </td>
						</tr >  
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
			    <td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' height="200">  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >No Faktur</td> 
                                                        <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Tgl Faktur</td>
                                                        <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Customer</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Jumlah(Rp)</td>							
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Retur</td>
                                                        <td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Byr</td>
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid' >Piutang</td> 
							<td style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid' >K   e   t   e   r   a   n   g   a   n</td>
						</tr> 
						
						<?php
							$i = 0;
							$sub_qty = 0;
							$sub_total = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++; 
									
								echo "<tr bgcolor='#ffffff' class='font12blackNota'>";
								
								echo "<td align='center' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>$i";
								echo "</td>"; 
								
								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo $datadetail["no_invoice"]; 
								echo "</td>";
								
								echo "<td align='center' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo $datadetail["tgl_invoice"];
								echo "</td>";		

								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo $datadetail["nama_customer"] . ", " . $datadetail["alamat"];
								echo "</td>";						
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["jml_invoice"]);
								echo "</td>";
								
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["jml_retur"]);
								echo "</td>";

								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["telah_bayar"]);
								echo "</td>";								
															
								echo "<td align='right' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo setNumber($datadetail["jml_hutang"]);
								echo "</td>";
								
								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								echo $datadetail["nama_sales"];
								echo "</td>";						
								
								//echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid'>";
								//echo $datadetail["kode_wilayah"];
								//echo "</td>";						
								
								echo "<td align='left' style='border-bottom: #B1B1B1 1px solid; border-left: #B1B1B1 1px solid; border-right: #B1B1B1 1px solid'>";
								echo "&nbsp;";
								echo "</td>";						
								
								echo "</tr>";
								
								$sub_total = $sub_total + $datadetail["jml_hutang"];
							}
						?> 
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
						<tr class="font12blackNota"> 
						  <td width="3%" ></td>
						  <td width="30%" >Total</td>
						  <td width="1%" >:</td>
						  <td  > 
						  <?php  echo setNumber($sub_total); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
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
				
				<td valign="top"> <!-- kanan-->
					
				</td> 
			</tr> 
			
			<tr class="font12blackNota">  
<td colspan="2" align="center">
<table width="80%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font12blackNota' align="center">  
			<td>Dibuat</td>
			<td>Mengetahui</td>  
			<td>Penerima</td>
</tr>

<tr bgcolor='#ffffff' class='font12blackNota' height="50"> 
 
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
<tr><td class="font10blackNota">Tgl Cetak : <?php 
	//date_default_timezone_set('Asia/Jakara');
	echo date("Y-m-d H:i:s", time()+60*60*7);
	?></td></tr>    
</table> 
</BODY>
</HTML>

