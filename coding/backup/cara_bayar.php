 
<?php

	$sqlCmd = "select transaksi_kode, cara_bayar, perkiraan_code, perkiraan_name, jumlah, no_reff, tgl_reff, ket_reff from trx_cara_bayar a WHERE a.transaksi_kode ='$transaksi_kode'";
	//eror($sqlCmd); 
    $rsdetailCaraBayar  = $oDB->ExecuteReader($sqlCmd);
	$numRowsCaraBayar = mysql_num_rows($rsdetailCaraBayar);	 
	$jmlItemCaraBayar = $numRowsCaraBayar;
	
	$sqlCmd = "SELECT KodeReff, Reff FROM mst_reff where tipeReff =13"; 
    $rsCaraBayar = $oDB->ExecuteReader($sqlCmd);
?>

<Script Language="JavaScript">
<!--  

var jmlItemCaraBayar = <?php echo $jmlItemCaraBayar ?>;
function AddItemCaraBayar(){
	
	//if(document.getElementById("txtDetailno_invoice0").value== "") 
	//{
	//	alert("Silahkan pilih no invoice");
	//	document.getElementById("txtDetailno_invoice0").focus();
	//	return false;	
	//}
	
	//sumSubDetail();
		
    jmlItemCaraBayar = jmlItemCaraBayar + 1;
	i = jmlItemCaraBayar ; 
	
    var table = document.getElementById("tblCaraBayar");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount  -1); 	
    row.bgColor = "white"  
    
    el = "";
    el = el + "<img src='images/up.gif' onClick='moveUpCaraBayar(" +jmlItemCaraBayar+ ");'>";
    el = el + "<img src='images/down.gif' onClick='moveDownCaraBayar(" +jmlItemCaraBayar+ ");'>";
    el = el + "<img src='images/delmini.gif' onClick='delRowCaraBayar(" +jmlItemCaraBayar+ ");'>"; 
	
	
    var cell0 = row.insertCell(0); 
    cell0.innerHTML = "<div class='font10black' align='center'>" +(jmlItemCaraBayar)+ "</div >" 
    
    nilai = document.getElementById("txtDetailcara_bayar0").value;
    //alert(nilai);
    var cell1 = row.insertCell(1);
    cell1.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailcara_bayar' +i + \""; echo getComboBox("1", $name, "\" +nilai+ \"", $rsCaraBayar, " readonly");?></div>"
	document.getElementById("txtDetailcara_bayar" + i).value = nilai;

	nilai = document.getElementById("txtDetailperkiraan_code0").value;
	nilai2 = document.getElementById("txtDetailperkiraan_name0").value;
	var cell2 = row.insertCell(2);
    cell2.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailperkiraan_code' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, " readonly" ); echo " "; $name="\" + 'txtDetailperkiraan_name' +i + \""; echo getTextBox("1", $name, "\" +nilai2+ \"", 50, 30, " readonly" );?></div>"
    
	nilai = document.getElementById("txtDetailjumlah0").value;
	var cell3 = row.insertCell(3);
    cell3.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailjumlah' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, $clsformatInteger . " readonly" ); ?></div>"
    
	nilai = document.getElementById("txtDetailno_reff0").value;
	var cell4 = row.insertCell(4);
    cell4.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailno_reff' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, " readonly" ); ?></div>"
    
	
	nilai = document.getElementById("txtDetailtgl_reff0").value;
	var cell5 = row.insertCell(5);
    cell5.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailtgl_reff' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, " readonly" ); ?></div>"
    
    nilai = document.getElementById("txtDetailket_reff0").value;
	var cell6 = row.insertCell(6);
    cell6.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailket_reff' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 25, " readonly" ); ?></div>"
    

	var cell7 = row.insertCell(7); 
    cell7.innerHTML = "<div class='font10black' align='center'>" + el + "</div>"
    
    document.getElementById("txtDetailcara_bayar0").value = "";
    document.getElementById("txtDetailperkiraan_code0").value = "";
    document.getElementById("txtDetailperkiraan_name0").value = "";
    document.getElementById("txtDetailno_reff0").value = "";
    document.getElementById("txtDetailjumlah0").value = "";
    document.getElementById("txtDetailtgl_reff0").value = "";
    document.getElementById("txtDetailket_reff0").value = "";    
    document.getElementById("txtDetailcara_bayar0").focus();
	sumJumlahCaraBayar(); 
}    
 

