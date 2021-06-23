<?php
	$server = "18.210.18.214";
	$user = "thai";
	$pass = "thai";
	$database = "cloud";
	$connect = mysqli_connect($server, $user, $pass, $database); 
	if (!$connect) {
		die("Connect Failed:".mysqli_connect_error());
		# code...
	}
	// mysqli_set_charset($connect, 'UTF8');
?>


