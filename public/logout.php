<?php 

	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");

	$_SESSION = array_fill_keys(array_keys($_SESSION), null);
	session_destroy(); 
	redirect_to("index.php");
?>