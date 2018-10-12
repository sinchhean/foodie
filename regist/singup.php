<html>
<head>
<link rel="stylesheet" href="../style/signup.css"/>
<link rel="icon" href="../images/1.ico" />
</head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$('#username').keyup(function(){
		var username = $(this).val();
		$.post('signup_username.php', { username: username } ,
		function(result){
			$('#feedback1').html(result).show();
		});
	});
	$('#email').keyup(function(){
		var email = $(this).val();
		$.post('signup_email.php', { email: email } ,
		function(result){
			$('#feedback2').html(result).show();
		});
	});
	$('#password1').keyup(function(){
		var password1 = $(this).val();
		$.post('signup_password.php', { password1: password1 } ,
		function(result){
			$('#feedback3').html(result).show();
		});
	});
	$('#password2').keyup(function(){
		var password2 = $(this).val();
		var password1 = $('#password1').val();
		$.post('signup_password2.php', { password2: password2, password1: password1 } ,
		function(result){
			$('#feedback4').html(result).show();
		});
	});

});
</script>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{  
    if (isset($_POST['register'])) { //user registering
       
        require 'connect.php';
        
    }
}
?>
<body>
	
	
<div id="signup">
		 
<form action="singup.php" method="post" autocomplete="off">
<h1>Register to foodie</h1>
<table>

<div class="field-wrap">
  <tr>
　　	<th>Username</th>
　　<td><input type="text" id="username" required autocomplete="off" minlength="5" name='username' class="hoge"/></td>
　 </tr>


<div class="field-wrap">
  <tr>
　　	<th>Email</th>
　　<td><input type="email" id="email" required autocomplete="off" name='email' class="hoge"/></td>
　 </tr>
</div>


<div class="field-wrap">
  <tr>
　　	<th>Password</th>
　　<td><input type="password" id="password1" required autocomplete="off" name='password1' class="hoge"/></td>
　 </tr>
</div>


<div class="field-wrap">
  <tr>
　　	<th>Confirm Password</th>
　　<td><input type="password" id="password2" required autocomplete="off" name='password2' class="hoge"/></td>
　 </tr>
</div>

</table>
  <br>
	<p><button type="submit" id='register' name="register" />Register</button></p>
	<a href="../home">Home</a>

	<div id="errorMes"></div> 
	<div id="feedback1"></div>
	<div id="feedback2"></div>
	<div id="feedback3"></div>
	<div id="feedback4"></div>
</form>
</div> 
</body>

	
　　	

</html>