<?php
	if (mysql_num_rows($rsGenDetail) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGenDetail, 0);
	$i = 1;	
	while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
	{ 
		$fieldType = $dataGenDetail["FieldType"];  
		$fieldName = $dataGenDetail["FieldName"];  
		if (($fieldType == "int") || ($fieldType == "integer") || ($fieldType == "money")) {			
			echo "document.getElementById(\"txtdetail$fieldName\" + \"_\" + (i)).value = formatBilangan(document.getElementById(\"txtdetail$fieldName\" + \"_\" + (i)).value);"; 
		}
		$i++;  
	} 
?>