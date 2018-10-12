
<style>
pre{
	font-size:130%;
}
.comment{
	width: 1000px;
	min-height: 100px;
	
} 
.comment textarea{ 
	width: 100%;
	resize: none;
	    
}
.comment button{
	font-size: 100%;
	width: 80px;
	height: 22px;
}
.showcomment button{
	font-size: 100%;
	width: 80px;
	height: 22px;
}
textarea{
	font-size: 130%;
	width: 100%;
	min-height: 50px;
	resize: none;
}
.showcomment_wrap{
	max-width: 500px;
}
.showcomment{
	margin-bottom: 20px;
	width: 1000px;
	min-height: 110px; 
	height: auto; 
	background: lightblue;
	overflow: auto;
	border: 1px black solid;
}
.showreply_wrap{
	//background: lightgreen;
	
}
.showreply{
	margin-left: 100px;
}
</style> 
   <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script>
$(document).ready(function(){
		///////////////////////////////////////////
	/////////automatically increase the height of the textarea/////////////////
	autosize(document.getElementsByTagName("textarea")); 
	
	
	$("#comment").attr('disabled','disabled');
	$("#mycomment").keyup(function(){
		if(!$.trim($(this).val())){$("#comment").attr('disabled','disabled');}
		else{
		$("#comment").removeAttr('disabled');
		}
	});
	$("#comment").click(function(){ 
		var comment;
		var foodID;
		comment = $("#mycomment").val(); 
		food_user_ID = $("#food_user_ID").val();
		foodID = $("#foodID").val(); 
		$.post('../comment/up_comment.php', { comment: comment, foodID : foodID ,food_user_ID : food_user_ID} ,
		function(result){
        $('.showcomment_wrap').prepend(result);
		});
		$(".comment").fadeOut(200, function(){
			$("#mycomment").val("");
			$(".comment").fadeIn().delay(200);
 
        }); 
	});
	$("body").on("click",".delefro",function(){
		var commentID;
		foodID = $("#foodID").val(); 
		commentID = $(this).val();
		if(confirm("Do you really want to delete this comment?")){ 
			$("#message_"+commentID).fadeOut(800);
			$.post('../comment/delete_comment.php', {commentID: commentID},
			function(result){
				$(".showfeedback").html(result).show();
			}); 
		}
	});	
	$("body").on("click",".edit",function(){
		var commentID;
		commentID = $(this).val();
		var text;
		var newtext;
		text = $("#"+commentID).text();
		newtext = $("#"+commentID).val();
		$("#"+commentID).replaceWith("<textarea required class='message_text' id='"+commentID+"'value=''>"+text+"</textarea>");
		$("#okay_"+commentID).show(); 
		$("#cancel_"+commentID).show(); 
		$("#okay_"+commentID).attr('disabled','disabled');
		$("#"+commentID).keyup(function(){
			newtext = $("#"+commentID).val();
			if(!$.trim($(this).val()) || text == newtext ){$("#okay_"+commentID).attr('disabled','disabled');}else{
				$("#okay_"+commentID).removeAttr('disabled');
			}
		});
    });
	

	$("body").on("click",".okay",function(){
		var commentID;
		commentID = $(this).val();
		var text; 
		text = $("#"+commentID).val();
		$("#"+commentID).replaceWith("<pre id='"+commentID+"'>"+text+"</pre>");
		$.post('../comment/edit_comment.php',{commentID:commentID,text:text},
			function(result){
				$(".showfeedback").html(result).show();
		});
		$("#okay_"+commentID).hide();
		$("#cancel_"+commentID).hide();
	});	
	$("body").on("click",".cancel",function(){
		var commentID;
		commentID = $(this).val();
		var text; 
		text = $("#"+commentID).text(); 
		$("#"+commentID).replaceWith("<pre id='"+commentID+"'>"+text+"</pre>");
		$("#okay_"+commentID).hide();
		$("#cancel_"+commentID).hide();
	});	
	/////////////////////////////////////
	////////////////////////////////////
	////////reply//////////////////////
	//////////////////////////////////
	$("body").on("click",".reply",function(){ 
		var commentID; 
		commentID = $(this).val();
		$("#reply_comment_"+commentID).fadeIn().delay(500);
		$("body").on("keyup",".reply_text",function(){
			if(!$.trim($("#reply_text_"+commentID).val())){$("#reply_ok_"+commentID).attr('disabled','disabled');}else{
				$("#reply_ok_"+commentID).removeAttr('disabled');
			}
		});
	});

	$("body").on("click",".reply_cancel",function(){
		var commentID; 
		commentID = $(this).val();
		$("#reply_comment_"+commentID).hide();
	});
	$("body").on("click",".reply_ok",function(){
		var commentID; 
		var reply_text;
		var foodID;
		foodID = $("#foodID").val(); 
		commentID = $(this).val();
		reply_text = $("#reply_text_"+commentID).val();
		$.post("../comment/reply_comment.php",{commentID:commentID,reply_text:reply_text,foodID : foodID},
		function(result){
			$('#message_'+commentID+' .showreply_wrap').prepend(result);
		});
		$('#reply_text_'+commentID).val("");
		$('#reply_comment_'+commentID).fadeOut(800);
	});
	$("body").on("click",".re_delefro",function(){
		var replyID;
		replyID = $(this).val();
		if(confirm("Do you really want to delete this reply comment?")){ 
			$("#reply_message_"+replyID).fadeOut(800);
			$.post('../comment/delete_comment.php', {replyID: replyID},
			function(result){
				$(".showfeedback").html(result).show();
			}); 
		}
	});
	$("body").on("click",".re_edit",function(){
		var replyID;
		replyID = $(this).val();
		var text;
		var newtext;
		text = $("#"+replyID).text();
		newtext = $("#"+replyID).val();
		$("#"+replyID).replaceWith("<textarea required class='reply_message_text' id='"+replyID+"'value=''>"+text+"</textarea>");
		$("#re_okay_"+replyID).show(); 
		$("#re_cancel_"+replyID).show(); 
		$("#re_okay_"+replyID).attr('disabled','disabled');
		$("#"+replyID).keyup(function(){
			newtext = $("#"+replyID).val();
			if(!$.trim($(this).val()) || text == newtext ){$("#re_okay_"+replyID).attr('disabled','disabled');}else{
				$("#re_okay_"+replyID).removeAttr('disabled');
			}
		});
    });
	$("body").on("click",".re_okay",function(){
		var replyID;
		replyID = $(this).val();
		var text; 
		text = $("#"+replyID).val();
		$("#"+replyID).replaceWith("<pre id='"+replyID+"'>"+text+"</pre>");
		$.post('../comment/edit_comment.php',{replyID:replyID,text:text},
			function(result){
				$(".showfeedback").html(result).show();
		});
		$("#re_okay_"+replyID).hide();
		$("#re_cancel_"+replyID).hide();
	});	
	$("body").on("click",".re_cancel",function(){
		var replyID;
		replyID = $(this).val();
		var text; 
		text = $("#"+replyID).text(); 
		$("#"+replyID).replaceWith("<pre id='"+replyID+"'>"+text+"</pre>");
		$("#re_okay_"+replyID).hide();
		$("#re_cancel_"+replyID).hide();
	});
})  
  
