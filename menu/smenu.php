<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
var ohh = 1;
 $("body").on("click","#smenu",function(){
	if(ohh == 1){
		$(".showmenu").fadeIn(200);
		ohh = 2;
	}else{
		$(".showmenu").fadeOut(200);
		ohh = 1; 
	 } 
 }); 
</script>
<style>
#smenu{
	top: 10px;
	position: fixed; 
	left: 10px;
	z-index: 100; 
	width:12%;
}
.showmenu{
	display: none;
	z-index: 100; 
	background-color: lightblue;
	position: fixed;
	top: 9%;
	width: 70%;
	height: 100%;
	text-align: center;
}	
.showmenu button{
	width: 25%;
	height: 25px;
}



</style>


<img id="smenu" src="../images/menubt.png">
<div class="showmenu">
<?php
	if(isset($_SESSION['logged_in'])){ 
		if($_SESSION['logged_in'] == true){
			require('../regist/profile.php');
			echo "<br>"; 
			echo "<a href='../home'>Home</a>";
			echo "<br>"; 
			echo "<a class='linkit' href='../upload/'>Upload Recipe!</a>";
			echo "<br>";
			echo "<a class='linkit' href='../my_food/'>My Recipes</a>";
			echo "<br>";
			echo "<a class='linkit' href='../user_favourite/'>My Favourite</a>";
			echo "<br>";
			echo "<a class='linkit' href='../help_html/'>Inquiry</a>";
			echo "<br>"; 
			require '../notification/index.php';
		}else{
			echo "<a href='../'>Home</a>";
			echo "<br>"; 
			require('../regist/signin.php');
			echo "<a class='linkit' href='../help_html/'>Inquiry</a>";
		}
	}else{ 
		echo "<a href='../'>Home</a>";
		echo "<br>"; 
		require('../regist/signin.php');
		echo "<a class='linkit' href='../help_html/'>Inquiry</a>";
	} 
?>
</div>
