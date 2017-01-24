<?php

	$sqlCmd = "delete from $tableNameDetail $whereKondisi";
	$oDB->ExecuteNonQuery($sqlCmd);
		
	$jmlItem = $_POST["txtJmlItem"];
	$nSize = 8;
		//eror($jmlItem);

	for($i=1; $i<=$jmlItem; $i++){
		unset($array2d);
		$array2d[] = array("transaksi_kode", $_SESSION["ID"], 1); 
		
		mysql_data_seek($rsGenDetail, 0);						
		while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
		{ 	
			$fieldName = $dataGenDetail["FieldName"];
			$fieldType = $dataGenDetail["FieldType"];
			
			$value = $_POST["txtdetail" .$fieldName. "_$i"];
			$array2d[] = array($fieldName, $value, 1);
		}			
		$sqlCmd = sqlInsert($tableNameDetail, $array2d);  
		$oDB->ExecuteNonQuery($sqlCmd);
		//eror($sqlCmd); 
	}
?>