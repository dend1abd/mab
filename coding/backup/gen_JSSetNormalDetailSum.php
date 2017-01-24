<?php
	if (mysql_num_rows($rsGenDetail) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGenDetail, 0);
	$i = 1;	
	while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
	{  
		$fieldName = $dataGenDetail["FieldName"];  
		if ($dataGenDetail["haveSum"] == 1) {			
			echo "document.getElementById(\"txtdetail$fieldName\" + \"_sum\").value = formatBilangan(document.getElementById(\"txtdetail$fieldName\" + \"_sum\").value);"; 
		}
		$i++;  
	} 
?>