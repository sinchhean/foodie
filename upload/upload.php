<?php
require '../database/db.php';
if(isset($_POST['submit'])){
	session_start();
	
	//name check
	$name = htmlspecialchars($_POST['name']);
	$namesearch = strtolower($name); 
	
	if(strlen($name)>30){
		header('location:http://foodie.cf:9090/upload/');
	}else{
	//image check  
		$email = $_SESSION['email']; //to add to user_mono file
		$file = $_FILES['image'];
		$filename = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		
		$fileExt = explode(".",$filename);
		$fileActualExt = strtolower(end($fileExt));
		
		$allowedExt = array("jpg", "jpeg", "png");
		
		if(in_array($fileActualExt,$allowedExt)){
			if($fileError === 0){
				if($fileSize < 50000000){
					//create a new folder for this upload food
					$number = 1;
					$number_string = (string)$number;
					while(file_exists("../user_mono/$email/$number_string")){
						$number++;
						$number_string = (string)$number;
					}
					//$number_string = (string)$number;
					if (!file_exists("../user_mono/$email/$number_string")) {
						mkdir("../user_mono/$email/$number_string", 0777, false);
					}
					
					$userID = $_SESSION['userID'];
					///image upload 
					$fileNameNew = uniqid("",true).".".$fileActualExt;
					$fileDest_img = '../user_mono/'.$email.'/'.$number_string.'/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDest_img);
					 
						///ingredients upload
					$str = $_POST['str']; 
					//sort($str);
					//ksort($str); 
					$ingreName = $userID."_".$number."_ingre.json";
					$fileDest_ingre = '../user_mono/'. $email. '/'. $number_string . '/' . $ingreName;
					file_put_contents($fileDest_ingre,$str);

					
						///description upload
					$description = htmlspecialchars($_POST['description']); 
					$desName = $userID."_".$number."_des.txt"; 
					$fileDest_des = '../user_mono/'. $email. '/'. $number_string . '/' . $desName;
					file_put_contents($fileDest_des,$description);
					 

					///how to make upload
					$list_array = array();
					$list = $_POST['list'];
					foreach($list as $row){
						array_push($list_array, $row);
					}
					$list_array_json = json_encode($list_array);
					$methodName = $userID."_".$number."_method.json"; 
					$fileDest_method = '../user_mono/'. $email. '/'. $number_string . '/' . $methodName;
					file_put_contents($fileDest_method,$list_array_json);
					
					//filepath for easy management
					$filepath = '../user_mono/'.$email.'/'.$number_string.'/';
					//upload to database
					
					 
					$sql = "INSERT INTO food (userID, foodimage, foodname, foodnameeng, des, cooking, ingreID_json, ingre_string, filepath) " . "VALUES ('$userID','$fileDest_img','$name', '$namesearch', '$fileDest_des', '$fileDest_method', '$fileDest_ingre', '$str', '$filepath')";
					$stmt=$dbh->prepare($sql);
					if($stmt->execute()){
					header('Location: ../my_food/');
					}else{echo "failed to upload to database";} 
					      
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
}
?>