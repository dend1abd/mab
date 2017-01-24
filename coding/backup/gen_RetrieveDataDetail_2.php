<?php 
	$numRows = mysql_num_rows($rsRetrieveDetail);		
	if($numRows >0){
		$i = 1;
		while ($dataRetrieveDetail	=	mysql_fetch_array($rsRetrieveDetail))
		{
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td>";
			if($_SESSION["modeView"] == "1"){
				echo "<img src='images/delmini.gif' onClick='delRow($i);'>";  
			}
			echo "</td>";
			
			echo "<td width=3% >$i</td>";
						
			mysql_data_seek($rsGenDetail, 0); 
			$iSum = 0;
			while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
			{ 
				echo "<td>";
				$value = retrieveS($dataRetrieveDetail[$dataGenDetail["FieldName"]]); 
				include "gen_SettingInputanDetail3.php";
				echo "</td>";
				
				if ($dataGenDetail["haveSum"] == 1){ 
					$dataValueSum[$iSum] = $dataValueSum[$iSum] + $value;
					$iSum++;
				}
			}
			echo "</tr>";
			$i++;			
		}		 
	} 
?>