<?php
	$server = "54.236.43.60";
	$user = "thai";
	$pass = "thai";
	$database = "cloud";
	$connect = mysqli_connect($server, $user, $pass, $database); 
	mysqli_set_charset($connect, 'UTF8');
	if (!$connect) {
		die("Connect Failed:".mysqli_connect_error());
		# code...
	}
?>


