<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content"width=device-width, initial-scale=1" />
 	<link rel="stylesheet" href="../style/style1.css"/>
 	<link rel="icon" href="../images/1.ico" />
 	<title>foodie</title>
</head>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script>
	$(document).ready(function(){
		$(".comment_change").click(function(){
			var comment_ID = $(this).attr('value');
			$.post('../notification/connect.php',{comment_ID:comment_ID});
		});	
		$(".comment_delete").click(function(){
			var comment_D_ID = $(this).attr('value');
			$.post('../notification/connect_delete.php',{comment_D_ID:comment_D_ID});
		});	
	}); 
 </script>
<body>
 
	<!--
	////////////////////////////////////////
	/////////////////////////////////////// 
	///////Menu Start///////////////////////////
	////////////////////////////////////
	-->
	<div class="menu">

<?php
session_start();
require '../menu/index.php';
?>
	</div>
	<div class="ssmenu">
	<?php
		require '../menu/smenu.php';
	?>
</div> 
		<!--
	/////////////Menu End///////////////////
	////////////////////////////////////////
	-->

	<div class="right" >
		<?php 
if(isset($_SESSION['userID'])){
?>
	<div style="font-size:300%;text-align:center;color: #61210B;">All Notifications</div>
	<div class="upper">
	<div class="top">
	<div class="connect">
		<a href="../notification/noti_manage_command.php" id = "connect_command">command</a>
		<a href="../notification/noti_manage_reply.php" id = "connect_reply">reply</a>
	</div>
	<br><br>
	<span style="display:inline-block;width:100px;font-weight:bold;">FROM</span>
	<span style="display:inline-block;width:300px;font-weight:bold;">TEXT       </span>
	<span style="font-weight:bold;">CHECK</span>
	<br><br><hr size=5 color=#ffa500><br>
	
	  
<?php 

require '../database/db.php';
	$userID = $_SESSION['userID'];
	$sql = "SELECT * FROM comment,users WHERE  comment.userID = users.userID AND food_user_ID = $userID order by noti DESC";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();
	$cnt = 0;
	
	
	if($check != 0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$fromID = $row['username'];
		if($row['noti'] != 3){
		echo '<div class = "manage_command">';
		echo '<tr>';
		echo '<td>';
		echo '<span style="display:inline-block;width:100px;font-weight:bold;color:#8b0000;">';
		echo $fromID;
		echo '</span>';
		echo '</td>';
		echo '<td>';
		echo '<span style="display:inline-block;width:300px;"><a style="text-decoration:none;" class="comment_change" value="',$row['commentID'],'" href="../food_search/food_detail.php?foodID=',$row['foodID'],'#message_',$row['commentID'],'" id="manege_command_info" >';
		$text = $row['text']; 
		if (strlen($text) > 20){
			$text = substr($text,0,20). '...'; 
			echo $text;}
			else{echo $text; }  
		echo '</a>';  
		echo '</span>';
		echo '</td>';
		echo '<td>';
		if ($row['noti']==1){ 
			echo '<span style="display:inline-block;width:200px;color:red;">';
			echo 'not read';
			echo '</span>';
		}else{
			echo '<span style="display:inline-block;width:200px;">';
			echo 'readed';
			echo '</span>';
		} 
		echo '</td>';
		echo '<td>'; 
		echo '<span style="display:inline-block;width:300px;"><a href="../notification/noti_manage_command.php" style="text-decoration:none;" class="comment_delete" value="',$row['commentID'],'">delete</span></a>';
		echo '</td>'; 
		echo '</tr>'; 
		echo '</div>';
		echo '<br>';
		echo '<hr>';
		echo '<br>';
		$cnt = $cnt +1 ;
		}		 
	}
	}
	if ($cnt == 0 )
	{echo 'there is no message';}
	
	
?> 
	</div>
    </div>
<?php }
else{header('Location:../home');
}
?>
</body>



 



</html>
