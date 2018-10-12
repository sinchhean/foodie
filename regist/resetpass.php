<?php
/* Password reset process, updates database with new user password */
require '../database/db.php';
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
if($_POST['newpassword'] == NULL){$what++;}
if(strlen($_POST['newpassword']) < 5){$what++;}
if($_POST['confirmpassword'] == NULL){$what++;}
if($_POST['newpassword'] != $_POST['confirmpassword']){$what++;}
    // Make sure the two passwords match
	$email = $_POST['email'];
    $hash = $_POST['hash'];
    if ($what == 0) {  

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        $hash = md5(rand(0,1000));
        
        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";
		$stmt=$dbh->prepare($sql);
		
        if ($stmt->execute()) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: resetsucc.php");    

        }
    }
    else {
        $_SESSION['message'] = "Please check your passwords again.";
        header("location: reset.php?email=".$email."&hash=".$hash);    
    } 

}
?>