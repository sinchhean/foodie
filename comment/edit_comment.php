<?php
session_start(); 
////////////////////////////////////
//////////////comment edit//////////
require "../database/db.php";
if(isset($_POST['commentID'])){
	$commentID = $_POST['commentID'];
	$text = htmlspecialchars($_POST['text']);
	$sql = "UPDATE comment SET text = '$text' WHERE commentID = $commentID";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){} 
	else{ 
		echo '<script language="javascript">';
		echo 'alert("Failed to Update")';
		echo '</script>'; 
	}
} 
////////////////////////////////////
/////////reply edit////////////////
if(isset($_POST['replyID'])){
	$replyID = $_POST['replyID'];
	$text = htmlspecialchars($_POST['text']);
	$sql = "UPDATE comment_reply SET text = '$text' WHERE replyID = $replyID";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){} 
	else{ 
		echo '<script language="javascript">';
		echo 'alert("Failed to Update")';
		echo '</script>'; 
	}
} 

?>