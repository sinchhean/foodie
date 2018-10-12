<?php
require '../database/db.php';
	/////////////////////////////////
	////////////////////////////////
	////other users view the usesr page
	///////////////////////////////////
	/////////////////////////////////
	if(isset($_GET['userID'])){
		$otheruser = $_GET['userID'];
		$sql = "SELECT * FROM food WHERE userID = '$otheruser'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$check = $stmt->rowCount();
		if($check > 0){
			$page = isset($_GET['page'])?(int)$_GET['page']:1;

			$result_per_page = 5;
			$this_page_first_result = ($page-1)*$result_per_page;
			$number_of_page = ceil($check/$result_per_page);
			$sql = " SELECT * FROM food, users WHERE food.userID = '$otheruser' AND users.userID = food.userID LIMIT $this_page_first_result, $result_per_page";
			$stmt1 = $dbh->prepare($sql);
			$stmt1->execute();
			$username = $stmt1->fetch(PDO::FETCH_ASSOC);
			echo "<h2>". $username['username'] ."</h2>";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$check = $stmt->rowCount();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='menu1' style='height:200px; margin-bottom:30px;width:100%;'>";
				echo "<img src='". $row['foodimage']. "' width=240 height=180 style='float:left;'/>";
				echo "<a href='../food_search/food_detail.php?foodID=". $row['foodID']. "' id='menulist-n'>". $row['foodname']. "</a>";
				echo "<br>";
				require '../user_favourite/add_tofavor.php';
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
		}else{echo 'no such user';}
	}else{echo 'no userID';}
?>