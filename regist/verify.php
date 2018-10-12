<?php
require 'db.php';
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
	$email = $_GET['email'];
	$hash = $_GET['hash'];
	$sql = "SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$check = $stmt->rowCount();
	if($check == 0)
    {  
        echo "Account has already been activated or the URL is invalid!";
		echo '<br><a href="../home">Home</a>';
    }
    else {
        echo "Your account has been successfully activated!";
        echo '<br><a href="../home">Home</a>';
        // Set the user status to active (active = 1)
        $dbh->query("UPDATE users SET active='1' WHERE email='$email'") or die($dbh->error);
        $_SESSION['active'] = 1;
        
    }
}else {
    echo "Invalid parameters provided for account verification!";
	echo '<br><"../home">Home</a>';
}   	
?>