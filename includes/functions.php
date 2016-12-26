<?php 

	function view($data){
		global $conn;
	
		if($data)
			extract($data);

		$phpPath = $view . ".view.php";
		$cssPath = $view . ".css";

		include("views/layout.php");
	}

	

	function redirect_to($location){
		header("Location: " . $location);
		exit;
	}


	function form_errors($errors=array()){
		$output = "";
		if(!empty($errors)){
			$output .= "<div class=\"form-errors\">";
			$output .= "<ul>";
			foreach($errors as $key => $error){
				$output .= "<li><p>* {$error}</p></li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}

		return $output;
	}

	function subject_errors($errors=array()){
		$output = "";
		if(!empty($errors)){
			$output .= "<div class=\"form-errors\">";
			$output .= "<ul>";
			foreach($errors as $key => $error){
				$output .= "<li><p>{$error}</p></li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}

		return $output;
	}

	
	function attempt_login_on($tableName,$username,$password){

		global $conn; 

		$user = get_by_username($tableName,$username,$conn);
		if ($user) {
			// found user, now 
			if(password_verify($password, $user["password"])){
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function confrim_admin_login(){

		if(!isset($_SESSION["admin"])) {
			redirect_to("index.php");
		}
	} 

	function confrim_student_login(){

		if(!isset($_SESSION["student"])) {
			redirect_to("index.php");
		}
	} 


	function mark_to_grade($mark){

		if ( 100 >= $mark && $mark >= 90) {
			return "A+";
		} else if (  90 > $mark && $mark >= 80) {
			return "A";
		} else if ( 80 > $mark &&  $mark >= 75) {
			return "A-";
		} else if ( 75 > $mark && $mark >= 70) {
			return "B+";
		} else if ( 70 > $mark && $mark >= 65) {
			return "B ";
		} else if ( 65 > $mark && $mark >= 60) {
			return "B-";
		} else if ( 60 > $mark && $mark >= 55) {
			return "C+";
		} else if ( 55 > $mark && $mark >= 50) {
			return "C ";
		} else if ( 50 > $mark && $mark >= 47) {
			return "C-";
		} else if ( 47 > $mark && $mark >= 44) {
			return "D+";
		} else if ( 44 > $mark && $mark >= 40) {
			return "D ";
		} else {
			return "F ";
		}
	}

	function mark_to_point($mark){

		if ( 100 >= $mark && $mark >= 90) {
			return 4.00;
		} else if (  90 > $mark && $mark >= 80) {
			return 4.00;
		} else if ( 80 > $mark &&  $mark >= 75) {
			return 3.67;
		} else if ( 75 > $mark && $mark >= 70) {
			return 3.33;
		} else if ( 70 > $mark && $mark >= 65) {
			return 3.00;
		} else if ( 65 > $mark && $mark >= 60) {
			return 2.67;
		} else if ( 60 > $mark && $mark >= 55) {
			return 2.33;
		} else if ( 55 > $mark && $mark >= 50) {
			return 2.00;
		} else if ( 50 > $mark && $mark >= 47) {
			return 1.67;
		} else if ( 47 > $mark && $mark >= 44) {
			return 1.33;
		} else if ( 44 > $mark && $mark >= 40) {
			return 1.00;	
		} else {
			return 0.0;
		}
	}

	function calculate_cgpa($student_id,$conn){

		$subjects = get_registered_subjects($student_id,$conn);
		$sum = 0.0;
		$totalSubjects = 0;
		$cgpa = 0.0;

		foreach ($subjects as $subject) {
			$point = mark_to_point($subject["mark"]);
			$sum += $point;
			$totalSubjects++;
		}

		if($totalSubjects === 0){
			$cgpa = number_format(0.00, 2, '.', '');
		} else {
			$cgpa = number_format($sum/$totalSubjects, 2, '.', '');
		}

		update_cgpa($student_id,$cgpa,$conn);
	}

	function check_eligibility($student,$conn){

		global $conn;

		$remaining_subjects  = get_remaining_subjects($student["course_code"],$student["student_id"],$conn);
		$failed_subjects = get_failed_subjects($student["student_id"],$conn);
		$settings = mysqli_fetch_assoc(get_all_rows("admin",$conn));



		if ((mysqli_num_rows($remaining_subjects) === 0) && (mysqli_num_rows($failed_subjects) === 0)){

			$query = "UPDATE student SET ";
			$query .= "status = 'Eligible for Graduation' ";		
			$query .= "WHERE student_id ={$student["student_id"]} ";

			$result = mysqli_query($conn,$query);
			confirm_query($result);

			$to      = $student["email_address"];
			$subject = 'Congratulations';
			$message = $settings["eligibility_email"];
			$headers = 'From: graduation@mmu.edu.my' . "\r\n";

			mail($to, $subject, $message, $headers);
		} else {

			$query = "UPDATE student SET ";
			$query .= "status = 'Active' ";		
			$query .= "WHERE student_id ={$student["student_id"]} ";

			$result = mysqli_query($conn,$query);
			confirm_query($result);
		}
	}

	function apply_for_graduation($student,$conn){

		if($student["status"] === "Eligible for Graduation"){
			$query = "UPDATE student SET ";
			$query .= "status='Applied for Graduation' ";
			$query .= "WHERE student_id={$student["student_id"]} ";
			$result = mysqli_query($conn,$query);
			confirm_query($result);
		}

	}

	function cancelConvocaton(){

		  $_SESSION['step'] = 0;
		  unset($_SESSION["convocation_id"]);
		  unset($_SESSION["firstSeat"]);
		  unset($_SESSION["secondSeat"]);
		  unset($_SESSION["gown_size"]);
		  unset($_SESSION["convocation_name"]);
	}

?>