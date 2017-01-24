<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$kode = retrieveS($_GET["kode"]);
	$pageTitle = "PEMBAYARAN HUTANG"; 
	
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
		$bayar = $data["bayar"];
		$potongan_lain = $data["potongan_lain"];
		$biaya_lain = $data["biaya_lain"];
		$keterangan = $data["keterangan"];
	}

	
	$sqlCmd = "SELECT no_invoice, tgl_invoice, jml_invoice, telah_bayar, jml_hutang, jml_bayar, ket_bayar FROM trx_bayar a WHERE a.transaksi_kode ='$kode'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows;  
	
	$sqlCmd = "SELECT * FROM mst_contact where contact_code='$contact_code'"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 	
	$dataSupplier = mysql_fetch_array($rsSupplier); 
	
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
						  <td colspan=3>
                          Supplier : 
                          <?php  
						  echo $contact_code;  
						  echo "<br />";
						  echo $dataSupplier["contact_name"];
						  echo "<br />";
						  echo $dataSupplier["alamat"] . " " . $dataSupplier["kota"];
						  echo "<br />";
						  echo "Telp : " . $dataSupplier["telp"];
						  ?> </td>						  
						</tr >
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid' >  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
							<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid' >No Beli</td> 
							<td style='border-bottom: #B1B1B1 1px solid' >Tgl Beli</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Jumlah</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Telah Bayar</td> 
							<td style='border-bottom: #B1B1B1 1px solid' >Hutang</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Bayar</td> 
							<td style='border-bottom: #B1B1B1 1px solid' >Ket</td>
						</tr> 
						
						<?php
							$i = 0;
							$sumJmlBayar = 0;
							$sumJmlHutang = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
								echo "<tr bgcolor='#ffffff' class='font12blackNota'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetail["no_invoice"]; 
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetail["tgl_invoice"]; 
								echo "</td>";

								echo "<td align='right'>";
								echo setNumber($datadetail["jml_invoice"]); 
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["telah_bayar"]); 
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["jml_hutang"]); 
								echo "</td>";
								
								echo "<td align='right'>";
								echo setNumber($datadetail["jml_bayar"]);								 
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetail["ket_bayar"];
								echo "</td>";  
								
								echo "</tr>";
								
								$sumJmlHutang = $sumJmlHutang + $datadetail["jml_hutang"];
								$sumJmlBayar = $sumJmlBayar + $datadetail["jml_bayar"];								
							}
							
							echo "<tr bgcolor='white' class='font12blackNota'>";
							echo "<td align='right' colspan='5' style='border-top: #B1B1B1 1px solid' >Total</td>";
							echo "<td align='right' style='border-top: #B1B1B1 1px solid' >" .setNumber($sumJmlHutang). "</td>";
							echo "<td align='right' style='border-top: #B1B1B1 1px solid' >";
							echo setNumber($sumJmlBayar);
							echo "</td>";
							echo "<td style='border-top: #B1B1B1 1px solid' >";
							echo "</td>";
							echo "</tr>";
						?> 
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">  
                    <tr class="font12blackNota">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Biaya Lain-lain</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo setNumber($biaya_lain); ?> </td>
						</tr >
                        
                        <tr class="font12blackNota">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Potongan Lain-lain</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo setNumber($potongan_lain); ?> </td>
						</tr >                        
					</table>
				</td>
				
				<td valign="top"> <!-- kanan-->
					<table width="100%">  
                    	<tr class="font12blackNota">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Total Bayar</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo setNumber($bayar); ?> </td>
						</tr >
                        
                        <tr class="font12blackNota">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo $keterangan; ?> </td>
						</tr >
					</table>
				</td> 
			</tr>
            
            <tr class="font12blackNota"><td colspan="2"><u>Cara Pembayaran :</u></td></tr>
            <tr >
				<td colspan=2 valign="top" width="100%" style='border-top: #B1B1B1 1px solid; border-bottom: #B1B1B1 1px solid' >  
					<table width="100%"  cellspacing="0" cellpadding="1"  bgcolor="silver" id="tblJurnalDetail" >  					
						<tr class="headerTableNota" align="center" bgcolor="white"> 
							<td style='border-bottom: #B1B1B1 1px solid' >No</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Cara Bayar</td> 
							<td style='border-bottom: #B1B1B1 1px solid' >Perkiraan</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Jumlah Bayar</td>
							<td style='border-bottom: #B1B1B1 1px solid' >No Giro / Cek</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Tgl Transfer / Cair</td>
							<td style='border-bottom: #B1B1B1 1px solid' >Ket</td>
						</tr> 
                        <?php
							$sqlCmd = "select transaksi_kode, cara_bayar, perkiraan_code, perkiraan_name, jumlah, no_reff, tgl_reff, ket_reff, Reff as cara_bayarx  from trx_cara_bayar a left join mst_reff b on a.cara_bayar=b.KodeReff and tipeReff =13 WHERE a.transaksi_kode ='$transaksi_kode'";
							//eror($sqlCmd); 
							$rsdetailCaraBayar  = $oDB->ExecuteReader($sqlCmd);
							$i = 0;
							$sumJmlBayar = 0; 
							while ($datadetailCaraBayar = mysql_fetch_array($rsdetailCaraBayar)) 
							{
								$i++;
								echo "<tr bgcolor='#ffffff' class='font12blackNota'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetailCaraBayar["cara_bayarx"]; 
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetailCaraBayar["perkiraan_code"] . "-" . $datadetailCaraBayar["perkiraan_name"]; 
								echo "</td>";

								echo "<td align='right'>";
								echo setNumber($datadetailCaraBayar["jumlah"]); 
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetailCaraBayar["no_reff"]; 
								echo "</td>";
								
								echo "<td align='left'>";
								echo $datadetailCaraBayar["tgl_reff"]; 
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo $datadetailCaraBayar["ket_reff"];
								echo "</td>";  
								
								echo "</tr>";
								
								$sumJmlBayar = $sumJmlBayar + $datadetailCaraBayar["jumlah"]; 					
							}
							echo "<tr bgcolor='white' class='font12blackNota'>";
							echo "<td align='right' colspan='3' style='border-top: #B1B1B1 1px solid' >Total Cara Bayar</td>";
							echo "<td align='right' style='border-top: #B1B1B1 1px solid' >" .setNumber($sumJmlBayar). "</td>"; 
							echo "<td style='border-top: #B1B1B1 1px solid' colspan='3' >";
							echo "</td>";
							echo "</tr>";
	
						?>
					</table>
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

