<?php
require "../database/db.php";
	$cnt = 0;
	$userID = $_SESSION['userID'];
	$sql = "SELECT noti FROM comment WHERE noti = 1 AND food_user_ID = $userID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount(); 
	$cnt = $cnt+$check;
	$sql = "SELECT noti FROM comment_reply WHERE noti = 1 AND comment_user_ID = $userID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount(); 
	$cnt = $cnt+$check;
	echo "<a id='links6'  href='../notification/noti_manage_command.php' >All notifications</a>";
?>
<style>

</style>