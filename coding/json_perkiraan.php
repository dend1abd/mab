<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	 
	
	//if ( !isset($_REQUEST['term']) )
	//	exit;
	
	$ac_term = "%".$_GET['term']."%";  
	$return_arr = array();  
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$sqlCmd = "select * from mst_perkiraan where perkiraan_code like $ac_term";
	//eror($sqlCmd); 
    $rs = $oDB->ExecuteReader($sqlCmd);
    
    /* Retrieve and store in array the results of the query.*/ 
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $row_array['label'] = $row['perkiraan_code'];
        $row_array['value'] = $row['perkiraan_code'];
         
        array_push($return_arr,$row_array);
    }

	echo json_encode($return_arr); 
?>
