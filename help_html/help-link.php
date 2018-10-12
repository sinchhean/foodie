<!--
	////////////////////////////////////////
	///////////////////////////////////////
	///////Help function Start///////////////////////////
	////////////////////////////////////
	-->
<?php
require_once("../regist/PHPMailer/PHPMailerAutoload.php");
require '../database/db.php';

if(isset($_POST['email']) && !empty($_POST['email'])AND isset($_POST['subject']) && !empty($_POST['subject'])) {
	
	$subject =$_POST['subject']; //題名
	$body = $_POST['message']; //内容
	$usermail = $_POST['email'];//メール 

	
	$sql = "SELECT * FROM users WHERE email='$usermail' or username='$usermail' ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();

    if ( $check == 0 ) // User doesn't exist
    { 
        echo "User doesn't exist!";
		echo nl2br("\n");
		echo '<a href="index.php">once again</a>';
    } 
    else { 

////Destination		
$mail = new PHPMailer(); 
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; 
$mail->Username = "lalafoodie01@gmail.com";
$mail->Password = "teamwork1";
//////////Input information//////////////////
$useremail = $usermail; //ユーザのメール 
$usersubject = $subject; ///ユーザ入力タイトル
$userquest = $body; ///ユーザ入力内容
////Send
$mail->addAddress('lalafoodie01@gmail.com', 'My Friend');
$mail->Subject  = $usersubject;
$mail->Body     = '
From ' . $useremail . ' 

'.$userquest;

	if(!$mail->send()) {
		echo 'Message was not sent.';
		echo 'Mailer error: ' . $mail->ErrorInfo;
} 	else {
		echo 'Message has been sent.';
		echo nl2br("\n");
		echo '<a href="../home">Home</a>';
}
	}
	
}	else{
	echo 'Subject or mail or Body has not been entered'; 
	echo nl2br("\n");
	echo '<a href="index.php">once again</a>';
}
?>   
<!--
	////////////////////////////////////////
	///////////////////////////////////////
	///////Help function End///////////////////////////
	////////////////////////////////////
	-->