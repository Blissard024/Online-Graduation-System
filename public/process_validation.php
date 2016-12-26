<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");


 	$label = $_POST["label"];

 	$query = "select * from seat_group ";
 	$query .= "where label='$label' ";
 	$result = mysqli_query($conn,$query);
	confirm_query($result);

	if (mysqli_num_rows($result) > 0){
		echo 0;
	} else {
		echo 1;
	}

 ?>