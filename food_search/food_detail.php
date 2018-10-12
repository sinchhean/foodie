<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../style/style1.css"/>
	<link rel="stylesheet" href="../style/ingre_search.css"/>
	<link rel="icon" href="../images/1.ico" />
	<title>foodie</title>
</head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script>
  $(document).ready(function(){
    $('#sukusai').keyup(function(){
      var getword2 = $(this).val();
      $.post('sukusai.php', { getword: getword2 } ,
      function(result){
        $('#feedback1').html(result).show();
      });
    });
    });
	var showD = function(id){
		$('#expla'+id).css({'display':'block'});
	}
	var unshowD = function(id){
		$('#expla'+id).css({'display':'none'});
	}
  </script>
  <style>
  .right p{
	  font-size: 140%;
	  
  }
    .right li{
	  font-size: 140%;
  }
  </style>
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
<?php require '../food_search/food_search.php' ?>
			<div class='show'> 
<?php
if(isset($_GET['foodID'])){
	require '../database/db.php';
	$foodID = $_GET['foodID'];
	$sql = " SELECT * FROM food, users WHERE foodID = '$foodID' AND food.userID = users.userID ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo '<span style="font-size:200%;color: #61210B;" >';
	echo '<label>Name:</label>'. $row['foodname'];
	echo '</span>';
	echo '<br>';
	echo '<span style="font-size:150%;    color: #61210B;" >';
	echo "<label>Owner:</label><a href='../other_food/?userID=". $row['userID'] ."'>". $row['username'] . "</a>";
	require '../user_favourite/add_tofavor.php';
	echo '<br>';
	echo '</span>';

	
	echo "<img src='" . $row['foodimage'] . "' width='1000' height='750'>";
	echo '<br>';
	$ingrestr = file_get_contents($row['ingreID_json']);
	$ingrejson = json_decode($ingrestr, true); 
	if(!empty($ingrejson)){
		foreach($ingrejson as $field => $value){
			$sql = "SELECT * FROM ingredient WHERE ingreID = '$value'";
			$stmt = $dbh->prepare($sql); 
			$stmt->execute();
			$ingre = $stmt->fetch(PDO::FETCH_ASSOC); 
			echo '<span class="explaw">'; 
			echo "<img  id='".$ingre['ingreID']."' onmouseover='showD(this.id)' onmouseout='unshowD(this.id)' src='../images/".$ingre['ingreimage']."' value='".$ingre['ingrename']."' style='border-radius: 50%;' height='100' width='100'>";
			echo '<span id="expla'.$ingre['ingreID'].'" style="display:none;">'.$ingre['ingrenameeng'].'<br>'.$ingre['ingrename'].'</span>';
			echo '</span>';
		} 
	}
	echo '<p>' . file_get_contents( $row['des'] ) . '<p>';
	echo '<br>';
	echo '<br>'; 
	echo '<div class = "make" style = "text-align:center;">';
	echo '<h1>How to make it !  </h1>';
	
	echo '</div>';
	$str = file_get_contents($row['cooking']);
	$json = json_decode($str, true); // decode the JSON into an associative array
	//echo '<pre>' . print_r($json, true) . '</pre>';
	if(sizeof($json)==0){echo "Not Written";}else{
	echo '<ol>';
	foreach ($json as $field => $value) {
    // Use $field and $value here
	echo '<li>' . $value . '</li>';
	echo '<br>';
	echo '<hr>';
	echo '<br>';
	} 
	echo '</ol>';
	}
	$food_user_ID = $row['userID'];
}else{
	echo 'There is no such food.';
}
?>
			</div>
		</div>
		<div class="lower">
		<?php require '../comment/index.php'; ?>
		</div>
	</div>
</body>
</html>