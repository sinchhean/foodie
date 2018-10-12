<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content"width=device-width, initial-scale=1" />
 	<link rel="stylesheet" href="../style/style1.css"/>
 	<link rel="icon" href="../images/1.ico" />
 	<title>foodie</title>
</head>
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
	<div class="right">
	<?php require '../notification/live_noti.php'; ?> 
	<div class="upper">
<?php  
require '../database/db.php';

if(isset($_GET['str'])){
	if($_GET['str'] != null){
	$gg = htmlentities($_GET['str']);
	$str = json_decode($_GET['str']);
	$allitem = '';
	if(isset($_GET['onlythese'])){
		$allitem = $allitem. "[";
		foreach($str as $item){
			$allitem = $allitem. '"'. $item . '",';
		}
		$allitem = rtrim($allitem,", ");
		$allitem = $allitem. "]";
	}else{
	foreach($str as $item){
		$allitem = $allitem.'%"'.$item . '"';
	}
	$allitem = $allitem.'%';    
	} 
	if(empty($str)){
	header('location:../index.php');
	}else{  
	if(isset($_GET['onlythese'])){  
	$sql = "SELECT * FROM food WHERE ingre_string = '$allitem'";
	}else{
	$sql = "SELECT * FROM food WHERE ingre_string LIKE '$allitem'";
	}
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount(); 
	$page = isset($_GET['page'])?(int)$_GET['page']:1;

	$result_per_page = 5;
	$this_page_first_result = ($page-1)*$result_per_page;
	$number_of_page = ceil($check/$result_per_page);
	
	$sql = "SELECT * FROM food, users WHERE food.userID = users.userID AND ingre_string LIKE '$allitem' LIMIT $this_page_first_result, $result_per_page";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount(); 
	
	require '../food_search/food_search.php';
    echo '</div>'; 
	?>
	<div style="font-size:300%;text-align:center;color: #61210B;">Search by Ingredients</div>
	<?php
    echo '<div class="menulist">';
    echo '<p style="font-size:150%;"> <a id="find"></a>';
	echo 'Number of foods found:<a id="many">'.$check.'</a></p>';
    echo '<br><br>';
	echo '<div class="try">';
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<div class = "menul"><img src="'.$row['foodimage'].'" width="240" height="180">';
	echo '<a href="../food_search/food_detail.php?foodID='.$row['foodID'].'" id="menulist-n">'.$row['foodname'].'</a><br><br>';
	echo '<a href="../other_food/?userID='.$row['userID'].'">'.$row['username'].'</a>';
	require '../user_favourite/add_tofavor.php';
	echo '<p id="menu-1" style="width:800px;">';
	$content = file_get_contents( $row['des']);
	if (strlen($content) > 100){
		$content = substr($content,0,100). '...'; echo $content;
	}else{echo $content;}
	echo '</p>';
	echo '</div>';
}  
for($page=1;$page<=$number_of_page;$page++){
	echo '<a href="?str='.$gg.'&page='.$page.'" style="text-decoration: none;">'.$page.'</a>';
 
}  
?> 
</div>
    </div>
</div>
</body> 
<?php 
		if($check == 0){
			echo 'no match';
		}else {
		  $cou = $check;
		} 
	}
	}else{
		include '../food_search/food_search.php';
		echo 'please enter what to search for';
	} 
}else{
	echo 'please enter what to search for';
	echo '<br>';
	echo '<a href="../">Home</a>';
}
 ?>

</html>