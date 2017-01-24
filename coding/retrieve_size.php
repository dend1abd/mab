<?php 
$nSize = 8;
$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatInteger = "style='TEXT-ALIGN: RIGHT'  onChange='this.value=formatCurrency3(this.value);'";

	//size* qty
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td align='center' colspan=2>size x qty</td>";
			
			if ( ($_SESSION["transaksi_tipe"] == "7")||($_SESSION["transaksi_tipe"] == "8") )
				echo "<td colspan=8>";
			else
				echo "<td colspan=8>";
			
			echo "<table width=\"100%\"  cellspacing=\"1\" bgcolor=\"silver\" id=\"tblJurnalDetailItem\" >";
			echo "<tr bgcolor=\"white\" class=\"font10black\">";
			for ($j=1;$j<=$nSize;$j++){
				echo "<td nowrap>";
				$value = retrieveS($dataRetrieveDetail["kode_size$j"]); 
				//echo getComboBox5($_SESSION["modeView"], "txtdetailsize" .$j. "_" . $i, $value, $rsSize, "");
				echo getTextBox($_SESSION["modeView"], "txtdetailsize" .$j. "_" . $i, $value, 10, 3, $clsformatIntegerReadOnly . " readonly"); 
				echo " x ";
				$value = retrieveS($dataRetrieveDetail["qty_size$j"]); 
				echo getTextBox($_SESSION["modeView"], "txtdetailqtysize" .$j. "_" . $i, $value, 10, 5, ""); 
				echo "</td>";	
			}
			
			echo "</tr>";
			echo "</table>";
			
			echo "</td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
			//end size* qty
?>
