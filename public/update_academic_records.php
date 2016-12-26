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
	$remaining_subjects  = get_remaining_subjects($student["course_code"],$student["student_id"],$conn);
	$registered_subjects = get_registered_subjects($student["student_id"],$conn);
	$failed_subjects = get_failed_subjects($student["student_id"],$conn);
	$passed_credits = get_passed_credits($student["student_id"],$conn);
	$remaining_credits   = get_remaining_credits($student["course_code"],$student["student_id"],$conn);

	if(isset($_POST["add_subject"])) {
		$errors["empty"] = "";	
		$marks = $_POST["marks"];
		$error = 0;

		if(empty($_POST["subject_codes"])){
			$error = 2;
			$errors["empty"] = "";	
		}

		foreach ($_POST["subject_codes"] as $subject_code => $code) {


			if($marks[$code] === ''){
				$error = 1;
				$errors[$code] .= get_subjectName($code,$conn) . " not added: mark cannot be blank.";
				continue;
			}

			if($marks[$code] > 100 || $marks[$code] < 0 ){
				$error = 1;
				$errors[$code] .= get_subjectName($code,$conn) . " not added: mark must be between 0 and 100.";
				continue;
			}

			if(!is_numeric($marks[$code])){
				$error = 1;
				$errors[$code] .= get_subjectName($code,$conn) . " not added: mark must be a string";
				continue;
			}

			

			$query = "INSERT INTO mark values ";
	 		$query .= "(";
	 		$query .= "{$student["student_id"]},'$code',{$marks[$code]}";
	 		$query .= ");";

			$result = mysqli_query($conn,$query);

			if(!$result) {
				die("Operation failed. query: " . $query);
			}
		}

		if(!empty($errors)){
 				$_SESSION["errors"] = $errors;
 		}

 		if($error === 0){
			$_SESSION["message"] = "Operation Successfully finished.";
 		} else if ($error === 1) {
			$_SESSION["message"] = "Operation finished with errors: ";
 		} else {
 			$_SESSION["message"] = "No subject added.";
 		}

		calculate_cgpa($student["student_id"],$conn); 
		check_eligibility($student,$conn);
		redirect_to("update_academic_records.php?id={$student["student_id"]}");
	}


	if(isset($_POST["delete_subject"])) {
		
		$errors["empty"] = "";	
		$error = 0;
		if(empty($_POST["subject_codes"])){
			$error = 1;
			$errors["delete"] = "";	
		}




		foreach ($_POST["subject_codes"] as $subject_code => $code) {
			$query = "DELETE FROM mark ";
 			$query .= "WHERE student_id={$student["student_id"]} AND subject_code='$code' ";
 			$result = mysqli_query($conn,$query);

			if(!$result) {
				die("Operation failed. query: " . $query);
			} 
		}


		if(!empty($errors)){
 				$_SESSION["errors"] = $errors;
 		}

		if (!$error){
			$_SESSION["message"] = "Operation finishd successfully";
		} else if ($error) {
			$_SESSION["message"] = "No subject deleted.";
		}
		calculate_cgpa($student["student_id"],$conn);
		check_eligibility($student,$conn);
		redirect_to("update_academic_records.php?id={$student["student_id"]}");
	}	

	$data = array(
		'view' => 'update_academic_records',
		'page_title' => "View Students",
		'page_header' => $student["first_name"] . " " . $student["last_name"] . "'s Academic Records",
		'student' => $student,
		'remaining_subjects' => $remaining_subjects,
		'registered_subjects' => $registered_subjects,
		'failed_subjects' => $failed_subjects,
		'passed_credits' => $passed_credits,
		'remaining_credits' => $remaining_credits

	);

 	view($data);
?>