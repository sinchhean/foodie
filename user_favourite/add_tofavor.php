<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
	$('body').on('click','[name="addto"]',function(){
		var foodID;
		foodID = $(this).val();
		$.post('',{addto:foodID});
		$('#addto_'+foodID).hide();
		$('#delefro_'+foodID).show();
	});
	$('body').on('click','[name="delefro"]',function(){
		var foodID;
		foodID = $(this).val();
		$.post('',{delefro:foodID});
		$('#addto_'+foodID).show();
		$('#delefro_'+foodID).hide();
	});
</script>

<?php
if(isset($_SESSION['logged_in'])){
	if($_SESSION['logged_in'] == true){
		$userID = $_SESSION['userID'];
		$sql1 = "SELECT food_id_json FROM users WHERE userID = '$userID'";
		$stmt1 = $dbh->prepare($sql1);
		$stmt1->execute();
		$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$food_id_json = $row1['food_id_json'];
		$food_fav = explode(" ",$food_id_json);
		if(!in_array($row['foodID'], $food_fav)){
		//echo "<form action='' method='post'>";
		echo "<button name='addto' id='addto_". $row['foodID']."' value='". $row['foodID']."'>Add to favourite</button>";
		echo "<button name='delefro' id='delefro_". $row['foodID']."' value='". $row['foodID']."' style='display:none;'>Delete from favourite</button>";
		//echo "</form>"; 
		
		}else{
		//echo "<form action='' method='post'>";
		echo "<button name='addto' id='addto_". $row['foodID']."' value='". $row['foodID']."' style='display:none;'>Add to favourite</button>";
		echo "<button name='delefro' id='delefro_". $row['foodID']."' value='". $row['foodID']."'>Delete from favourite</button>";
		//echo "</form>";
	}
	}else{
	}
}else{ 
}


if(isset($_POST['addto'])){
	$addto = $_POST['addto'];
	$food_fav = $food_id_json;
	$food_fav = explode(" ",$food_fav);
	if(!in_array($addto, $food_fav)){
		array_push($food_fav, $addto);
	}
	$food_fav = implode(" ",$food_fav);
	$userID = $_SESSION['userID'];
	$sql = "UPDATE users SET food_id_json = '$food_fav' WHERE userID = '$userID'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
}
if(isset($_POST['delefro'])){
	$delefro = $_POST['delefro'];
	$food_fav = $food_id_json; 
	$food_fav = explode(" ",$food_fav);
	if (($key = array_search($delefro, $food_fav)) !== false) {
		unset($food_fav[$key]);
	}
	$food_fav = implode(" ",$food_fav);
	$userID = $_SESSION['userID'];
	$sql = "UPDATE users SET food_id_json = '$food_fav' WHERE userID = '$userID' ";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(); 
}
?>