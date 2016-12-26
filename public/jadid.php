<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");
	

	

	$data = array(
		'view' => 'jadid',
		'page_title' => "jadid",
		'page_header' => "jadidtar",
	);


 	view($data);
?>