<?php
	if (mysql_num_rows($rsGen) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGen, 0);
	$i = 0;	
	$fieldNames = "";
	while ($dataGen = mysql_fetch_array($rsGen)) 
	{
		if ($i == 0)
			$koma = "";
		else
			$koma = ", ";
		
		$fieldNames = $fieldNames . $koma . $dataGen["FieldName"];
		$i++;
	} 
	
	$sql = "select $fieldNames from $tableName $whereKondisi";
	//eror($sql);
	$rsRetrieve = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rsRetrieve);		
	if($numRows >0){				
		$dataRetrieve	=	mysql_fetch_array($rsRetrieve);	
		
		mysql_data_seek($rsGen, 0); 
		while ($dataGen = mysql_fetch_array($rsGen)) 
		{ 
			$value = retrieveS($dataRetrieve[$dataGen["FieldName"]]);
			$dataValue[] = $value; 
		} 
	}
	else
		include "gen_ClearData.php";
?>