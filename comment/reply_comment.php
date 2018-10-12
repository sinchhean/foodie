

<?php
session_start(); 
require "../database/db.php";
if(isset($_POST['commentID']) && isset($_POST['reply_text'])){
	if(isset($_SESSION['userID'])){
		$userID = $_SESSION['userID'];
		$commentID = $_POST['commentID'];
		$foodID = $_POST['foodID'];
		$sql = "SELECT userID FROM comment WHERE commentID = $commentID ";
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch();
		$comment_user_ID = $row['userID']; 
		$reply_text = htmlspecialchars($_POST['reply_text']);
		if($userID == $comment_user_ID){
			$noti= 0;
		}else{$noti = 1;}  
		$sql = "INSERT INTO comment_reply (commentID,re_userID,text,noti,comment_user_ID,foodID) VALUES($commentID,$userID,'$reply_text',$noti,$comment_user_ID,$foodID)";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute()){
			$insert_id = $dbh->lastInsertId();
			echo "<div class='showreply' id='reply_message_" . $insert_id . "'>"; 
			echo "<p>". $_SESSION['username'] . "</p>";
			echo "<pre class='reply_message_text' id='".$insert_id."'>". $reply_text ."</pre>"; 
			echo "<button class='re_edit' name='edit' value='". $insert_id."'>Edit</button>";
			echo "<button class='re_delefro' name='delefro' value='". $insert_id."'>Delete</button>";
			echo "<button class='re_okay' id='re_okay_".$insert_id."' value='". $insert_id."' style='display: none;float: right;'>OK</button>";
			echo "<button class='re_cancel' id='re_cancel_".$insert_id."' value='". $insert_id."' style='display: none;float: right;'>Cancel</button>";
			echo "</div>";
			
		}
	}else{ 
		echo '<script language="javascript">';
		echo 'alert("please log in first!")';
		echo '</script>';
	}
}
?>