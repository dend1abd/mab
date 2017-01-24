<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	$kode = retrieveS($_GET["kode"]);
	$flag = retrieveS($_GET["flag"]);	
	
	$sql = "select product_code, product_name, harga_beli, harga_jual, size1, size2, size3, size4, size5, size6, size7, size8 from mst_product where product_code='$kode'";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	$rs = $oDB->ExecuteReader($sql);
	$row = mysql_fetch_array($rs);
	
	if (mysql_num_rows($rs) == 0){
		echo "not found";
	} 
	else{
		if ( ($flag == 1) || ($flag == 2) || ($flag == 3))
			echo "$row[0]~$row[1]~$row[2]~$row[4]~$row[5]~$row[6]~$row[7]~$row[8]~$row[9]~$row[10]~$row[11]";
		else
			echo "$row[0]~$row[1]~$row[3]~$row[4]~$row[5]~$row[6]~$row[7]~$row[8]~$row[9]~$row[10]~$row[11]";
	}
?>