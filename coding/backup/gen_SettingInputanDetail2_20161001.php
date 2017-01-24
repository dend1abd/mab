<?php
	 		
		//$formValue = $dataValue[$i];
		//eror($formValue);
		$formValue = "";
		$cssClass = "";
		
		$fieldName = $dataGenDetail["FieldName"];
		$fieldType = $dataGenDetail["FieldType"];
		$fieldLen = $dataGenDetail["FieldLen"];
		$fieldInput = $dataGenDetail["FieldInput"];
		$comboData = $dataGenDetail["ComboData"];
		$isMandatory = $dataGenDetail["isMandatory"];
		$disableEdit = $dataGenDetail["disableEdit"];
		$other = $rsGen["other"];  
		
		//eror($fieldInput); 
		echo getTextBox("1", $name, "\" +nilai+ \"", $fieldLen, $fieldLen, " readonly"); 
?>