<?php 
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
echo "hi ,".$username;
if(isset($_POST['logoff'])){
	session_destroy();
	//header('location:'. $_SERVER['REQUEST_URI']);
	header('location: ../home');
}
}else{ //header('location: ../home');
}
?> 
<style>
#logoff{
	color:white;
	font-weight: bold;
	height: 30px;
	width:80px;
	background-color: #4169E1;
}
#logoff:hover{
	background-color: #180A72;
}
</style>
<div>
<form action="" method="post">
	<p><button id="logoff" type="submit" name="logoff">Log off</button></p>
</form>  
</div>　  