<?php
require 'db.php';

$username = htmlspecialchars($_POST['username']);

 
if($username == NULL){}
elseif (strlen($username) < 5) {
   echo "At least 5 letters";
}
elseif (!ctype_alnum($username)) {
	echo "only alphabets and numbers";
}
else{ 
	$sql = " SELECT * FROM users WHERE username = ? ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array($username));
	$check = $stmt->rowCount();
	if($check > 0){
		echo "username already exists";
	}else{ 
	}
}
	
?>