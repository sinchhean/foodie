<?php
session_start(); 
require "../database/db.php";
 
if(isset($_POST['comment'])){
	if(isset($_SESSION['userID'])){
		$userID = $_SESSION['userID'];
		$food_user_ID = $_POST['food_user_ID'];
		$foodID = $_POST['foodID'];
		$text = htmlspecialchars($_POST['comment']); 
		//str_replace(array("\r\n","\r","\n"),'<br>',$text);  
		if($userID == $food_user_ID){
			$noti= 0;
		}else{$noti = 1;}  
		$sql = "INSERT INTO comment (foodID,userID,text,noti,food_user_ID) VALUES ($foodID,$userID,'$text',$noti,$food_user_ID)";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute()){
			$insert_id = $dbh->lastInsertId(); 
			echo "<div class='showcomment' id='message_" . $insert_id . "'>";
			echo "<p>". $_SESSION['username'] . "</p>";
			echo "<pre class='message_text' id='".$insert_id."'>". $text ."</pre>"; 
			echo "<button class='edit' name='edit' value='". $insert_id."'>Edit</button>";
			echo "<button class='delefro' name='delefro' value='". $insert_id."'>Delete</button>";
			echo "<button class='okay' id='okay_".$insert_id."' value='". $insert_id."' style='display: none;float: right;'>OK</button>";
			echo "<button class='cancel' id='cancel_".$insert_id."' value='". $insert_id."' style='display: none;float: right;'>Cancel</button>";
			echo "<button class='reply' id='reply_".$insert_id."' value='".$insert_id."' >Reply</button>";
			echo "<div class='reply_comment' id='reply_comment_".$insert_id."' style='display: none;'>";
			echo "<textarea class='reply_text' id='reply_text_".$insert_id."'></textarea>";
			echo "<button class='reply_cancel' id='reply_cancel_".$insert_id."' value='".$insert_id."'>Cancel</button>";
			echo "<button class='reply_ok' id='reply_ok_".$insert_id."' value='".$insert_id."' disabled >Ok</button>";
			echo "</div>";
			echo "<div class='showreply_wrap'>";
			echo "</div>";
			echo "</div>";
		}else{  
		
			echo '<script language="javascript">';
			echo 'alert("There is some problem with server!")';
			echo '</script>'; 
		} 
	}else{ 
		echo '<script language="javascript">';
		echo 'alert("please log in first!")';
		echo '</script>';
	}
	
} 
?>