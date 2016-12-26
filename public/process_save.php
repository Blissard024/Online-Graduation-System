<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");

 	$rows = $_POST["rows"];
 	$coloumns = $_POST["coloumns"];
 	$label = $_POST["label"];
 	$x = $_POST["x"];
 	$y = $_POST["y"];
 	$color = $_POST["color"];
 	$reservable = $_POST["reservable"];
 	$convocation_id = $_POST["convocation_id"];
 	$z_index = $_POST["z_index"];

	$query = "INSERT INTO seat_group ";
	$query .= "values ";
	$query .= "('$label',$rows,$coloumns,$x,$y,'$color',$reservable,$convocation_id,$z_index);";
	$result = mysqli_query($conn,$query);
	confirm_query($result);



?>