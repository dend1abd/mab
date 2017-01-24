<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession(); 
	if (isset($_GET["halaman"])){	
	 
		$halaman = $_GET["halaman"];		
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
		
		$tipe = $_GET["tipe"];
		$kode = $_GET["kode"];
		$divisi = $_GET["divisi"];
	}
	else{
		$posisi = 0;
		$halaman = 1;	
		
		if (isset($_GET["kode"])){
			$kode= $_GET["kode"];			
		}
		
		else{
			$kode= "";
		}
		
		$tipe = $_GET["tipe"];		
		$divisi = $_GET["divisi"];
	} 
	
	$sql2 = "
	select 
a.product_code, a.product_name, harga_beli, harga_jual, a.kode_sat
, sum(qty) as qty 

from mst_product a
left join trx_persediaan b on a.product_code = b.product_code where kode_artikel='$divisi' ";
	
	if ($kode != "")
		$sql2 = $sql2 . " and a.product_code like '$kode%' ";
		
	$sql2 = $sql2 . " group by a.product_code, a.product_name, harga_beli, harga_jual, kode_sat ";
	
	$sql = $sql2 . " limit $posisi, " . $_SESSION["param_jml_record_paging"];

	//eror($sql);
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	$rs2 = $oDB->ExecuteReader($sql2);	
	$jmlHalaman = ceil(mysql_num_rows($rs2) /$_SESSION["param_jml_record_paging"]); 
	
	//echo $sql
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);
 
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

function submit1(kode, nama, harga, satuan){
	//alert(<?php echo $tipe ?>);
	window.opener.document.getElementById("txtdetailproduct_code_0").value=kode;
	window.opener.document.getElementById("txtdetailproduct_name_0").value=nama; 
	window.opener.document.getElementById("txtdetailsatuan_0").value=satuan; 
	
	<?php 
	if ( ($tipe == 1) || ($tipe == 2) || ($tipe == 3) || ($tipe == 4) || ($tipe == 5) || ($tipe == 6) || ($tipe == 7) || ($tipe == 8) ){
	?>
		window.opener.document.getElementById("txtdetailharga_0").value=formatCurrency3(harga);
		window.opener.document.getElementById("txtdetailqty_0").value="1";
		window.opener.document.getElementById("txtdetailsub_total_0").value=formatCurrency3(harga);
		window.opener.document.getElementById("txtdetailtotal_0").value=formatCurrency3(harga); 
	<?php
	}
	else
	{
	?>
		window.opener.document.getElementById("txtdetailqty_0").value="1";
	<?php
	}
	?>
	window.close();	
} 

function frmCari(){  
	document.frmList.action = "product_lookup.php"
    document.frmList.submit();
}

function frmGoto(url){  
    self.location=url; 
}


-->
</Script> 

<body>

<form method="get" name="frmList">

<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold">Lookup Barang</td>
	</tr>  
	<tr class="font10black">
		<td>		
			<table >
            	
                <tr >
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(2, "txtDivisi", $divisi, $rsArtikel, ""); ?>
					</td>
				</tr>
                
				<tr >
					<td>Kode Barang </td>
					<td>:</td>
					<td>
					<?php  echo getTextBox(1, "kode", $kode, 20, 20, ""); ?>
					<input type="hidden" name="tipe" id="tipe" value="<?php echo $tipe;?>" />
                    <input type="hidden" name="divisi" id="divisi" value="<?php echo $divisi;?>" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>  
		<input type="button" name="btCari" value="Browse" class ="button" onClick="frmCari();" />
		<br />
		<?php 
			if ($jmlHalaman > 1)
				echo "Page :";
			for($i=1; $i<$jmlHalaman; $i++){
				if($i != $halaman){
					echo "<a href=$_SERVER[PHP_SELF]?halaman=$i&kode=$kode&tipe=$tipe>$i</a> | ";
				}
				else{
					echo "<b>$i</b> | ";
				}
			}
		?>
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">				
				<?php
				
				echo "<tr class='contentTitleTable' align='center'>";
				echo "<td>No</td>";
				echo "<td>Kode Barang</td>"; 
				echo "<td>Nama Barang</td>";
				echo "<td>Satuan</td>"; 
				echo "<td>Stok</td>";  
				echo "</tr>";
				
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="11" bgcolor="white">Data tidak ada</td> 
				</tr>
				
				<?php
				}
				else
				{
					$i = 0;
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i;
						
						if ( ($tipe == 1) || ($tipe == 2) || ($tipe == 3) || ($tipe == 4) )
							$harga = $data["harga_beli"];
						else
							$harga = $data["harga_jual"];  
						
						if ($harga == null) $harga = 0;
							
						$kode_barang = $data["product_code"]; 
						$nama_barang = $data["product_name"]; 
						$satuan = $data["kode_sat"]; 
						
							
												
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td>$i</td>";
						echo "<td>";
						echo "<a href=# onClick=\"submit1('$kode_barang', '" . str_replace("'","\'", $nama_barang) . "', '$harga', '$satuan')\">$kode_barang</a>";
						echo "</td>";
						echo "<td>$nama_barang</td>"; 
						echo "<td>$satuan</td>";                               
                        echo "<td align='right'>" . setNumber($data["qty"]). "</td>"; 
						echo "</tr>";
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