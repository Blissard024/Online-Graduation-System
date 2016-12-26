<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/validation_functions.php");


	confrim_student_login();

	if(!isset($_GET["id"])){
		redirect_to("view_students.php?option=id");
	}



	$student = get_student_by_id($_GET["id"],$conn);
	$student = mysqli_fetch_assoc($student);


	if(isset($_POST["submit"])){

		validate_presences(array("first_name","last_name","contact_number","email_address","mail_address"));

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("student_update_student_profile.php?id={$student["student_id"]}");
 		}

 		$first_name =  mysqli_real_escape_string($conn,$_POST["first_name"]);
		$last_name  =  mysqli_real_escape_string($conn,$_POST["last_name"]);
		$contact_number   =  mysqli_real_escape_string($conn,$_POST["contact_number"]);
		$email_address   =  mysqli_real_escape_string($conn,$_POST["email_address"]);
		$mail_address = mysqli_real_escape_string($conn,$_POST["mail_address"]);

 		$query = "UPDATE student SET ";
		$query .= "first_name = '{$first_name}', ";
		$query .= "last_name = '{$last_name}', ";
		$query .= "contact_number = '{$contact_number}', ";
		$query .= "mail_address = '{$mail_address}', ";
		$query .= "email_address = '{$email_address}' ";		
		$query .= "WHERE student_id = {$student["student_id"]} ";
		
		$result = mysqli_query($conn,$query);
		confirm_query($result);

		if($result) {

			$_SESSION["message"] = "Profile Updated";
			redirect_to("student_update_student_profile.php?id={$student["student_id"]}");
		} else {
			$_SESSION["message"] = "Failed to Update Profile";
			redirect_to("student_update_student_profile.php?id={$student["student_id"]}");
		}
	}


	$data = array(
		'view' => 'student_update_student_profile',
		'page_title' => "Student Profile",
		'page_header' => "Update Profile",
		'student' => $student
	);

 	view($data);
?>