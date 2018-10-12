<?php
require '../database/db.php';

$sql = 'SELECT * FROM food ORDER BY foodID DESC LIMIT 5';
$stmt= $dbh->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<div class='mySlides'>";
	echo "<img src='". $row['foodimage'] ."' value='". $row['foodname'] ."' width='640' height='480'>";
	echo nl2br("\n"); 
	$ingrestr = file_get_contents($row['ingreID_json']);
	$ingrejson = json_decode($ingrestr, true);
	if(!empty($ingrejson)){
		foreach($ingrejson as $field => $value){
			$sql = "SELECT ingreimage, ingrename FROM ingredient WHERE ingreID = '$value'";
			$stmt2 = $dbh->prepare($sql);
			$stmt2->execute();
			$ingre = $stmt2->fetch(PDO::FETCH_ASSOC);
			echo "<img src='../images/".$ingre['ingreimage']."' value='".$ingre['ingrename']."' style='border-radius: 50%;' height='100' width='100'>";
		} 
	} 
	echo "</div>";
}

?>