<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");
	
	$label = $_POST["label"];
	$x  = $_POST["x"];
	$y  = $_POST["y"];
	$convocation_id = $_POST["convocation_id"];
	// find highest z
	$z  = get_highest_z($convocation_id,$conn) + 1 ;


	$query = "UPDATE seat_group ";
	$query .= "set left_position=$x, top_position=$y, z_index=$z ";
	$query .= "where label='$label'";
	$result = mysqli_query($conn,$query);
	confirm_query($result);

	echo $z;
?>