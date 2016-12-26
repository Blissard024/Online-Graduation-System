<?php 
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
 	require_once("../includes/validate_credit.php");

	confrim_student_login();
	$errortext = "";
	$errornumber = "";
	$settings  = get_settings($conn);

	if (isset($_POST["cancelConvocation"])){
		cancelConvocaton();
	}

	if(!isset($_SESSION["username"])){
		die("Student not found.");
	}

	$student = get_student_by_id($_SESSION["username"],$conn);
	$student = mysqli_fetch_assoc($student);
	$convocation_faculties= get_convocation_faculties($student["faculty"],$conn);
	$convocations = array();
	foreach ($convocation_faculties as $convocation) {
		$convocations[] = get_convocation($convocation["convocation_id"],$conn);
	}



	if(isset($_POST["step1"])){

		$option = $_POST["option"];

		if($option === "attend_convo"){
			$_SESSION["step"] = 1;
		}

		if($option === "post_certificate"){
			$_SESSION["step"] = 4;
		}
		

	}


	if(isset($_POST["book_seats"])){

		if(!isset($_POST["convocation"])){
			$_SESSION["error"]  = "Please select a convocation to proceed to next step.";
			redirect_to("apply_convocation.php?id={$student["student_id"]}");

		}

		$_SESSION["step"] = 2;
		redirect_to("seat_booking.php?id={$_POST["convocation"]}");
	}



	if(isset($_POST["payment"])){

		$_SESSION["step"] = 3;
		$_SESSION["gown_size"] = $_POST["gown_size"];
	}

	if(isset($_POST["nextStep"])){

		$_SESSION["step"] = 5;
	}

	if(isset($_POST["makePayment"])){
		
		$cardType = $_POST["CardType"];
		$cardNumber = $_POST["CardNumber"];
		if (checkCreditCard ($cardNumber, $cardType,$errornumber,$errortext)){
			$convocation_id = $_SESSION["convocation_id"];
			$firstSeat = $_SESSION["firstSeat"];
			$secondSeat = $_SESSION["secondSeat"];
			$gown_size = $_SESSION["gown_size"];

			$query = "INSERT INTO ticket ";
			$query .= "values ";
			$query .= "(null,'$firstSeat','$secondSeat','$gown_size',$convocation_id)";
			$result = mysqli_query($conn,$query);
			confirm_query($result);

			$query = "UPDATE student SET ";
			$query .= "status = 'Graduated' ";		
			$query .= "WHERE student_id ={$student["student_id"]} ";
			$result = mysqli_query($conn,$query);
			confirm_query($result);

			$ticket_id = get_ticket_id($conn);

			$query = "UPDATE student SET ";
			$query .= "ticket_id=$ticket_id ";
			$query .= "WHERE student_id ={$student["student_id"]} ";
			$result = mysqli_query($conn,$query);
			confirm_query($result);

			redirect_to("apply_convocation.php?id={$student["student_id"]}");

		}

	}


	if(isset($_POST["makePaymentForPostage"])){
		
		$cardType = $_POST["CardType"];
		$cardNumber = $_POST["CardNumber"];
		if (checkCreditCard ($cardNumber, $cardType,$errornumber,$errortext)){
			

			$query = "UPDATE student SET ";
			$query .= "status = 'Graduated', ";		
			$query .= "ticket_id = -1 ";		
			$query .= "WHERE student_id ={$student["student_id"]} ";
			$result = mysqli_query($conn,$query);
			confirm_query($result);


			redirect_to("apply_convocation.php?id={$student["student_id"]}");

		}

	}

	if(isset($_POST["update_profile"])){

		$errors= "";
		validate_presences(array("first_name","last_name","contact_number","email_address","mail_address"));

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("apply_convocation.php?id={$student["student_id"]}");
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
			redirect_to("apply_convocation.php?id={$student["student_id"]}");
		} else {
			$_SESSION["message"] = "Failed to Update Profile";
			redirect_to("apply_convocation.php?id={$student["student_id"]}");
		}
	}



	$data = array(
		'view' => 'apply_convocation',
		'page_title' => "Convocation",
		'page_header' => "Apply For Convocation",
		'student' => $student,
		'convocations' => $convocations,
		'errortext' => $errortext,
		'settings' => $settings
	);

 	view($data);

?>