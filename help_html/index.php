<!DOCTYPE html>
<html>
<head>
	<!--<script src="scripts/home.js"></script>-->
	<meta charset="utf-8">
	<meta name="viewport" content"width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../style/style1.css"/>
	<link rel="icon" href="../images/1.ico" />
 <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
 <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<title>help</title>
</head>
<script>
$(document).ready(function(){
	///////////////////////////////////////////
	/////////automatically increase the height of the textarea/////////////////
autosize(document.getElementsByTagName("textarea"));} );
</script>
<body>
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

<?php require '../notification/live_noti.php'; ?> 
<div class="right">
	<div class="help-link">
		<h1>Inquiry</h1> <br>

		<form style="" action="help-link.php" method="post">	
		<span style="font-size:150%">
		Subject：<br />
			<input type="text" name="subject" value="" style="width:200px; height:30px; font-size:100%;"/><br />
		Username or Mail address：<br />
			<input type="text" name="email" size="30" value="" style="width:300px; height:30px; font-size:100%;"/><br />
		
		Body：<br />
			<textarea name="message" cols="50" rows="10" style="
	background-color: white;
	width: 500px;
	font-size: 100%;
	background: none;
	border: none;
	background-image: -webkit-linear-gradient(left, white 10px, transparent 10px), -webkit-linear-gradient(right, white 10px, transparent 10px), -webkit-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -moz-linear-gradient(left, white 10px, transparent 10px), -moz-linear-gradient(right, white 10px, transparent 10px), -moz-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -ms-linear-gradient(left, white 10px, transparent 10px), -ms-linear-gradient(right, white 10px, transparent 10px), -ms-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -o-linear-gradient(left, white 10px, transparent 10px), -o-linear-gradient(right, white 10px, transparent 10px), -o-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: linear-gradient(left, white 10px, transparent 10px), linear-gradient(right, white 10px, transparent 10px), linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-size: 100% 100%, 100% 100%, 100% 31px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    line-height: 31px;
    font-family: Arial, Helvetica, Sans-serif;
    padding: 8px;"></textarea><br /><br />
		</span>
	<div class="btn">
	<style>
	.lol11:hover{
		
	}
	</style>
	<input class="lol11"  type="submit" name="botan" value="Send" />
		</form>
	</div> 
	</div>
</div>
</body>

</html>
