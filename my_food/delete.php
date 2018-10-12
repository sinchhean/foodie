<?php
session_start();
require '../database/db.php';
if(isset($_GET['defoodID'])){
	if(isset($_SESSION['userID'])){
	$defoodID = $_GET['defoodID'];
	///remove files
	
	$sql = "SELECT * FROM food WHERE foodID = '$defoodID'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$userID = $row["userID"];
	$foodimage = $row['foodimage'];
	$des = $row['des'];
	$cooking = $row['cooking'];
	$ingre = $row['ingreID_json'];
	$filepath = $row['filepath'];
	
	if($userID == $_SESSION['userID']){
	///delete from database
	$sql = "DELETE FROM comment_reply WHERE foodID = $defoodID";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){	
		$sql = "DELETE FROM comment WHERE foodID = $defoodID";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute()){
			$sql = "DELETE FROM food WHERE foodID = '$defoodID'";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			
		}else{}  
	}else{}
	
	unlink($foodimage);
	unlink($des);
	unlink($cooking);
	unlink($ingre);
	rmdir($filepath);
	

	header('Location: ../my_food/');
	}else{header('Location: ../my_food/');}
	}else{header('Location: ../my_food/');}
}else{echo "nope";}
?>