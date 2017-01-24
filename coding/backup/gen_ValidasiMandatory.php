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
		
		if($isMandatory == 1){			
			if ($fieldInput == "filebox"){
				echo "if(document.getElementById(\"txt" .$fieldName . "_file\").value== \"\")" . chr(13);
				echo "{" . chr(13);
					echo chr(9) . "alert(\"Silahkan isi $titleName\");" . chr(13);
					echo chr(9) . "document.getElementById(\"txt" .$fieldName . "_file\").focus();" . chr(13);
					echo chr(9) . "return false;" . chr(13);	
				echo "}" . chr(13) . chr(13);
			}
			else{
				echo "if(document.getElementById(\"txt$fieldName\").value== \"\")" . chr(13);
				echo "{" . chr(13);
					echo chr(9) . "alert(\"Silahkan isi $titleName\");" . chr(13);
					echo chr(9) . "document.getElementById(\"txt$fieldName\").focus();" . chr(13);
					echo chr(9) . "return false;" . chr(13);	
				echo "}" . chr(13) . chr(13);
			}
		}
		$i++; 
	} 
?>