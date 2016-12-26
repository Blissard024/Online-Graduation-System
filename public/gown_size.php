<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
 	require_once("../includes/validation_functions.php");
 	
	confrim_student_login();

	$data = array(
		'view' => 'apply_convocation',
		'page_title' => "Convocation",
		'page_header' => "Graduation Gown Size",
	);

 	view($data);

?>