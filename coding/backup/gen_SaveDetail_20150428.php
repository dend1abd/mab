<?php

	$sqlCmd = "delete from $tableNameDetail $whereKondisi";
	$oDB->ExecuteNonQuery($sqlCmd);
		
	$jmlItem = $_POST["txtJmlItem"];
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
		
		for($j=1; $j<=10; $j++){
			$value = $_POST["txtdetailsize" .$j. "_$i"];
			$array2d[] = array("kode_size$j", $value, 1);
			
			$value = $_POST["txtdetailqtysize" .$j. "_$i"];
			$array2d[] = array("qty_size$j", $value, 1);
		}
			
		$sqlCmd = sqlInsert($tableNameDetail, $array2d);  
		$oDB->ExecuteNonQuery($sqlCmd);
		//eror($sqlCmd); 
	}
?>