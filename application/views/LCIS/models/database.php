<?php 
	 	$username = 'root';
	 	$password = '';
	 	$db 	  = 'lcis';
	 	$host	  = 'localhost';
 
		// try {
		//     $con = new PDO("mysql:host={$host};dbname={$db}", $username, $password);
		// }
		 
		// // to handle connection error
		// catch(PDOException $exception){
		//     echo "Connection error: " . $exception->getMessage();
		// }

	mysql_connect($host, $username, $password) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());

 ?>