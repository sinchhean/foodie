<?php
require '../database/db.php';

$email = $_POST['email'];

if($email == NULL){}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   echo "Invalid email"; 
}
else{
	$sql = " SELECT * FROM users WHERE email = ? ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array($email));
	$check = $stmt->rowCount();
	if($check > 0){
		echo "The email is used.";
	}else{
	}
}
?>