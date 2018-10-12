<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	 $(".noti_box").hide();
	jQuery('.tabs .tab_links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery(currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
	$(".link_com").click(function(){
		var commentID = $(this).attr('value');
		$.post('../notification/connect.php', { comment_ID: commentID});
	});  
	$(".link_re").click(function(){
		var replyID = $(this).attr('value');
		$.post('../notification/connect.php', { reply_ID: replyID});
	}); 
});

var what = 1;
 $("body").on("click","#notifi",function(){
	if(what == 1){
		$(".noti_box").fadeIn(200);
		what = 2;
	}else{
		$(".noti_box").fadeOut(200);
		what = 1; 
	 } 
 }); 

</script>
<style>
#show_noti{
	top: 10px;
	position: fixed; 
	right: 10px;
	z-index: 1; 
}
#notifi{
	//float: right;
	//color: red;
	top: 10px;
	position: fixed; 
	right: 10px;
	z-index: 100; 
	width:50px;	
}
#noti_icon{ 
	float: right;
	width:100%;
} 
.noti_box{
	//position: relative;
	z-index: 100; 
	position: fixed;
	top:65px;
	right: 14px;
	background-color: white;
	width: 400px;
} 
.noti_box::before { 
    content: "";
    position: absolute;
	bottom: 100%; 
	right: 14px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent white transparent;
}
.noti_box a{
	text-decoration: none;
	color: black;
} 
.noti_box a:hover{
	color: green;
} 
#numofnoti{
	background-color: white;
	border-radius: 50%;
	//position: relative;
	z-index: 100; 
	position: fixed;
	right: 60px;
}
.tabs{
	display: inline-block;
} 
.tab_links{
	display: inline;
} 
.tab_links li{
	float: left;
	margin-left: 50px;
	list-style:none;
}

li.active a{
	color: red; 
}
#new_comment{

}
#reply_your_comment{


}
.tab {
    display:none;
}
 
.tab.active {
    display:block;
} 
</style>
<?php
if(isset($_SESSION['userID'])){ 
require "../database/db.php";
	$userID = $_SESSION['userID'];
	$sql = "SELECT * FROM comment,users,food WHERE comment.userID = users.userID AND comment.foodID = food.foodID AND (comment.noti = 1 AND comment.food_user_ID = $userID)";
	$stmt=$dbh->prepare($sql); 
	$stmt->execute();
	$check = $stmt->rowCount();  
	$sql1 = "SELECT * FROM comment_reply, users, food WHERE comment_reply.re_userID = users.userID AND comment_reply.foodID = food.foodID AND (comment_reply.noti = 1 AND comment_reply.comment_user_ID = $userID)";
	$stmt1=$dbh->prepare($sql1); 
	$stmt1->execute();
	$check1 = $stmt1->rowCount();  
	$all_check = $check+$check1; 
	echo "<div id='notifi'><img id='noti_icon' src='../images/noti_icon.png'><span id='numofnoti'>". $all_check . "</span></div>";
?> 
	<div class='noti_box' style='display:none;'>
		<div class="tabs">
			<ul class="tab_links">

			
				<li class="active"><a href="#new_comment">New comments <?php echo $check;?></a></li>
				<li><a href="#reply_your_comment">Reply comments <?php echo $check1;?></a></li>
					

			</ul>
		</div>
		<div class="noti_content">
			<div id='new_comment' class="tab active"> 
		<?php
		$num_com = 0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$num_com++;
			echo "<a class='link_com' value='".$row['commentID']."' href='../food_search/food_detail.php?foodID=".$row['foodID']."#message_".$row['commentID']."'>";
			$name = $row['username'];
			if (strlen($name) > 10){ 
				$name = substr($name,0,10). '...';
				echo $name;
			}else{
				echo $name; 
			}  
			echo " commented on : "; 
			$foodname = $row['foodname'];
			if (strlen($foodname) > 20){
				$foodname = substr($foodname,0,20). '...';
				echo $foodname;
			}else{
				echo $foodname; 
			} 
			echo "</a>";
			echo "<br>"; 
		}
		?>
			</div> 
			<div id='reply_your_comment' class="tab">
		<?php
		$num_re = 0;
		while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
			$num_re++;
			echo "<a  class='link_re' value='".$row['replyID']."' href='../food_search/food_detail.php?foodID=".$row['foodID']."#reply_message_".$row['replyID']."'>";
			$name = $row['username'];
			if (strlen($name) > 10){ 
				$name = substr($name,0,10). '...';
				echo $name;
			}else{
				echo $name; 
			}   
			echo " replied on : ";
			$foodname = $row['foodname'];
			if (strlen($foodname) > 20){
				$foodname = substr($foodname,0,20). '...';
				echo $foodname;
			}else{
				echo $foodname; 
			}  
			echo "</a>";
			echo "<br>"; 
		}
		?>  
			</div>
		</div> 
	</div>
<script>
$(document).ready(function(){

});

</script>
<?php
}else{ 
	
}
?>