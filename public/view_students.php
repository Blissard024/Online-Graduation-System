<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_admin_login();

	if (isset($_GET["search"])){

		if($_GET["option"] === 'id'){
			$students = get_student_by_id($_GET["input"],$conn);
		} else {
			$students = get_student_by_name($_GET["input"],$conn);
		}
	} else {
		$students = get_all_students($conn);

	}


	$data = array(
		'view' => 'view_students',
		'page_title' => "View Students",
		'students' => $students,
		'option' => $_GET["option"]
	);

 	view($data);
?>