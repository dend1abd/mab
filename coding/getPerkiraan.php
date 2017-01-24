<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	//cekSession(); 
	
	$kode = $_GET["kode"];
	
	$sql = "select perkiraan_name from mst_perkiraan where perkiraan_code='$kode'";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$rs = $oDB->ExecuteReader($sql);
	$row = mysql_fetch_array($rs);
	
	if($row[0] ==""){
		echo "<not found>";
	} 
	else
		echo "$row[0]";
?>

