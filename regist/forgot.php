<?php 
/* Reset your password form, sends reset.php password link */
require '../database/db.php';
require_once("mail.php");
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();

    if ( $check == 0 ) // User doesn't exist
    { 
        echo "User $email doesn't exist!";
    }
    else { // User exists (num_rows != 0)

        $check = $stmt->fetch(PDO::FETCH_ASSOC); // $user becomes array with user data
        
        $email = $check['email'];
        $hash = $check['hash'];
        $username = $check['username'];

        // Session message to display on success.php
        echo "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
		$mail->Subject = "Password Reset Link ( foodie )";
		$mail->AddAddress($email);
		$mail->Body ='
        Hello'. $username.',

        You have requested password reset!

        Please click this link to reset your password:

        http://126.28.162.24:9090/regist/reset.php?email='.$email.'&hash='.$hash;  

        $mail->Send();

  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/resetpass.css"/>
  <link rel="icon" href="../images/1.ico" />
  <title>Reset Your Password</title>
</head>

<body>
    
  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
	<a href='../home'>Home</a>
	<a href='../help_html/'>Inquiry</a>
    </form> 
  </div>
  
</body>

</html>
