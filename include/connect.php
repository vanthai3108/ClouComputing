<?php

// $server = "35.172.43.136";
$server = "18.204.204.99";
$user = "thai";
$pass = "thai";
$database = "cloud";
$connect = mysqli_connect($server, $user, $pass, $database); 
if (!$connect) {
	die("Connect Failed:".mysqli_connect_error());
	# code...
}
mysqli_set_charset($connect, 'UTF8');
?>