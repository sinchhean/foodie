<?php
	try
	{
		// MySQLに接続するための設定 
		$dsn='mysql:dbname=foodie;host=localhost;charset=utf8';
		$dbuser='lala';
		$dbpass='trustallbutme';

		// MySQLに接続する 
		$dbh=new PDO($dsn,$dbuser,$dbpass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


	}
	catch(Exception $e)
	{
		// 異常終了 
		echo 'ERROR: ' . $e->getMessage(). '<br>';	
		print'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}
	
?>