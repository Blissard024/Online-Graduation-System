<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");

	confrim_admin_login();

	if(!isset($_GET["id"])){
		redirect_to("view_students.php?option=id");
	}


	$student = get_student_by_id($_GET["id"],$conn);
	$student = mysqli_fetch_assoc($student);



	if(isset($_POST["submit"])){


		validate_presences(array("first_name","last_name","faculty","course_code","student_id","status"));

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("update_student_profile.php?id={$student["student_id"]}");
 		}

 		$first_name = mysqli_real_escape_string($conn,$_POST["first_name"]);
 		$last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
 		$faculty = mysqli_real_escape_string($conn,$_POST["faculty"]);
 		$course_code = mysqli_real_escape_string($conn,$_POST["course_code"]);
 		$student_id = (int) ($_POST["student_id"]);
 		($_POST["contact_number"]) ? $contact_number = (int) ($_POST["contact_number"]) : $contact_number = 0;
 		($_POST["email"]) ? $email = mysqli_real_escape_string($conn,$_POST["email"]) : $email = "null" ;
 		($_POST["mail_address"]) ? $mail_address = mysqli_real_escape_string($conn,$_POST["mail_address"]) : $mail_address = "null";
 		$status = $_POST["status"];
 		$ticket_id = "null";



		$query = "UPDATE student SET ";
		$query .= "first_name = '{$first_name}', ";
		$query .= "last_name = '{$last_name}', ";
		$query .= "faculty = '{$faculty}', ";
		$query .= "course_code = '{$course_code}', ";
		$query .= "student_id = {$student_id}, ";
		$query .= "contact_number = '{$contact_number}', ";
		$query .= "mail_address = '{$mail_address}', ";
		$query .= "email_address = '{$email}', ";		
		$query .= "status = '{$status}', ";		
		$query .= "ticket_id = '{$ticket_id}' ";		
		$query .= "WHERE student_id = {$student["student_id"]} ";
		
		echo $query . "<br>";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		if($result) {
			$_SESSION["message"] = "Student profile updated successfully. ";
			redirect_to("update_student_profile.php?id=$student_id");
		} else {
			$_SESSION["message"] = "Failed to update student profile.";
			redirect_to("update_student_profile.php?id={$student["student_id"]}");
		}

	}



	$data = array(
		'view' => 'update_student_profile',
		'page_title' => "View Students",
		'page_header' => "Update " . $student["first_name"] . " " . $student["last_name"] . "'s Profile",
		'student' => $student
	);

 	view($data);
?>