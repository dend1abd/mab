<?php
	if (mysql_num_rows($rsGen) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGen, 0);
	$i = 0;	
	while ($dataGen = mysql_fetch_array($rsGen)) 
	{ 
		$isMandatory = $dataGen["isMandatory"];
		$fieldName = $dataGen["FieldName"];
		$fieldType = $dataGen["FieldType"];
		$fieldInput = $dataGen["FieldInput"];
		$titleName = $dataGen["TitleName"];
		
		if (($fieldType == "int") || ($fieldType == "integer") || ($fieldType == "money")) {			
			echo "document.getElementById(\"txt$fieldName\").value = formatBilangan(document.getElementById(\"txt$fieldName\").value);"; 
		}
		$i++;  
	} 
?>