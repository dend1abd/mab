<?php
	if (mysql_num_rows($rsGen) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGen, 0);
	$i = 0;	
	while ($dataGen = mysql_fetch_array($rsGen)) 
	{		
		$dataValue[] = $_POST["txt" . $dataGen["FieldName"]]; 
		//$dataValue[$i] = "1"; 
		//$i++;
	} 
?>