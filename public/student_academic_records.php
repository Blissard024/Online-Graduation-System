<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_student_login();

	if(!isset($_GET["id"])){
		redirect_to("view_students.php?option=id");
	}



	$student = get_student_by_id($_GET["id"],$conn);
	$student = mysqli_fetch_assoc($student);
	$remaining_subjects  = get_remaining_subjects($student["course_code"],$student["student_id"],$conn);
	$registered_subjects = get_registered_subjects($student["student_id"],$conn);
	$failed_subjects = get_failed_subjects($student["student_id"],$conn);
	$passed_credits = get_passed_credits($student["student_id"],$conn);
	$remaining_credits   = get_remaining_credits($student["course_code"],$student["student_id"],$conn);

	if(isset($_POST["apply"])){
		apply_for_graduation($student,$conn);
		redirect_to("student_academic_records.php?id={$student["student_id"]}");
	}


	$data = array(
		'view' => 'student_academic_records',
		'page_title' => "Academic Records",
		'page_header' => $student["first_name"] . " " . $student["last_name"] . " Academic Records",
		'student' => $student,
		'remaining_subjects' => $remaining_subjects,
		'registered_subjects' => $registered_subjects,
		'failed_subjects' => $failed_subjects,
		'passed_credits' => $passed_credits,
		'remaining_credits' => $remaining_credits
	);

 	view($data);

?>