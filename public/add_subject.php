<?php 

	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_admin_login();

	$data = array(
		'view' => 'add_subject',
		'page_title' => "Add Subject",
	);

 	view($data);
?>