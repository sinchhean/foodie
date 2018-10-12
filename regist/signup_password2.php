<?php


$password2 = $_POST['password2'];
$password1 = $_POST['password1'];

if($password2 == NULL){}
elseif($password1 != $password2){
	echo "passwords do not match";
}
else{
}
?>