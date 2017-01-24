<?php 
	//size* qty
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td align='center' colspan=3>size x qty</td>";
			echo "<td colspan=9>";
			
			echo "<table width=\"100%\"  cellspacing=\"1\" bgcolor=\"silver\" id=\"tblJurnalDetailItem\" >";
			echo "<tr bgcolor=\"white\" class=\"font10black\">";
			
			$cssClass = $clsReadOnly;
			for ($j=1;$j<=8;$j++){
				echo "<td nowrap>";
				$value = retrieveS($dataRetrieveDetail["kode_size$j"]); 
				//echo getComboBox5($_SESSION["modeView"], "txtdetailsize" .$j. "_" . $i, $value, $rsSize, "");
				echo getTextBox($_SESSION["modeView"], "txtdetailsize" .$j. "_" . $i, $value, 10, 3, $clsformatIntegerReadOnly  . " readonly"); 
				echo " x ";
				$value = retrieveS($dataRetrieveDetail["qty_size$j"]); 
				echo getTextBox($_SESSION["modeView"], "txtdetailqtysize" .$j. "_" . $i, $value, 10, 5, ""); 
				echo "</td>";	
			}
			
			echo "</tr>";
			echo "</table>";
			
			echo "</td>"; 
			echo "</tr>";
			//end size* qty
?>
