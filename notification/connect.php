<?php
session_start(); 
require "../database/db.php";
////////////////////////////
/////comment///////////////
if(isset($_POST['comment_ID'])){
	$commentID = $_POST['comment_ID'];
	$sql = "update comment set noti = 0 WHERE commentID = $commentID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
}
if(isset($_POST['reply_ID'])){
	$replyID = $_POST['reply_ID'];
	$sql = "update comment_reply set noti = 0 WHERE replyID = $replyID";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
}
    