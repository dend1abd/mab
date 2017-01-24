<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">  
					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 

					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr>
				<td colspan=2>  
					<table width="100%">  
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">  
					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
					</table>
				</td> 
			</tr> 
			
			<tr>
				<td colspan=2 align='center'> 
					 <?php 
				if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
				{ 
				?>
				  <input class="button" type="button" name="cmdSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
				<?php
				}
				?>
				  <input class='button' type='button' name='cmdBack' value='Back To List' onclick='window.history.back()' />
				</td> 
			</tr>
           
		</table>
	</td>