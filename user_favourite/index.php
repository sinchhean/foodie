<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content"width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../style/style1.css"/>
	<link rel="icon" href="../images/1.ico" />
	<title>foodie</title>
</head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<body>
	<!--
	////////////////////////////////////////
	///////////////////////////////////////
	///////Menu Start///////////////////////////
	////////////////////////////////////
	-->
<div class="menu">
<?php
session_start();
require '../menu/index.php';
?>
</div>
<div class="ssmenu">
	<?php
		require '../menu/smenu.php';
	?>
</div> 
	<!--
	/////////////Menu End///////////////////
	////////////////////////////////////////
	-->
	<div class="right">
	<div style="font-size:300%;text-align:center;color: #61210B;">My Favourite</div>
		<div class="upper">
		</div>
		<div class="menulist">
<?php 	require('favor.php');	?>	
		</div>	
		<br><br><br>
		<div class="lower">
		</div>
	</div>
</body>
</html>