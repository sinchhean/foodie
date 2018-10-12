<?php
if(isset($_GET['foodID'])){
	require '../database/db.php';
	$foodID = $_GET['foodID'];
	$sql = "SELECT * FROM food WHERE foodID = '$foodID'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$foodname = $row['foodname'];
	$foodimage = $row['foodimage'];
	$des = $row['des'];
	$cooking = $row['cooking'];
	$ingre_all = $row['ingreID_json'];
	$filepath = $row['filepath'];
if(isset($_POST['submit'])){
	//name check
	$name = htmlspecialchars($_POST['name']);
	$namesearch = strtolower($name);
	//image check 
	$file = $_FILES['image'];
	$filename = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	if($filename){
			
		$fileExt = explode(".",$filename);
		$fileActualExt = strtolower(end($fileExt));
		
		$allowedExt = array("jpg", "jpeg", "png");
		
		if(in_array($fileActualExt,$allowedExt)){ 
			if($fileError === 0){
				if($fileSize < 5000000){			
					///image update
					
					if(file_exists($foodimage)){
						if(unlink($foodimage)){
							$fileimage_newname = $filepath.uniqid("",true).".".$fileActualExt;
							move_uploaded_file($fileTmpName, $fileimage_newname);
						}else{die("image update failed");}
					}else{die("image doesn't exit");}			
				}else{
					echo "Your file is too big!";
				}
			}else{
				echo "There is an error uploading the file!";
			}
		}else{
			echo "This type of file is not supported!";
		}
	}
	///ingredient update
	$ingre_new = $_POST['str'];
	if(unlink($ingre_all)){
		if(file_put_contents($ingre_all,$ingre_new)){}
		else{die('ingredient update failed');}
	}else{die('old ingredient file delete failed');}
					
	///description update
	//$description = htmlspecialchars($_POST['description']); 
	if(unlink($des)){
		file_put_contents($des,htmlspecialchars($_POST['description']));
	}else{die("desccription update failed");}

	///how to make update
	$list_array = array();
	$list = $_POST['list'];
	foreach($list as $row){
		array_push($list_array, $row);
	}
	$list_array_json = json_encode($list_array);
	if(unlink($cooking)){
		file_put_contents($cooking,$list_array_json);
	}else{die("cooking method update failed");}
					
	//update database			
	$sql = "UPDATE food SET foodname = '$name', foodnameeng = '$namesearch', ingre_string = '$ingre_new' WHERE foodID = '$foodID'";
	$stmt=$dbh->prepare($sql);
	if($stmt->execute()){
		echo "<script type='text/javascript'>alert('uploaded successfully!')</script>";
		header('Location: ../my_food/');
	}else{echo "failed to update";}
}else{echo "error no submitted form";}
}else{echo "error no foodID";}
?>