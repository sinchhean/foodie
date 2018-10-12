
<?php
require '../database/db.php';
if(isset($_SESSION['userID'])){
	require '../notification/live_noti.php';
	/////////////////
	///user own page
	/////////////////
	////////////////
$userID = $_SESSION['userID'];
	//get data from database
$sql = " SELECT * FROM food WHERE userID = '$userID' ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$check = $stmt->rowCount();

if($check > 0){

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$result_per_page = 5;
$this_page_first_result = ($page-1)*$result_per_page;
$number_of_page = ceil($check/$result_per_page);
$sql = " SELECT * FROM food WHERE userID = '$userID' LIMIT $this_page_first_result, $result_per_page";
$sql1 = " SELECT * FROM food WHERE userID = '$userID'";
$stmt = $dbh->prepare($sql);
$stmt1 = $dbh->prepare($sql1);
$stmt->execute();
$stmt1->execute();
$check = $stmt1->rowCount();

echo 'Number of Recipes:'. $check;

echo '<br><br>'; 

//$foodID_arr = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	//array_push($foodID_arr, $row['foodID']);
	echo "<div class='menu1' style='height:200px; margin-bottom:30px;'>";
	echo "<img src='". $row['foodimage']. "' width=240 height=180 style='float:left;'/>";
	echo "<a href='../food_search/food_detail.php?foodID=". $row['foodID']. "' id='menulist-n'>". $row['foodname']. "</a>";
	echo "<p id='menu-1' style='width:800px;'>";
	$content = file_get_contents( $row['des']); 
	if (strlen($content) > 100){
		$content = substr($content,0,100). '...'; 
		echo $content;
	}else{
		echo $content;}
	echo "<style>
		.yours{
		display: inline-block;
		//height: 20px;
		background-color:Coral;   
		color: Black ;		
		border: 1px solid white; 
		text-decoration: none; 
		}
		.yours:hover{
			background-color:Brown;  
		}
		</style>";
	echo "</p>"; // get the contents, and echo it out.
	
	
	echo "<a class='yours' href='../my_food/editmyfood.php?efoodID=". $row['foodID'] ."'>Edit</a>";
	echo '<br>';
	echo "<a class='yours' href='../my_food/?defoodID=". $row['foodID'] ."'>Delete</a>";
	echo "</div>";
	
}
for($page=1;$page<=$number_of_page;$page++){
echo '<a href="?&page='. $page.'" style="text-decoration: none;">'.$page.'</a>';
}
}else{echo 'no upload food.';} 
}else{
	header ('Location: ../home');
} 
if(isset($_GET["defoodID"])){
	?>
	<script>
	var defoodID = "<?php echo $_GET["defoodID"]; ?>";
	if (window.confirm("Are you sure?")){
		window.location.href = "delete.php?defoodID="+defoodID;  
		console.log(<?php echo $_GET["defoodID"];?>);
	}else{} 
	</script>  
<?php
} 
?>

