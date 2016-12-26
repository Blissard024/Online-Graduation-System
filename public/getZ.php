<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");
	

	$convocation_id = $_POST["convocation_id"];
	// find highest z
	$z  = get_highest_z($convocation_id,$conn) + 1 ;

	echo $z;
?>