</script> 
<h1 style="font-size:200%;text-align:center;">Comments</h1>
<div class="showfeedback"></div>
			<div class="comment"> 
					<input id="foodID" type="hidden" value="<?php echo $foodID; ?>" name="foodID" >
					<input id="food_user_ID" type="hidden" value="<?php echo $food_user_ID; ?>" name="food_user_ID" >
					<textarea name="mycomment" placeholder="comment" id="mycomment"></textarea>
					<button id="comment">comment</button>
			</div>
			<br> 
<?php
	$sql = "SELECT users.userID AS userID, users.username AS username,
			comment.commentID AS commentID, comment.text AS text
			FROM users, comment WHERE comment.userID = users.userID 
			AND comment.foodID = $foodID ORDER BY comment.commentID DESC";
	$stmt=$dbh->prepare($sql); 
	$stmt->execute();  
	$check = $stmt->rowCount();
	echo "<div class='showcomment_wrap'>";
	if($check > 0){  
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='showcomment' id='message_".$row['commentID']."'> ";
			echo "<p>". $row['username'] . "</p>";  
			echo "<pre class='message_text' id='".$row['commentID']."'>". $row['text']. "</pre>";
			if(isset($_SESSION['logged_in'])){ 
				if($_SESSION['userID'] == $row['userID']){
					echo "<button class='edit' name='edit' value='". $row['commentID']."'>Edit</button>";
					echo "<button class='delefro' name='delefro' value='". $row['commentID']."'>Delete</button>";
					echo "<button class='cancel' id='cancel_".$row['commentID']."' value='". $row['commentID']."' style='display: none;float: right;'>Cancel</button>";
					echo "<button class='okay' id='okay_".$row['commentID']."' value='". $row['commentID']."' style='display: none;float: right;'>Ok</button>";
				} 
			}
			echo "<button class='reply' id='reply_".$row['commentID']."' value='". $row['commentID']."' >Reply</button>";
			
			echo "<div class='reply_comment' id='reply_comment_".$row['commentID']."' style='display: none;'>";
			echo "<textarea class='reply_text' id='reply_text_".$row['commentID']."'></textarea>";
			echo "<button class='reply_cancel' id='reply_cancel_".$row['commentID']."' value='". $row['commentID']."'>Cancel</button>";
			echo "<button class='reply_ok' id='reply_ok_".$row['commentID']."' value='". $row['commentID']."' disabled >Ok</button>";
			echo "</div>";
			$commentID = $row['commentID'];
			$sql1 = "SELECT comment_reply.re_userID AS re_userID, comment_reply.text AS re_text,
					users.username AS re_username, comment_reply.replyID AS replyID
					FROM comment_reply, users 
					WHERE comment_reply.re_userID = users.userID AND comment_reply.commentID = $commentID
					ORDER BY comment_reply.replyID DESC";
			$stmt1=$dbh->prepare($sql1);
			$stmt1->execute();
			$check1 = $stmt->rowCount();
			echo "<hr style='background-color: blue;'>"; 
			echo "<div class='showreply_wrap'>";
			if($check1>0){
				while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
					
					echo "<div class='showreply' id='reply_message_".$row1['replyID']."'>";
					echo "<p>". $row1['re_username']."</p>";
					echo "<pre class='reply_message_text' id='".$row1['replyID']."'>". $row1['re_text']. "</pre>";	
					if(isset($_SESSION['logged_in'])){ 
						if($_SESSION['userID'] == $row1['re_userID']){
							echo "<button class='re_edit' name='edit' value='". $row1['replyID']."'>Edit</button>";
							echo "<button class='re_delefro' name='delefro' value='". $row1['replyID']."'>Delete</button>";
							echo "<button class='re_cancel' id='re_cancel_".$row1['replyID']."' value='". $row1['replyID']."' style='display: none;float: right;'>Cancel</button>";
							echo "<button class='re_okay' id='re_okay_".$row1['replyID']."' value='". $row1['replyID']."' style='display: none;float: right;'>Ok</button>";
						} 
					}
					echo "</div>";
				}
			}
			echo "</div>";
			echo "</div>";
		}
	}

	echo "</div>";
?>
				
