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
            <?php echo $_GET["strMsg"] ?>
            
            <br /><br />
            <?php 
            
            if(isset($_GET["from"])){
            	$from = $_GET["from"];            	
	            $input = $from . "_entry.php?op=1";
	            $back= $from . "_list.php";	            
	            
        	    echo "<input type='button' class='button' value='Tambah Data' name='btInput' onClick=\"frmGoto('$input')\" >";
        	    echo "&nbsp;";
        	    
        	    if(isset($_GET["kode"])){
        	    	$kode = $_GET["kode"];
        	    	$cetak = $from . "_cetak.php?kode=$kode";
        	    	echo "<input type='button' class='button' value='Cetak' name='btCetak' onClick=\"frmGoto('$cetak')\" >";
	        	    echo "&nbsp;";        	    
        	    }
        	    
        		echo "<input type='button' class='button' value='List Data' name='btBack' onClick=\"frmGoto('$back')\" >";
        	} 
            
            ?>
            </td>
          </tr>
    </table></td></tr></table>
</body>
</html>
