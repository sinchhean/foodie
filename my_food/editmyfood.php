
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../style/style1.css"/>
	<link rel="icon" href="../images/1.ico" />
	<title>foodie</title>
</head> 

<body>
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
<div class="right">
<?php

if(isset($_SESSION['userID'])){ 
if(isset($_GET['efoodID'])){	
	require '../database/db.php';
	$foodID = $_GET['efoodID'];
	$sql = "SELECT * FROM food WHERE foodID = '$foodID'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$foodname = $row['foodname'];
	$foodimage = $row['foodimage'];
	$des = $row['des'];
	$cooking = $row['cooking'];
	$ingre_all = $row['ingreID_json'];

?>
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="../upload/jquery.uploadPreview.js"></script>
<script>
		var getingre = [];
		var getingre_array;
		var num_of_ingre = 0;
$(document).ready(function(){
	
	////////////////////////////////////
	/////////automatically increase the height of the textarea/////////////////
	autosize(document.getElementsByTagName("textarea")); 	
	
	
	
	$.getJSON('<?php echo $cooking; ?>', function(data){
		if(data.length == 0){$("#method").append("<li><textarea required name='list[]'></textarea></li>");}
		else{
			$.each(data, function(i,val){ 
				var item = "<li><textarea required name='list[]'>"+ val +"</textarea></li>";
				$("#method").append(item);
			});
		} 
			////////////////////////////////////
	/////////automatically increase the height of the textarea/////////////////
	autosize(document.getElementsByTagName("textarea")); 	
	});
	
	$.getJSON('<?php echo $ingre_all; ?>', function(data){
		$.each(data, function(i, val){
			num_of_ingre++;
			getingre.push(val);
			getingre_array = JSON.stringify(getingre);
			$('#str').val(getingre_array);
		});
	});


	$('#add').click(function(){
		$('#method').append('<li><textarea required name="list[]"></textarea></li>');
	});  
	$('#delete').click(function(){
		$('#method li:last-child').remove();
	});    
	
	$('#sukusai').keyup(function(){
		var getword2 = $(this).val();
		$.post('../ingre_search/sukusai.php', { getword: getword2 } , 
		function(result){
        $('#feedback1').html(result).show();
		$('#feedback1').append("<br><br><br><br>"); 
      });
    });
	$('#hideshow').click(function(){
		$('.show_choice').toggle(200);
	});
	$.uploadPreview({
		input_field: "#image-upload",   // Default: .image-upload
		preview_box: "#image-preview",  // Default: .image-preview
		label_field: "#image-label",    // Default: .image-label
		label_default: "Choose File",   // Default: Choose File
		label_selected: "Change File",  // Default: Change File
		no_label: false                 // Default: false
	});
});

	var myFunction = function(id){
		var source = $('#feedback1 #'+id).attr('src');
		var alt = $('#feedback1 #'+id).attr('alt');
		if($('#feedback2 #a'+id).length == 0){
		$('#feedback2').append("<span class='explaw2' id='a"+id+"'><img onmouseover='showD(this.id)' onmouseout='unshowD(this.id)'  class='help' name='ingretofood[]' onclick='deleteit(this.id)' id='a"+id+"'  style='border: solid black 1px;' src='"+source+"' width='100' height='100'><span id='explaa"+id+"' style='display:none;'>"+alt+"</span></span><img  id='a"+id+"plus' src='../images/foodgroups/plus.png' width='20' height='20'>");  
		getingre.push(id);
		getingre.sort(function(a, b) { 
			return a - b;
		}); 
		getingre_array = JSON.stringify(getingre);
		$('#str').val(getingre_array);
		}else{}
	}
	
	var showD = function(id){
		$('#expla'+id).css({'display':'block'});
	}
	var unshowD = function(id){
		$('#expla'+id).css({'display':'none'});
	}
	

	var otherfunc = function(id){
	$.post('../ingre_search/sukusai.php', { getid: id } , 
		function(result){
			$('#feedback1').html(result).show(); 
			$('#feedback1').append("<br><br><br><br>"); 
		}); 
    }    
	
	var deleteit = function(id){
		num_of_ingre--;
		$('#feedback2 #'+id).remove();
		$('#feedback2 #'+id+'plus').remove();
		var idonly = id.slice(1);
		var index = getingre.indexOf(idonly);
		getingre.splice(index,1);
		getingre.sort(function(a, b) {  
			return a - b;
		}); 
		getingre_array = JSON.stringify(getingre);
		$('#str').val(getingre_array);
	}

</script>
<style type="text/css">
#image-preview {
  border: solid black 1px;
  width: 1000px;
  height: 750px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0; 
  bottom: 0;
  margin: auto;
  text-align: center;
}

textarea {
	background-color: white;
	width: 970px;
	font-size: 150%;
	background: none;
	border: none;

	    background-image: -webkit-linear-gradient(left, white 10px, transparent 10px), -webkit-linear-gradient(right, white 10px, transparent 10px), -webkit-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -moz-linear-gradient(left, white 10px, transparent 10px), -moz-linear-gradient(right, white 10px, transparent 10px), -moz-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -ms-linear-gradient(left, white 10px, transparent 10px), -ms-linear-gradient(right, white 10px, transparent 10px), -ms-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: -o-linear-gradient(left, white 10px, transparent 10px), -o-linear-gradient(right, white 10px, transparent 10px), -o-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-image: linear-gradient(left, white 10px, transparent 10px), linear-gradient(right, white 10px, transparent 10px), linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
    background-size: 100% 100%, 100% 100%, 100% 31px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    line-height: 31px;
    font-family: Arial, Helvetica, Sans-serif;
    padding: 8px;
}

.explaw{
	position: relative;
}
.explaw2{
	position: relative;
}
[id^="expla"] {
    width: 120px;
	overflow: visible;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: 60%;
    left: 50%;
    margin-left: -60px;
}
[id^="expla"]::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
}
</style>

	<div class="upper">
	
		<div class="slide">
			<form action="edit.php?foodID=<?php echo $foodID; ?>" method="post" enctype="multipart/form-data">
				<label style="font-size: 150%;">Name:</label><input style="font-size: 150%;height: 30px; width: 500px;" type="text" name="name" value="<?php echo $foodname; ?>"><br><br> 
				<div id="image-preview" style="background-image: url('<?php echo $foodimage; ?>');background-size: 1000px 750px;">
					<label for="image-upload" id="image-label">Choose File</label>
					<input type="file" name="image" id="image-upload" />
				</div>
				<br><br>
	
				<style>[id^='feedback'] img{border-radius: 50%;}</style>
				<div class="lower"> 
				<div id="feedback2" style="min-height:200px; padding: 10px 10px;">
					<?php 
					$ingrestr = file_get_contents($ingre_all);
					$ingrejson = json_decode($ingrestr, true);
					if(!empty($ingrejson)){
						foreach($ingrejson as $field => $value){
							$sql = "SELECT * FROM ingredient WHERE ingreID = '$value'";
							$stmt =$dbh->prepare($sql);
							$stmt->execute();
							$row= $stmt->fetch(PDO::FETCH_ASSOC);
							$item = "<span class='explaw2' id='a".$row['ingreID']."'><img onmouseover='showD(this.id)' onmouseout='unshowD(this.id)' class='help' id='a".$row['ingreID']."' name='ingretofood[]' onclick='deleteit(this.id)' src='../images/".$row['ingreimage']."' alt='".$row['ingrename']."' style='border-radius: 50%; border: black solid 1px;' height='100' width='100'><span id='explaa".$row['ingreID']."' style='display:none; '>".$row['ingrenameeng']."<br>".$row['ingrename']."</span></span><img id='a".$row['ingreID']."plus' src='../images/foodgroups/plus.png' width='20' height='20'>";
							echo $item;
						}
					}
					?>
					<input type="hidden" id="str" name="str" value="" />
					<input id="hideshow" type='button' value='ready' style="position: relative; top:5px; float: right; width:50px; height:100px;">
				</div> 
				
				<div class="show_choice">
					<div class="search2">
						<style>.search2 input{width:100%; height:50px; text-align: center; font-size: 30px;}</style>
						<input type="text" id='sukusai' name='sukusai' placeholder='Ingredient Search' autocomplete="off" />
					</div> 
					<div id="feedback3" style="height=100px;">
						<style>#feedback3 img{margin: 10px 15px;}</style>
						<img onclick="otherfunc(this.id)" id='1' src='../images/foodgroups/vegi.png' width='100' height='100'>
						<img onclick="otherfunc(this.id)" id='2' src='../images/foodgroups/meat.png' width='100' height='100'>
						<img onclick="otherfunc(this.id)" id='3' src='../images/foodgroups/fish.png' width='100' height='100'>
						<img onclick="otherfunc(this.id)" id='4' src='../images/foodgroups/fruit.png' width='100' height='100'>
						<img onclick="otherfunc(this.id)" id='5' src='../images/foodgroups/grain.png' width='100' height='100'>
						<img onclick="otherfunc(this.id)" id='6' src='../images/foodgroups/etc.png' width='100' height='100'>
					</div>
					<div id="feedback1" style="min-height:500px; overflow: scroll;"></div>
						<style>#feedback1 img{margin: 10px 10px;}</style>
				</div>
				</div>
				<br><br>
				
				<label style="font-size: 150%;">Description:</label><br><textarea style="	min-height: 100px; " required name="description"><?php echo file_get_contents($des); ?></textarea>
				<br><br>
				<label style="font-size: 150%;">Step to make:</label><br>
				<ol id="method">			
				<style>#method li textarea{width: 950px; min-height:50px;}</style>
				</ol>
				<div class="btn">
				<input type="button" value="Add.." id="add">
				<input type="button" value="delete" id="delete"> <br><br>
				<input type="submit" name="submit" value="submit">
				</div>
			</form>
		</div> 
	</div>
</div>
<?php	
}else{echo "please select your own foodID";} 
}else{header('location: ../home');} 
?>

</body>
</html>

