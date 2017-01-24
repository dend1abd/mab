<?php
	echo "<table width=\"$tableWidth\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#d29fec\" align=\"left\">";
	echo "<tr class=\"contentTitleTable\" align=\"center\">";
	echo "<td>No</td>";
	
	//$xx = "insert into $tableName(";
	$arrField = $array2d;
	$pjg = count($arrField);
	//eror("as");
	$fields = "";
	for ($k=0;$k<$pjg;$k++)
	{
		$titleName = $arrField[$k][0];
		$fieldName = $arrField[$k][1];			
		$align = $arrField[$k][2];
		
		if ($arrField[$k][4] != "0")
			echo "<td>$titleName</td>";	
			
		if($k == 0)
			$fields = $fieldName ;
		else
			$fields = $fields . ", " . $fieldName ;	
		
	}
	echo "<td>&nbsp;</td>";	
	echo "</tr>";
	
	$sql = "select $fields $sql";
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	if ($numRows == 0){
		$colspan = $pjg+3;
		echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td colspan=\"$colspan\">Data tidak ada</td></tr>";
	}
	else{
		$i = 0;
		while ($data = mysql_fetch_array($rs)) 
		{
			$i++;
			echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td>$i</td>";
			for ($k=0;$k<$pjg;$k++)
			{
				$titleName = $arrField[$k][0];
				$fieldName = $arrField[$k][1];			
				$align = $arrField[$k][2];				
				$fieldType = $arrField[$k][3];			
				$value = $data[$k];
				
				if ($fieldType == "money") $value = setNumber($value);
				if ($arrField[$k][4] != "0")
					echo "<td align='$align'>$value</td>";			
			}	
			
			$key = $data[0];
			$editLink = "<a href=\"$pageEdit?op=2&ID=$key\">Edit</a>"; 
			$delLink = "<a href=\"$pageEdit?op=3&ID=$key\">Delete</a>"; 
			$viewLink = "<a href=\"$pageEdit?op=4&ID=$key\">View</a>"; 
			
			echo "<td align='center'>$editLink | $delLink | $viewLink</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	
?>