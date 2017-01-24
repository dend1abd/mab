<tr>
				<td width=50%> <!-- top kiri-->
					<table width="100%"> 
						<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 1) && ($dataGen["kolom"] == 1))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							
								$i++;
							}
						}
						?>	  
					</table>
				</td>
				
				<td > <!-- top kanan-->
					<table width="100%"> 
                    	<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 1) && ($dataGen["kolom"] == 2))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							
								$i++;
							}
						}
						?>
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblDetail" >  
                    
                    <?php
						echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
						echo "<td width=3%><input class=\"button\" type=\"button\" name=\"btnLookUp\" value=\"...\" onClick=\"lookupWindow('product_lookup.php?tipe=3', 'product_list')\" /></td>";							
						$i = 0;
						mysql_data_seek($rsGenDetail, 0);						
						while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
						{ 	
							echo "<td>";
							include "gen_SettingInputanDetail.php"; 
							echo "</td>";							
							$i++; 
						}
						echo "<td nowrap><input class=\"button\" type=\"button\" name=\"btnAddItem\" value=\"Add Item\" onClick=\"AddItem();\" /></td>";							
						echo "</tr>"; 
						
                        echo "<tr class=\"contentTitleTable\" align=\"center\" >";
						echo "<td width=3% ></td>";							
						$i = 0;
						$iSum = 0;
						mysql_data_seek($rsGenDetail, 0);						
						while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
						{ 	
							echo "<td>";
							echo $dataGenDetail["TitleName"];
							echo "</td>"; 
							$i++; 
							
							if ($dataGenDetail["haveSum"] == 1){ 
								$dataValueSum[$iSum] = 0;
								$iSum++;
							}
						}
						echo "<td>&nbsp;</td>";
						echo "</tr>"; 
						
						//******* tampilkan detail
						include "gen_RetrieveDataDetail.php";
						
						//******* subtotal detail
						echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
						echo "<td width=3% ></td>";							
						$i = 0;
						$iSum = 0;
						mysql_data_seek($rsGenDetail, 0);						
						while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
						{ 	
							echo "<td>";
							if ($dataGenDetail["haveSum"] == 1){
								$fieldLen = $dataGenDetail["FieldLen"];
								echo getTextBox($_SESSION["modeView"], "txtdetail" .$fieldName. "_sum", setNumber($dataValueSum[$iSum]), $fieldLen, $fieldLen, $clsformatInteger . " readonly");
								$iSum++;
							}
							else
								echo "&nbsp;";
								
							echo "</td>"; 
							$i++; 
						}
						echo "<td>";
						echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","<?php echo $jmlItem;?>");
						echo "</td>";
						echo "</tr>";
						
						?> 
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- bottom kiri-->
					<table width="100%"> 
                    	<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 2) && ($dataGen["kolom"] == 1))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							
								$i++;
							}
						}
						?>
					</table>
				</td>
				
				<td > <!-- bottom kanan-->
					<table width="100%"> 
						<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 2) && ($dataGen["kolom"] == 2))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							
								$i++;
							}
						}
						?> 
					</table>
				</td> 
			</tr>