<?php 

	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_admin_login();

	$data = array(
		'view' => 'admin_profile',
		'page_title' => "Admin Panel",
	);

 	view($data);
?>