function removeItemCaraBayar()
{
    if(jmlItemCaraBayar != 0)
    {
        var table = document.getElementById('tblCaraBayar');
        var rowCount = table.rows.length;
        table.deleteRow(rowCount-2)	
		
        jmlItemCaraBayar = jmlItemCaraBayar-1; 
    }
}

function moveUpCaraBayar(index){
    if (index > 1){
    	tempDetailcara_bayar = document.getElementById('txtDetailcara_bayar' + (index-1)).value;
        document.getElementById('txtDetailcara_bayar' + (index-1)).value =  document.getElementById('txtDetailcara_bayar' + index).value;
        document.getElementById('txtDetailcara_bayar' + index).value =  tempDetailcara_bayar ; 

		tempDetailperkiraan_code = document.getElementById('txtDetailperkiraan_code' + (index-1)).value;
        document.getElementById('txtDetailperkiraan_code' + (index-1)).value =  document.getElementById('txtDetailperkiraan_code' + index).value;
        document.getElementById('txtDetailperkiraan_code' + index).value =  tempDetailperkiraan_code;
        
        tempDetailperkiraan_name = document.getElementById('txtDetailperkiraan_name' + (index-1)).value;
        document.getElementById('txtDetailperkiraan_name' + (index-1)).value =  document.getElementById('txtDetailperkiraan_name' + index).value;
        document.getElementById('txtDetailperkiraan_name' + index).value =  tempDetailperkiraan_name;

        tempDetailno_reff = document.getElementById('txtDetailno_reff' + (index-1)).value;
        document.getElementById('txtDetailno_reff' + (index-1)).value =  document.getElementById('txtDetailno_reff' + index).value;
        document.getElementById('txtDetailno_reff' + index).value =  tempDetailno_reff;

        tempDetailjumlah = document.getElementById('txtDetailjumlah' + (index-1)).value;
        document.getElementById('txtDetailjumlah' + (index-1)).value =  document.getElementById('txtDetailjumlah' + index).value;
        document.getElementById('txtDetailjumlah' + index).value =  tempDetailjumlah;

        tempDetailtgl_reff= document.getElementById('txtDetailtgl_reff' + (index-1)).value;
        document.getElementById('txtDetailtgl_reff' + (index-1)).value =  document.getElementById('txtDetailtgl_reff' + index).value;
        document.getElementById('txtDetailtgl_reff' + index).value =  tempDetailtgl_reff;
        
        tempDetailket_reff = document.getElementById('txtDetailket_reff' + (index-1)).value;
        document.getElementById('txtDetailket_reff' + (index-1)).value =  document.getElementById('txtDetailket_reff' + index).value;
        document.getElementById('txtDetailket_reff' + index).value =  tempDetailket_reff;
    }
}

function moveDownCaraBayar(index){
    if (index < jmlItemCaraBayar){
    	tempDetailcara_bayar = document.getElementById('txtDetailcara_bayar' + (index+1)).value;
        document.getElementById('txtDetailcara_bayar' + (index+1)).value =  document.getElementById('txtDetailcara_bayar' + index).value;
        document.getElementById('txtDetailcara_bayar' + index).value =  tempDetailcara_bayar ; 

		tempDetailperkiraan_code = document.getElementById('txtDetailperkiraan_code' + (index+1)).value;
        document.getElementById('txtDetailperkiraan_code' + (index+1)).value =  document.getElementById('txtDetailperkiraan_code' + index).value;
        document.getElementById('txtDetailperkiraan_code' + index).value =  tempDetailperkiraan_code;
        
        tempDetailperkiraan_name = document.getElementById('txtDetailperkiraan_name' + (index+1)).value;
        document.getElementById('txtDetailperkiraan_name' + (index+1)).value =  document.getElementById('txtDetailperkiraan_name' + index).value;
        document.getElementById('txtDetailperkiraan_name' + index).value =  tempDetailperkiraan_name;

        tempDetailno_reff = document.getElementById('txtDetailno_reff' + (index+1)).value;
        document.getElementById('txtDetailno_reff' + (index+1)).value =  document.getElementById('txtDetailno_reff' + index).value;
        document.getElementById('txtDetailno_reff' + index).value =  tempDetailno_reff;

        tempDetailjumlah = document.getElementById('txtDetailjumlah' + (index+1)).value;
        document.getElementById('txtDetailjumlah' + (index+1)).value =  document.getElementById('txtDetailjumlah' + index).value;
        document.getElementById('txtDetailjumlah' + index).value =  tempDetailjumlah;

        tempDetailtgl_reff= document.getElementById('txtDetailtgl_reff' + (index+1)).value;
        document.getElementById('txtDetailtgl_reff' + (index+1)).value =  document.getElementById('txtDetailtgl_reff' + index).value;
        document.getElementById('txtDetailtgl_reff' + index).value =  tempDetailtgl_reff;
        
        tempDetailket_reff = document.getElementById('txtDetailket_reff' + (index+1)).value;
        document.getElementById('txtDetailket_reff' + (index+1)).value =  document.getElementById('txtDetailket_reff' + index).value;
        document.getElementById('txtDetailket_reff' + index).value =  tempDetailket_reff;
    } 
}

