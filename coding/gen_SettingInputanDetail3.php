<?php
	 		
		//$formValue = $dataValue[$i];
		//eror($formValue);
		
$clsformatInteger = "style='TEXT-ALIGN: RIGHT'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #93F'  onChange='this.value=formatCurrency3(this.value);'";
$clsReadOnly = "style='background-color: #CCCCCC'";
$clsMandatory = "style='background-color: #FCF'";

		$formValue = $value;
		$cssClass = "";
		
		$fieldName = $dataGenDetail["FieldName"];
		$fieldType = $dataGenDetail["FieldType"];
		$fieldLen = $dataGenDetail["FieldLen"];
		$fieldInput = $dataGenDetail["FieldInput"];
		$comboData = $dataGenDetail["ComboData"];
		$isMandatory = $dataGenDetail["isMandatory"];
		$disableEdit = $dataGenDetail["disableEdit"];
		$other = $rsGen["other"];  
		
		if (($fieldName == "harga") || ($fieldName == "qty") || ($fieldName == "disc_persen") || ($fieldName == "disc_amount") ){
			$readOnly = "";
			
			if ($fieldName != "disc_persen"){
				$cssClass = $clsformatInteger;			
				$formValue = setNumber($formValue);			
			}
		}
		else if ($fieldName == "ket_detail"){
			$readOnly = "";
			$cssClass = "";
		}
		else{
			$readOnly = " readonly";
			$cssClass = $clsReadOnly;
			if (($fieldType == "money") || ($fieldType == "integer")){
				$cssClass = $clsformatIntegerReadOnly;				
				$formValue = setNumber($formValue);
			}
		} 
		
		echo getTextBox($_SESSION["modeView"], "txtdetail" .$fieldName. "_$i", $formValue, $fieldLen, $fieldLen, $cssClass . $readOnly); 
		
?>