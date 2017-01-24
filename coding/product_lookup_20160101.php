<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession(); 
	if (isset($_GET["halaman"])){	
	 
		$halaman = $_GET["halaman"];		
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
		
		$tipe = $_GET["tipe"];
		$kode = $_GET["kode"];
	}
	else{
		$posisi = 0;
		$halaman = 1;	
		
		if (isset($_GET["kode"]))
			$kode= $_GET["kode"];
		else
			$kode= "";
		$tipe = $_GET["tipe"];
		
	}
	
	$showHargaBeli = false;
	$showHargaJual = false;
	
	if ( ($_SESSION["transaksi_tipe"] == "1") || ($_SESSION["transaksi_tipe"] == "2") || ($_SESSION["transaksi_tipe"] == "3")|| ($_SESSION["transaksi_tipe"] == "4 "))
		$showHargaBeli = true;
	if ( ($_SESSION["transaksi_tipe"] == "5") || ($_SESSION["transaksi_tipe"] == "6") || ($_SESSION["transaksi_tipe"] == "7")|| ($_SESSION["transaksi_tipe"] == "8 "))
		$showHargaJual = true;
	
	$sql2 = "
	select 
a.product_code, a.product_name, harga_beli, harga_jual, size1, size2, size3, size4, size5, size6, size7, size8, size9, size10
, sum(qty) as qty
, ifnull(sum(ifnull(qtysize1,0)), 0) as qty1 
, ifnull(sum(ifnull(qtysize2,0)), 0) as qty2
, ifnull(sum(ifnull(qtysize3,0)), 0) as qty3
, ifnull(sum(ifnull(qtysize4,0)), 0) as qty4
, ifnull(sum(ifnull(qtysize5,0)), 0) as qty5
, ifnull(sum(ifnull(qtysize6,0)), 0) as qty6
, ifnull(sum(ifnull(qtysize7,0)), 0) as qty7
, ifnull(sum(ifnull(qtysize8,0)), 0) as qty8
, ifnull(sum(ifnull(qtysize9,0)), 0) as qty9
, ifnull(sum(ifnull(qtysize10,0)), 0) as qty10

from mst_product a
left join trx_persediaan b on a.product_code = b.product_code ";
	
	if ($kode != "")
		$sql2 = $sql2 . " where a.product_code like '$kode%' ";
		
	$sql2 = $sql2 . " group by a.product_code, a.product_name, harga_beli, harga_jual, size1, size2, size3, size4, size5, size6, size7, size8, size9, size10 ";
	
	$sql = $sql2 . " limit $posisi, " . $_SESSION["param_jml_record_paging"];

	//eror($sql);
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	$rs2 = $oDB->ExecuteReader($sql2);	
	$jmlHalaman = ceil(mysql_num_rows($rs2) /$_SESSION["param_jml_record_paging"]); 
	
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

function submit1(kode, nama, harga, size1, size2, size3, size4, size5, size6, size7, size8){
	window.opener.document.getElementById("txtdetailproduct_code_0").value=kode;
	window.opener.document.getElementById("txtdetailproduct_name_0").value=nama;
	
	/*window.opener.document.getElementById("txtdetailsize1_0").value=size1;
	window.opener.document.getElementById("txtdetailsize2_0").value=size2;
	window.opener.document.getElementById("txtdetailsize3_0").value=size3;
	window.opener.document.getElementById("txtdetailsize4_0").value=size4;
	window.opener.document.getElementById("txtdetailsize5_0").value=size5;
	window.opener.document.getElementById("txtdetailsize6_0").value=size6;
	window.opener.document.getElementById("txtdetailsize7_0").value=size7;
	window.opener.document.getElementById("txtdetailsize8_0").value=size8; */
	
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
					<td>Kode Barang </td>
					<td>:</td>
					<td>
					<?php  echo getTextBox(1, "kode", $kode, 20, 20, ""); ?>
					<input type="hidden" name="tipe" id="tipe" value="<?php echo $tipe;?>" />
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
                    if ($showHargaBeli) echo "<td>Harga Beli</td>"; 
                    if ($showHargaJual) echo "<td>Harga Jual</td>"; 
                    echo "<td>Stok</td>"; 
                    //echo "<td>Stok PerSize</td>"; 
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
						
						$size1 = $data["size1"];
						$size2 = $data["size2"];
						$size3 = $data["size3"];
						$size4 = $data["size4"];
						$size5 = $data["size5"];
						$size6 = $data["size6"];
						$size7 = $data["size7"];
						$size8 = $data["size8"];
						
						$stok_size = "";
								
						if ($data["size1"] != "")
							$stok_size = $stok_size . $data["size1"] . "/" .$data["qty1"] . " ";
						
						if ($data["size2"] != "")
							$stok_size = $stok_size . $data["size2"] . "/" .$data["qty2"] . " ";
							
						if ($data["size3"] != "")
							$stok_size = $stok_size . $data["size3"] . "/" .$data["qty3"] . " ";
						
						if ($data["size4"] != "")
							$stok_size = $stok_size . $data["size4"] . "/" .$data["qty4"] . " ";
						
						if ($data["size5"] != "")
							$stok_size = $stok_size . $data["size5"] . "/" .$data["qty5"] . " ";
						
						if ($data["size6"] != "")
							$stok_size = $stok_size . $data["size6"] . "/" .$data["qty6"] . " ";
						
						if ($data["size7"] != "")
							$stok_size = $stok_size . $data["size7"] . "/" .$data["qty7"] . " ";
						
						if ($data["size8"] != "")
							$stok_size = $stok_size . $data["size8"] . "/" .$data["qty8"] . " ";
						
						if ($data["size9"] != "")
							$stok_size = $stok_size . $data["size9"] . "/" .$data["qty9"] . " ";
						
						if ($data["size10"] != "")
							$stok_size = $stok_size . $data["size10"] . "/" .$data["qty10"] . " ";  
						
							
												
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td>$i</td>";
						echo "<td>";
						echo "<a href=# onClick=\"submit1('$data[0]', '" . str_replace("'","\'", $data[1]) . "', '$harga', '$size1', '$size2', '$size3', '$size4', '$size5', '$size6', '$size7', '$size8')\">$data[0]</a>";
						echo "</td>";
						echo "<td>" .$data[1] ."</td>"; 
						
                        if ($showHargaBeli) echo "<td align='right'>" .setNumber($data["harga_beli"]) ."</td> ";
                        if ($showHargaJual) echo "<td align='right'>" .setNumber($data["harga_jual"]) . "</td>"; 
                             
                        echo "<td align='right'>" . setNumber($data["qty"]). "</td>"; 
                        //echo "<td >$stok_size</td>";                              
                        echo "<td align='right'><td></td>"; 
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