<?php
require '../database/db.php';
if(isset($_POST['getword'])){
$word = $_POST['getword'];
if($word == NULL){
}else{
    $sql = "SELECT * FROM ingredient WHERE ingrename LIKE '%$word%' OR ingrenamerom LIKE '%$word%' OR ingrenameeng LIKE '%$word%' OR ingrenamefuri LIKE '%$word%'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();
	if($check == 0){
		echo 'no match'; 
	}   
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<span class="explaw">';
		echo '<img onmouseover="showD(this.id)" onmouseout="unshowD(this.id)" onclick="myFunction(this.id)" src="../images/'.$row['ingreimage'].'" id="'.$row['ingreID'].'" alt="'.$row['ingrenameeng'].'<br>'. $row['ingrename'].'" width="100" height="100"/>';
		echo '<span id="expla'.$row['ingreID'].'" style="display:none;">'.$row['ingrenameeng'].'<br>'.$row['ingrename'].'</span>';
		echo '</span>';
	} 
} 
}
if(isset($_POST['getid'])){
	$getid = $_POST['getid'];
	$sql = "SELECT * FROM ingredient WHERE type = '$getid'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<span class="explaw">';
		echo '<img onmouseover="showD(this.id)" onmouseout="unshowD(this.id)" onclick="myFunction(this.id)" src="../images/'.$row['ingreimage'].'" id="'.$row['ingreID'].'" alt="'.$row['ingrenameeng'].'<br>'. $row['ingrename'].'" width="100" height="100"/>';
		echo '<span id="expla'. $row['ingreID'].'" style="display:none;">'.$row['ingrenameeng'].'<br>'.$row['ingrename'].'</span>';
		echo '</span>';

	}
}
