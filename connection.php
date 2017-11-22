 <?php

	$DbHostName = "localhost";
	$DbUsername = "root";
	$dbPassword = "";
	$dbName     = "reservation";
	$dbConn     = null;

	try {
		$dbConn = new PDO("mysql:host={$DbHostName};dbname={$dbName};", $DbUsername, $dbPassword);
	
	} catch (Exception $e) {
		die("Error: ". $e->getMessage());
	}

 ?>