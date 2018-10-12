<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="icon" href="../images/1.ico" />
	<link rel="stylesheet" href="../style/style-top.css"/>
	<link rel="stylesheet" href="../style/style1.css"/> 
	<link rel="stylesheet" href="../style/signin.css"/> 
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	
	<title>foodie</title>
</head>
 
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
	<!-- -->
	<div class="right"> 
		<?php require '../notification/live_noti.php'; ?> 
		<div class="upper">
		<!--<iframe src="../images/background/back_top1.gif"> </iframe>-->	 	
		<div class="bg-top"> 
			<img class="mySlides" src="../images/topshow/homeshow5.jpg"  style="width:100%;">
			<img class="mySlides" src="../images/topshow/homeshow6.jpg"  style="width:100%;">
			<img class="mySlides" src="../images/topshow/homeshow7.jpg"  style="width:100%;">
			<img class="mySlides" src="../images/topshow/homeshow8.jpg"  style="width:100%;">
			<img class="mySlides" src="../images/topshow/homeshow9.jpg"  style="width:100%;">
			<?php require '../food_search/food_search2.php'; ?>
		</div>
			
<script type="text/javascript" src="../scripts/showyou2.js"></script>	
			
		</div>
		<div class="lower">
			<?php require '../ingre_search/ingre_search.php'; ?>
		</div>
	</div>
</body>
</html>

