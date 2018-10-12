<?php
session_start(); 
require "../database/db.php";
////////////////////////////
/////comment delete///////////////
if(isset($_POST['commentID'])){
	$commentID = $_POST['commentID'];
	$sql = "DELETE FROM comment_reply WHERE commentID = $commentID";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){	
		$sql = "DELETE FROM comment WHERE commentID = $commentID";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Successfully Deleted")';
			echo '</script>'; 
		}else{
			echo '<script language="javascript">';
			echo 'alert("Failed to Delete")';
			echo '</script>'; 
		}
	}
}

////////////////////////////// 
/////////reply delete/////////
if(isset($_POST['replyID'])){
	$replyID = $_POST['replyID'];
	$sql = "DELETE FROM comment_reply WHERE replyID = $replyID";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){
		echo '<script language="javascript">';
		echo 'alert("Successfully Deleted")';
		echo '</script>'; 
	}else{
		echo '<script language="javascript">';
		echo 'alert("Failed to Delete")';
		echo '</script>'; 
	}
}
?>