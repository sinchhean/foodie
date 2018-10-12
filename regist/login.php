<style>
.errorMes{
	color:red;
}
</style>
<?php
require '../database/db.php';
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$sql = "SELECT * FROM users WHERE email='$username' OR username='$username'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$checkuser = $stmt->rowCount();
//ID check
if($checkuser == 0){
	echo "<p class='errorMes'>username or email doesn't exist<p>";
}else{ // user exists
	$checkuser = $stmt->fetch(PDO::FETCH_ASSOC);
//Password check
	if ( password_verify($password, $checkuser['password']) ) {
		if($checkuser['active'] != 1){
			echo "<p class='errorMes'>please verify your email<p>";
		}else{
		$email = $checkuser['email'];
		$_SESSION['username'] = $checkuser['username'];
		$_SESSION['email'] = $checkuser['email'];
		$_SESSION['userID'] = $checkuser['userID'];
		$_SESSION['logged_in'] = true;
		if (!file_exists("../user_mono/$email")) {
			mkdir("../user_mono/$email", 0777, false);
		}
		header('location:'. $_SERVER['REQUEST_URI']);  
		}
	}else{
		echo "<p class='errorMes'>wrong password<p>";
	}
}
?>