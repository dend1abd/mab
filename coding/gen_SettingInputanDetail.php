<?php
$clsformatInteger = "style='TEXT-ALIGN: RIGHT'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #FCF'  onChange='this.value=formatCurrency3(this.value);'";
$clsReadOnly = "style='background-color: #CCCCCC'";
$clsMandatory = "style='background-color: #FCF'";


		//$formValue = $dataValue[$i];
		//eror($formValue);
		$formValue = "";
		$cssClass = "";
		$js = "";
		
		$fieldName = $dataGenDetail["FieldName"];
		$fieldType = $dataGenDetail["FieldType"];
		$fieldLen = $dataGenDetail["FieldLen"];
		$fieldInput = $dataGenDetail["FieldInput"];
		$comboData = $dataGenDetail["ComboData"];
		$isMandatory = $dataGenDetail["isMandatory"];
		$disableEdit = $dataGenDetail["disableEdit"];
		$other = $rsGen["other"];  
		
		$readonly = "";
		if ($disableEdit == 1)
			$readonly = " readonly ";
		
		if($fieldInput == "textbox"){				
			if ($fieldType == "money"){
				$cssClass = $clsformatInteger;
				if ($disableEdit == 1)
					$cssClass = $clsformatIntegerReadOnly;				
				else
					if ($isMandatory == 1)
						$cssClass = $clsformatIntegerMandatory;
						
				$formValue = setNumber($formValue);
			} 
			else{
				if ($disableEdit == 1)
					$cssClass = $clsReadOnly;				
				else
					if ($isMandatory == 1)
						$cssClass = $clsMandatory;
			}
			
			$js = "";
			if ($dataGenDetail["FieldName"] ==  "product_code"){
				//$js = $ajaxgetProductBeli;
				$js = " onchange=\"getBarang(this, " .$_SESSION["transaksi_tipe"]. ")\" ";
			}
			
			echo getTextBox($_SESSION["modeView"], "txtdetail" .$fieldName. "_0", $formValue, $fieldLen, $fieldLen, $cssClass . $js); 
		}
		
		if($fieldInput == "combobox"){
			if( $comboData == "rsGudang") $rsData = $rsGudang;
			if( $comboData == "rsPetugas") $rsData = $rsPetugas;
			if( $comboData == "rsWarna") $rsData = $rsWarna;
				
			echo getComboBox($_SESSION["modeView"], "txtdetail" .$fieldName. "_0", $formValue, $rsData, $readonly .  "");
		}
		
		if($fieldInput == "datepicker"){
			echo getDatePic($_SESSION["modeView"], "txtdetail" .$fieldName. "_0", $formValue, "");
		}
		
		if($fieldInput == "textarea"){
		}
?>