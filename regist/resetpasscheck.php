<?php
require '../database/db.php';
if(isset($_POST['newpas'])){
	$newpas = $_POST['newpas'];

	if($newpas == NULL){}
	elseif(strlen($newpas) < 5){
	echo "Password should be more than 4 characters.";
	}else{}
}
if(isset($_POST['confpas'])){
	$newpas = $_POST['newpas'];
	$confpas = $_POST['confpas'];

	if($confpas == NULL){}
	elseif($newpas != $confpas){
	echo "Passwords do not match.";
	}else{}
}

?>