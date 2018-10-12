<?php
session_start(); 
require "../database/db.php";
////////////////////////////
/////comment///////////////
if(isset($_POST['comment_D_ID'])){
	$commentID = $_POST['comment_D_ID'];
	$sql = "update comment set noti = 3 WHERE commentID = $commentID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
}
if(isset($_POST['reply_D_ID'])){
	$replyID = $_POST['reply_D_ID'];
	$sql = "update comment_reply set noti = 3 WHERE replyID = $replyID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
}
    