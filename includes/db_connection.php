<?php 

	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","root");
	define("DB_NAME","gs");

	$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	if(mysqli_connect_errno()) {
		die("db connection failed ") .  mysqli_connect_error();
	}

?>