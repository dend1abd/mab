<?php   

	include "include/global.php"; 
	?>
	
<html>
<head>
<title><?php echo $pageTitle; ?></title> 
</head>
<link rel='SHORTCUT ICON' href="../images/icon.ico" />
 
<frameset rows="67,*" frameborder="no" border="0" framespacing="0">
	<frame src="top.php" name="upFrame" scrolling="no">
	<frameset cols="220,*" frameborder="no" border="0" framespacing="0" onResize="if (navigator.family == 'nn4') window.location.reload()">
	  	<FRAME src="menu.php" name="treeframe" > 
		<frame src="blank.php" name="downFrame" scrolling="auto" noresize>
		 
	</frameset>
</frameset>
<noframes>
<body>
</body></noframes>
</html>