<?php
require 'db.php';
require_once("mail.php");
/////////USERNAME/////////////
$what = 0;
$username = htmlspecialchars($_POST['username']);
if($username == NULL){$what++;}
if (strlen($username) < 5) {$what++;}
if (!ctype_alnum($username)) {$what++;}
if($username){
	$sql = " SELECT * FROM users WHERE username = ? ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array($username));
	$check = $stmt->rowCount();
	if($check > 0){
		$what++;
}}
/////////////////////
//////////EMAIL////////
$email = htmlspecialchars($_POST['email']);
if($email == NULL){$what++;}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$what++;}
if($email){
	$sql = " SELECT * FROM users WHERE email = ? ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array($email));
	$check = $stmt->rowCount();
	if($check > 0){
		$what++;
	}
}
//////////////////////
///////////////password1///////////
$password1 = $_POST['password1'];
if($password1 == NULL){$what++;}
if(strlen($password1) < 5){$what++;}
///////////////////////////////
//////////password2/////////////
$password2 = $_POST['password2'];
if($password2 == NULL){$what++;}
if($password1 != $password2){$what++;}

//////////////////////////////
///////////////////////////////
////////CHECK////////////////////
////////////////////////////////
if ($what > 0){
	echo 'Registration Failed';
}else{
	$password = password_hash($password1, PASSWORD_BCRYPT);
	$hash = md5(rand(0,1000));
	$sql = "INSERT INTO users (username, email, password, hash) " 
            . "VALUES ('$username','$email','$password', '$hash')";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){
		$_SESSION['active'] = 0; //0 until user activates their account with verify.php	
		$mail->Subject = "Account Verification ( foodie )";
		$mail->AddAddress($email);
		$mail->Body ='
			Hello,

			Thank you for signing up!

			Please click this link to activate your account:

			http://126.28.162.24:9090/regist/verify.php?email='.$email.'&hash='.$hash;
		if(!$mail->Send()){echo "Failed to send";}
		else{header('location:resuc.php');}
	}else{
		echo 'There is some issues with the server.'; 
	}	
}

?>
