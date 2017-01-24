<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Global Notification</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmGoto(url){  
    self.location=url; 
} 

function frmCetak1(kode){
	window.open("sales_order_cetak.php?kode="+kode, "sales_order_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

}

function frmCetak2(kode){
	window.open("sales_order_kartu_produksi.php?kode="+kode, "sales_order_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");
}

-->
</Script> 


</head>

<body>
<table class="1" width=70%  cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td class="contentTitleTable" align="center">ATTENTION!!</td>
  </tr>
          <tr>
		   <td valign="top"><table width=100% height="360" cellpadding="2" cellspacing="2" bgcolor="white">
		
          <tr>
            <td align=center class="fontblueheader13">
            <?php 
				echo $_GET["strMsg"];
				
				$kode = "";	    
				if(isset($_GET["kode"])){
        	    	$kode = $_GET["kode"];	    
        	    }
				
			?>
            
            <br /><br />
            <?php 
	            
        	    echo "<input type='button' class='button' value='Tambah Data' name='btInput' onClick=\"frmGoto('sales_order_entry.php?op=1')\" >";
        	    echo "&nbsp;";
				
				echo "<input type='button' class='button' value='Cetak' name='btCetak1' onClick=\"frmCetak1('$kode')\" >";
        	    echo "&nbsp;";
				
				echo "<input type='button' class='button' value='Cetak Kartu Produksi' name='btCetak2' onClick=\"frmCetak2('$kode')\" >";
        	    echo "&nbsp;";
				
				echo "<input type='button' class='button' value='List Data' name='btList' onClick=\"frmGoto('sales_order_list.php')\" >";
        	    echo "&nbsp;";            
            ?>
            </td>
          </tr>
    </table></td></tr></table>
</body>
</html>
