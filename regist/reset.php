<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$('#newpassword').keyup(function(){
		var newpas = $(this).val();
		$.post('resetpasscheck.php', { newpas: newpas } ,
		function(result){
			$('#feedback1').html(result).show();
		});
	});
	$('#confirmpassword').keyup(function(){
		var confpas = $(this).val();
		var newpas = $('#newpassword').val();
		$.post('resetpasscheck.php', { confpas: confpas, newpas: newpas} ,
		function(result){
			$('#feedback2').html(result).show();
		});
	});
});
</script>
<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require '../database/db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $_GET['email']; 
    $hash = $_GET['hash']; 

    // Make sure user email with matching hash exist
    $sql = "SELECT * FROM users WHERE email='$email' AND hash='$hash'";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();
	if($check == 0)
    { 
        echo "You have entered invalid URL for password reset!";
		echo "<br>";
		echo "<a href='../home'>Home</a>";
    }else{
	?> 
	<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Reset Your Password</title>
</head>
<body>
    <div class="form">
        <h1>Choose Your New Password</h1>
        <form action="resetpass.php" method="post">
			<div class="field-wrap">
				<label>
					New Password<span class="req">*</span>
				</label>
				<input type="password" required id="newpassword" name="newpassword" autocomplete="off"/>
				<div id="feedback1"></div>
			</div>  
			<div class="field-wrap">
				<label>
					Confirm New Password<span class="req">*</span>
				</label>
				<input type="password" required id="confirmpassword" name="confirmpassword" autocomplete="off"/>
				<div id="feedback2"></div>
			</div>
          
          <!-- This input field is needed, to get the email of the user -->
			<input type="hidden" name="email" value="<?= $email ?>">    
			<input type="hidden" name="hash" value="<?= $hash ?>">    
              
			<button class="button button-block"/>Apply</button>
        </form>
    </div>
</body>
</html> 
<?php
	}
}
else {
    echo "Sorry, verification failed, try again!";
}
if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ){
	echo $_SESSION['message']; 
}
        
?>

