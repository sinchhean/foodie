<p><a href="../home"><img id="logo" src="../images/1.png" alt="foodbook"></a></p>
<style>
#logo{
	width: 95%;
	border-radius: 50%;
	
}
#logo:hover{
}
[id^="links"]{
	display: block;
	border: 1px solid white; 
	text-decoration: none;
	color: white;
	font-weight: bold;
}
[id^="links"]:hover{
	font-weight: bold;
	background:rgba(255, 0, 0, 0.5);
	font-size: 120%;
}

#links1{ 
	color: black;
	background-color: #FBBD52;
}
#links2{
	background-color: #E27A34;
}
#links3{
	background-color: #E27A34;
}
#links4{
	background-color: #E27A34;
}
#links5{
	background-color: #E27A34;
}
#links6{
	background-color: #E27A34;
}
</style> 
<?php
	if(isset($_SESSION['logged_in'])){ 
		if($_SESSION['logged_in'] == true){
			require('../regist/profile.php');
			echo "<br>"; 
			echo "<a id='links2' href='../upload/'>Upload Recipe!</a>";
			echo "<br>";
			echo "<a id='links3' href='../my_food/'>My Recipes</a>";
			echo "<br>";
			echo "<a id='links4' href='../user_favourite/'>My Favourite</a>";
			echo "<br>";
			echo "<a id='links5' href='../help_html/'>Inquiry</a>";
			echo "<br>"; 
			require '../notification/index.php';
			echo "<br><br><br>";
			echo "<a id='links1' href='../home/'>Home</a>";
		}else{
			require('../regist/signin.php');
			echo "<a id='links4' href='../help_html/'>Inquiry</a>";
			echo "<br><br><br>";
			echo "<a id='links1' href='../home/'>Home</a>";
		}
	}else{   
		require('../regist/signin.php');
		echo "<a id='links4' href='../help_html/'>Inquiry</a>";
		echo "<br><br><br>";
		echo "<a id='links1' href='../home/'>Home</a>";
	} 
?>