function delRowCaraBayar(index){
    var i = 0;
    if (index < jmlItemCaraBayar){
        for(i=index;i<jmlItemCaraBayar;i++)
        {
        	document.getElementById('txtDetailcara_bayar' + (i)).value =  document.getElementById('txtDetailcara_bayar' + (i+1)).value; 
        	document.getElementById('txtDetailjumlah' + (i)).value =  document.getElementById('txtDetailjumlah' + (i+1)).value;
            document.getElementById('txtDetailperkiraan_code' + (i)).value =  document.getElementById('txtDetailperkiraan_code' + (i+1)).value;
            document.getElementById('txtDetailperkiraan_name' + (i)).value =  document.getElementById('txtDetailperkiraan_name' + (i+1)).value;
            document.getElementById('txtDetailno_reff' + (i)).value =  document.getElementById('txtDetailno_reff' + (i+1)).value;
            document.getElementById('txtDetailtgl_reff' + (i)).value =  document.getElementById('txtDetailtgl_reff' + (i+1)).value;
            document.getElementById('txtDetailket_reff' + (i)).value =  document.getElementById('txtDetailket_reff' + (i+1)).value;
        }
    }
    removeItemCaraBayar();
    sumJumlahCaraBayar();
} 

function sumJumlahCaraBayar(){
    var i = 0; 
    var sum = 0; 
    var nilai = 0; 
	
	//alert(jmlItemCaraBayar);
    for(i=1;i<=jmlItemCaraBayar;i++)
    {
    	if (document.getElementById('txtDetailjumlah' + (i)).value == "") { document.getElementById('txtDetailjumlah' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailjumlah' + (i)).value));
    	sum = sum + nilai; 
    }     
    
    document.getElementById('txtJmlCaraBayar').value = formatCurrency3(sum);
}

function setNormalCaraBayar(){
    var i = 0; 
    for(i=1;i<=jmlItemCaraBayar;i++)
    { 
    	document.getElementById('txtDetailjumlah' + (i)).value = formatBilangan(document.getElementById('txtDetailjumlah' + (i)).value); 	
    }     
    document.getElementById('txtJmlCaraBayar').value = formatBilangan(document.getElementById('txtJmlCaraBayar').value);    
}

function setBayar(){
	//alert('set bayar');
	jml1 = eval(formatBilangan(document.getElementById('txtJmlCaraBayar').value));
	jml2 = eval(formatBilangan(document.getElementById('txtjml_bayar').value));
	
	document.getElementById('txtDetailjumlah0').value = formatCurrency3(jml2 - jml1);	
}

-->
</Script>

<tr  class="font10black">
				<td colspan=2 valign="top">
					<b>Cara Pembayaran :</b>
				</td>
			</tr>
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblCaraBayar" >  
					<?php
					if($_SESSION["modeView"] == "1"){  
					?>
						<tr bgcolor="white"  align='center'>
							<td align="right"> 
							</td> 
							<td><?php echo getComboBox(1, "txtDetailcara_bayar0", "", $rsCaraBayar, ""); ?></td> 
							<td nowrap="">
							<?php echo getTextBox(1, "txtDetailperkiraan_code0", "", 50, 20, " readonly"); ?>
							<?php echo getTextBox(1, "txtDetailperkiraan_name0", "", 50, 30, " readonly"); ?>
							<input class="button" type="button" name="btnLookUp" value="..." onClick="lookupWindow('perkiraan_lookup.php?elid1=txtDetailperkiraan_code0&elid2=txtDetailperkiraan_name0', 'perkiraanlist')" />							
							</td> 
							<td><?php echo getTextBox(1, "txtDetailjumlah0", "", 50, 15, $clsformatInteger . " onfocus='setBayar()'"); ?></td>  
							<td><?php echo getTextBox(1, "txtDetailno_reff0", "", 50, 20, ""); ?></td>
							<td><?php echo getDatePic(1, "txtDetailtgl_reff0", "", ""); ?></td> 
							<td><?php echo getTextBox(1, "txtDetailket_reff0", "", 50, 25, ""); ?></td> 
							<td nowrap>

							<input class="button" type="button" name="btnAddItem" value="Add Item" onClick="AddItemCaraBayar();" /></td>    
						</tr>
					<?php 
					}
					?>
						<tr class="contentTitleTable" align="center"> 
							<td style="height: 22px">No</td>
							<td style="height: 22px">Cara Bayar</td> 
							<td style="height: 22px">Perkiraan</td>
							<td style="height: 22px">Jumlah Bayar</td>
							<td style="height: 22px">No Giro / Cek</td>
							<td style="height: 22px">Tgl Transfer / Cair</td>
							<td style="height: 22px">Ket</td>  
							<td style="height: 22px"></td> 
						</tr> 
						
						<?php
							$i = 0;
							$sumJumlah = 0;
							while ($datadetailCaraBayar = mysql_fetch_array($rsdetailCaraBayar )) 
							{
								$i++;
								echo "<tr bgcolor='#ffffff' class='font10black'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='center'>";
								echo getComboBox($_SESSION["modeView"], "txtDetailcara_bayar$i", $datadetailCaraBayar["cara_bayar"], $rsCaraBayar, " readonly"); 
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailperkiraan_code$i", $datadetailCaraBayar["perkiraan_code"], 50, 20, " readonly"); 
								echo getTextBox($_SESSION["modeView"], "txtDetailperkiraan_name$i", $datadetailCaraBayar["perkiraan_name"], 50, 30, " readonly");
								echo "</td>";

								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailjumlah$i", setNumber($datadetailCaraBayar["jumlah"]), 50, 15, $clsformatInteger . " ");
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailno_reff$i", $datadetailCaraBayar["no_reff"], 50, 20, " ");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailtgl_reff$i", $datadetailCaraBayar["tgl_reff"], 50, 15, " ");
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailket_reff$i", $datadetailCaraBayar["ket_reff"], 50, 25, " "); 
								echo "</td>"; 
								
								echo "<td align='center'>";
								if($_SESSION["modeView"] == "1"){   
									echo "<img src='images/up.gif' onClick='moveUpCaraBayar($i);'>";
								    echo "<img src='images/down.gif' onClick='moveDownCaraBayar($i);'>";
								    echo "<img src='images/delmini.gif' onClick='delRowCaraBayar($i);'>";  
								}
								echo "</td>"; 
								echo "</tr>";
								
								$sumJumlah = $sumJumlah + $datadetailCaraBayar["jumlah"];
							}
						?>
						
						<tr bgcolor="white" class='font10black'>
							<td colspan="3" align="right" style="height: 22px">Jumlah Bayar</td>  
							<td align="center" style="height: 22px">
							<?php  echo getTextBox($_SESSION["modeView"], "txtJmlCaraBayar", setNumber($sumJumlah), 50, 15, $clsformatInteger . " readonly"); ?>
							<?php  echo getHiddenBox($_SESSION["modeView"], "txtJmlItemCaraBayar", $jmlItemCaraBayar); ?>  
							</td>
							<td colspan="4" align="right" style="height: 22px">
							<?php 
							echo "&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalc\" value=\" &Sigma; \" onClick=\"sumJumlahCaraBayar()\" />"; 
							?>
							</td> 
						</tr>
						
					</table>
				</td> 
			</tr>