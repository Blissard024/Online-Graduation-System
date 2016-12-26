<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");
	
	confrim_admin_login();

	$subjects = get_all_rows("subject",$conn);

	if (isset($_POST["delete_convocation"])){



	}

	

	if (isset($_POST["submit"])){

		validate_presences(array("first_name","last_name","faculty","course_code","student_id","password"));
		validate_intTypes(array("student_id"));

		
		
		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("register_student.php");
 		}

 		$first_name = mysqli_real_escape_string($conn,$_POST["first_name"]);
 		$last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
 		$faculty = mysqli_real_escape_string($conn,$_POST["faculty"]);
 		$course_code = mysqli_real_escape_string($conn,$_POST["course_code"]);
 		$student_id = (int) ($_POST["student_id"]);
 		$username =   (int) ($_POST["student_id"]);
 		$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
 		($_POST["contact_number"]) ? $contact_number = (int) ($_POST["contact_number"]) : $contact_number = 0;
 		($_POST["email"]) ? $email = mysqli_real_escape_string($conn,$_POST["email"]) : $email = "null" ;
 		($_POST["mail_address"]) ? $mail_address = mysqli_real_escape_string($conn,$_POST["mail_address"]) : $mail_address = "null";
 		$status = "Active";
 		$cgpa = 0;
 		$ticket_id = "null";


 		$query = "INSERT INTO student values ";
 		$query .= "(";
 		$query .= "'$first_name','$last_name',$student_id,$username,'$password',";
 		$query .= "'$faculty','$course_code','$status',$contact_number,";
 		$query .= "'$mail_address','$email',$cgpa,$ticket_id";
 		$query .= ");";
		
		echo $query . "<br>";
		$result = mysqli_query($conn,$query);
		if($result) {
			$_SESSION["message"] = "Student successfully registered. ";
			redirect_to("register_student.php");
		} else {
			$_SESSION["message2"] = "<div class=\"form-errors\">Student ID must be a unique number.</div>";
			redirect_to("register_student.php");
		}

		// $array = $_POST["selected_subjects"];
		// $output = "";
		// foreach ($array as $key => $value) {
		// 	 $output .= $key . ": " . $value . "<br>";
		// }

		// die($output);
	}

	$data = array(
		'view' => 'register_student',
		'page_title' => "Register Student",
		'subjects' => $subjects
	);

 	view($data);
?>