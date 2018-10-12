<?php
require '../database/db.php';
if(isset($_SESSION['userID'])){
	require '../notification/live_noti.php';
$userID = $_SESSION['userID'];
	//get data from database
$sql = " SELECT * FROM users WHERE userID = '$userID' ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$your = $stmt->fetch(PDO::FETCH_ASSOC);
$food_id = $your['food_id_json'];
$food_id = explode(" ", $food_id);
$food_id = array_filter($food_id);

$check = count($food_id);
$food_id = implode(",", $food_id);

if($check > 0){

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$result_per_page = 5; 
$this_page_first_result = ($page-1)*$result_per_page;
$number_of_page = ceil($check/$result_per_page);    

$sql = " SELECT * FROM food, users WHERE food.userID = users.userID AND foodID in ($food_id) LIMIT $this_page_first_result, $result_per_page";
$stmt = $dbh->prepare($sql);
$stmt->execute();


echo 'Number of Recipes:'. $check;

echo '<br><br>'; 

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<div class='menu1' id='wrapper_".$row['foodID']."' style='height:200px; margin-bottom:30px;width:60%;'>";
	echo "<img src='". $row['foodimage']. "' width=240 height=180 style='float:left;'/>";
	echo "<a href='../food_search/food_detail.php?foodID=". $row['foodID']. "' id='menulist-n'>". $row['foodname']. "</a>";
	echo "<br>";
	echo "<a href='../other_food/?userID=".$row['userID']."'>".$row['username']."</a>";
	require '../user_favourite/add_tofavor_infavorpage.php';
	echo "<p id='menu-1' style='width:500px;'>";
	$content = file_get_contents( $row['des']); 
	if (strlen($content) > 100){
		$content = substr($content,0,100). '...'; 
		echo $content;
	}else{
		echo $content;}
	echo "</p>"; // get the contents, and echo it out.
	echo "</div>";

	
}
for($page=1;$page<=$number_of_page;$page++){
echo '<a href="?&page='. $page.'" style="text-decoration: none;">'.$page.'</a>';
}
}else{echo 'No saved recipe.';}
}else{
	header ('Location: ../home');
}
?>
