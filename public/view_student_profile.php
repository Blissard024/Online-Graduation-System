<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_admin_login();

	if(!isset($_GET["id"])){
		redirect_to("view_students.php?option=id");
	}

	$student = get_student_by_id($_GET["id"],$conn);
	$student = mysqli_fetch_assoc($student);


	$data = array(
		'view' => 'view_student_profile',
		'page_title' => "View Students",
		'page_header' => $student["first_name"] . " " . $student["last_name"] . " Profile",
		'student' => $student
	);

 	view($data);
?>