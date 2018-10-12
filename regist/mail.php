<?php 
require_once("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "lalafoodie01@gmail.com";
$mail->Password = "teamwork1";
$mail->SetFrom("lalafoodie01@gmail.com","foodie");
?>