<?php 
require_once("PHPMailer/PHPMailerAutoload.php");
require 'help.php';
$usermail = new PHPMailer();
$usermail->IsSMTP();
$usermail->SMTPAuth = true;
$usermail->SMTPSecure = 'ssl';
$usermail->Host = "smtp.gmail.com";
$usermail->Port = 465;
$usermail->Username = $_POST['email'];
//$mail->Password = "teamwork";
$usermail->SetFrom("no-reply@foodie.com");
?>