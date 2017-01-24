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
		
		$kode= $_GET["kode"];
		$tipe = $_GET["tipe"];
		
	}
	
	$sql2 = "
	select * from mst_product a ";
	
	if ($kode != "")
		$sql2 = $sql2 . " where a.product_code like '$kode%' ";	
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

function submit1(kode, nama){
	window.opener.document.getElementById("txtproduct_code").value=kode;
	window.opener.document.getElementById("txtproduct_name").value=nama;
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
							
												
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td>$i</td>";
						echo "<td>";
						echo "<a href=# onClick=\"submit1('$data[0]', '" . str_replace("'","\'", $data[1]) . "')\">$data[0]</a>";
						echo "</td>";
						echo "<td>" .$data[1] ."</td>"; 
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