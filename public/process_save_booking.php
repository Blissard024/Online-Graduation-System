<?php 

	require_once("../includes/session_functions.php");
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");


 	$_SESSION["firstSeat"] = $_POST["firstSeat"];
 	$_SESSION["secondSeat"] = $_POST["secondSeat"];
 	$thisConvo = get_convocation($_POST["id"],$conn);
 	$_SESSION["convocation_name"] =$thisConvo["convocation_name"];
 	$_SESSION["convocation_id"] = $_POST["id"];

 	
	// $query = "INSERT INTO ticket ";
	// $query .= "values ";
	// $query .= "(null,'$firstSeat','$secondSeat','small ',$convocation_id)";
	// $result = mysqli_query($conn,$query);
	// confirm_query($result);


?>