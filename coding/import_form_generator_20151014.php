<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	include 'excel_reader.php';     // include the class 
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);  

function sheetData($sheet) {
  $re = '<table>';     // starts html table

  $x = 1;
  while($x <= $sheet['numRows']) {
    $re .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      $re .= " <td>$cell</td>\n";  
      $y++;
    }  
    $re .= "</tr>\n";
    $x++;
  }

  return $re .'</table>';     // ends and returns the html table
}

function importData($sheet) {  

  $x = 2;
  $sql = "";
  while($x <= $sheet['numRows']) {		
  	unset($array2d);
	
	$y = 1;
	while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      if ($y == 1) $fieldName = "formNo";
	  if ($y == 2) $fieldName = "tableName";
	  if ($y == 3) $fieldName = "sortNo";
	  if ($y == 4) $fieldName = "TitleName";
	  if ($y == 5) $fieldName = "FieldName";
	  if ($y == 6) $fieldName = "FieldType";
	  if ($y == 7) $fieldName = "FieldLen";
	  if ($y == 8) $fieldName = "FieldInput";
	  if ($y == 9) $fieldName = "ComboData";
	  if ($y == 10) $fieldName = "isMandatory";
	  if ($y == 11) $fieldName = "disableEdit";
	  if ($y == 12) $fieldName = "other";
	  if ($y == 13) $fieldName = "section";
	  if ($y == 14) $fieldName = "kolom";
	  if ($y == 15) $fieldName = "haveSum";
	  
	  $array2d[] = array($fieldName, $cell, 1);	  
      $y++;
    }  
	
	$xx = sqlInsert("form_generator", $array2d);
	$sql .= $xx . "; ";	 
	//$oDB->ExecuteNonQuery($xx);
    $x++;
  } 
  
  return $sql;
  
}

function importData2($sheet) {  

  $x = 2;
  $sql = "";
  while($x <= $sheet['numRows']) {		
  	unset($array2d);
	
	$y = 1;
	while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      if ($y == 1) $fieldName = "kode";
	  if ($y == 2) $fieldName = "query"; 
	  
	  $array2d[] = array($fieldName, $cell, 1);	  
      $y++;
    }  
	
	$xx = sqlInsert("combo_data", $array2d);
	$sql .= $xx . "; ";	 
	//$oDB->ExecuteNonQuery($xx);
    $x++;
  } 
  
  return $sql;
  
}

	

$excel = new PhpExcelReader;
$fileName = 'generator\form_generator.xls';
$excel->read($fileName);

$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';              // to store the the html tables with data of each sheet
	
 
	if (isset($_POST["txtFileName"]))
	{
		$sqlCmd = "delete from form_generator; delete from combo_data; ";	
        //$oDB->ExecuteNonQuery($sqlCmd);
		
		$sqlAll = "";
		for($i=0; $i<$nr_sheets; $i++) {
			//if ($excel->boundsheets[$i]['name'] == "combo_data")  	
			if ($i == 0)
				$sqlAll .= importData2($excel->sheets[$i]);  
			else
				$sqlAll .= importData($excel->sheets[$i]);  
			
		} 
		echo $sqlCmd . $sqlAll; 
		eror("");
	}
	else{
		for($i=0; $i<$nr_sheets; $i++) {
		  $excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
		} 
	}
	
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Example PHP Excel Reader</title>
<style type="text/css">
table {
 border-collapse: collapse;
}        
td {
 border: 1px solid black;
 padding: 0 0.5em;
}        
</style>

<Script Language="JavaScript">
<!-- 
	
	function frmSubmit(){ 
		msg = "Proses Data ?";
		if(confirm(msg)){
			document.input.submit();
		}
	}
-->
</Script>

</head>
<body>
<form name='input' method="post"> 
    File Name : <input type="text" name="txtFileName" value="<?php echo $fileName; ?>" size="100" /> 
    <br />
    <input type="button" name="btSubmit" value="Import" onClick="frmSubmit();" />
</form>


<?php
// displays tables with excel file data
echo $excel_data;
?>  
  

</body>
</html>
