<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");
	
	$label = $_POST["label"];

	$query = "DELETE FROM seat_group ";
	$query .= "where label='$label'";

	$result = mysqli_query($conn,$query);
	confirm_query($result);
?>