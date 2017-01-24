<?php


	global $tableGen;	 		
			
$clsformatInteger = "style='TEXT-ALIGN: RIGHT'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #FCF'  onChange='this.value=formatCurrency3(this.value);'";
$clsReadOnly = "style='background-color: #CCCCCC'";
$clsMandatory = "style='background-color: #FCF'";


		$formValue = $dataValue[$i];
		//eror($formValue);
		$cssClass = "";
		
		$fieldName = $dataGen["FieldName"];
		$fieldType = $dataGen["FieldType"];
		$fieldLen = $dataGen["FieldLen"];
		$fieldInput = $dataGen["FieldInput"];
		$comboData = $dataGen["ComboData"];
		$isMandatory = $dataGen["isMandatory"];
		$disableEdit = $dataGen["disableEdit"];
		$other = $rsGen["other"];  
		
		//eror($fieldInput); 
		
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
			
			$elSize = $fieldLen;
			if (($fieldLen > 20) && ($fieldLen <= 30)) $elSize = 20;
			if (($fieldLen > 30) && ($fieldLen <= 50)) $elSize = 30;
			if ($fieldLen > 50) $elSize = 50;
			echo getTextBox($_SESSION["modeView"], "txt$fieldName", $formValue, $fieldLen, $elSize, $readonly . $cssClass); 
		}
		
		if($fieldInput == "combobox"){
			/*$rsData = null;
			if( $comboData == "rsGudang") $rsData = $rsGudang;
			if( $comboData == "rsPetugas") $rsData = $rsPetugas;
			if( $comboData == "rsWarna") $rsData = $rsWarna;
			if( $comboData == "rsSupplier") $rsData = $rsSupplier;
			if( $comboData == "rsCustomer") $rsData = $rsCustomer;
			
			if( $comboData == "rsKelBarang") $rsData = $rsKelBarang;
			if( $comboData == "rsJenisBarang") $rsData = $rsJenisBarang;
			if( $comboData == "rsMerekBarang") $rsData = $rsMerekBarang;
			if( $comboData == "rsNegara") $rsData = $rsNegara;
			if( $comboData == "rsKelSize") $rsData = $rsKelSize;*/
			
			if($comboData == "rsFaktur")
				$rsData = getComboFaktur($customer);
			else
				$rsData = getComboData($comboData);			

			$js = "";
			if ($dataGen["FieldName"] ==  "kode_size"){
				$js = " onchange=\"tampilkanSize(this.selectedIndex);\" ";
			}
			
			if ( ($dataGen["FieldName"] ==  "contact_code") && ($tableGen == "trx_order_jual")){
				$js = " onchange=\"isiSales(this.selectedIndex);\" ";
			}
			
			$cssWarna = "";
			if ($isMandatory == 1)
				$cssWarna = $clsMandatory;
						
			if ($disableEdit == 1){
				echo getHiddenBox($_SESSION["modeView"], "txt$fieldName", $formValue);
				echo getComboBox("2", "txt$fieldName", $formValue, $rsData, "");
			}				
			else
				echo getComboBox($_SESSION["modeView"], "txt$fieldName", $formValue, $rsData, $readonly . $js .  $cssWarna );
		}
		
		if($fieldInput == "datepicker"){
			if ($isMandatory == 1)
				echo getDatePicMand($_SESSION["modeView"], "txt$fieldName", $formValue, "");
			else
				echo getDatePic($_SESSION["modeView"], "txt$fieldName", $formValue, "");
		}

		if($fieldInput == "combocust"){
			$rsData = getComboData($comboData);	
			echo getComboCust($_SESSION["modeView"], "txt$fieldName", $formValue, $fieldLen, $rsData, $cssWarna );
		}
		
		if($fieldInput == "textarea"){
			echo getTextArea($_SESSION["modeView"], "txt$fieldName", $formValue, 5, 50, "");	
		}
		
		if($fieldInput == "tinymce"){
			echo getTinyMCE($_SESSION["modeView"], "txt$fieldName", $formValue, 25, 100, "");	
		}
		
		if($fieldInput == "filebox"){			
			$txtname = "txt$fieldName" . "_file";
			
			echo "<input type='file' name='$txtname' id='$txtname'  size=$fieldLen value=\"$formValue\" />"; 
			echo getHiddenBox($_SESSION["modeView"], "txt$fieldName", $formValue);
		}
?>