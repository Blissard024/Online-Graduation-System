<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");

function confirm_query($result){
	global $conn;
	if(!$result)
		die("database query failed: " . mysqli_error($conn));

}



function get_by_username($tableName,$username,$conn){

	$safe_admin_username = mysqli_real_escape_string($conn,$username);

	$query =  "SELECT * FROM $tableName ";
	$query .= "WHERE username = '{$safe_admin_username}' ";
	$query .= "LIMIT 1 ";

	$result = mysqli_query($conn,$query);
	confirm_query($result);

	return mysqli_fetch_assoc($result);

}

// select m.student_id,m.subject_code,m.mark,s.subject_name,s.credit_hours 
// from mark m inner join subject s ON m.subject_code=s.subject_code and student_id=1

function get_registered_subjects($student_id,$conn){

	$query  = "SELECT m.subject_code,m.mark,s.subject_name,s.credit_hours ";
	$query .= "FROM mark m INNER JOIN subject s ";
	$query .= "ON m.subject_code=s.subject_code and student_id=$student_id ";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	return $result;
}


function get_failed_subjects($student_id,$conn){

	$query  = "SELECT m.subject_code,m.mark,s.subject_name,s.credit_hours ";
	$query .= "FROM mark m INNER JOIN subject s ";
	$query .= "ON m.subject_code=s.subject_code and student_id=$student_id and mark<50";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	return $result;
}



function get_passed_credits($student_id,$conn){

	$query  = "SELECT sum(s.credit_hours) AS credits ";
	$query .= "FROM mark m INNER JOIN subject s ";
	$query .= "ON m.subject_code=s.subject_code and student_id=$student_id ";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	return mysqli_fetch_assoc($result)["credits"];

}



// function get_remaining_credits($course_code,$student_id,$conn){
// 		$query = "SELECT sum(s.credit_hours) AS credits FROM subject s ";
// 		$query .= "LEFT JOIN mark m ON ";
// 		$query .= "s.subject_code = m.subject_code WHERE m.subject_code IS NULL AND s.course_code='$course_code'";
// 		$result = mysqli_query($conn,$query);
// 		confirm_query($result);
// 		return mysqli_fetch_assoc($result)["credits"];
// };	

function get_remaining_credits($course_code,$student_id,$conn){
		$query = "SELECT sum(credit_hours)  AS credits from subject ";
		$query .= "where course_code='$course_code' and (subject.subject_code) NOT IN  ";
		$query .= "(SELECT subject_code from mark where student_id=$student_id); ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return mysqli_fetch_assoc($result)["credits"];
}

// function get_remaining_subjects($course_code,$student_id,$conn){
		// $query = "SELECT s.subject_name,s.subject_code,s.credit_hours FROM subject s ";
		// $query .= "LEFT JOIN mark m ON ";
		// $query .= "s.subject_code = m.subject_code WHERE m.subject_code IS NULL AND s.course_code='$course_code'";
		// $result = mysqli_query($conn,$query);
		// confirm_query($result);
		// return $result;
// }

function get_remaining_subjects($course_code,$student_id,$conn){
		$query = "SELECT * from subject ";
		$query .= "where course_code='$course_code' and (subject.subject_code) NOT IN  ";
		$query .= "(SELECT subject_code from mark where student_id=$student_id); ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return $result;
}

function get_subjects_by_course($course_code,$conn){
		$query = "SELECT * FROM subject ";
		$query .= "WHERE course_code = '$course_code'";

		$result = mysqli_query($conn,$query);
		confirm_query($result);

		return $result;
	}

function get_all_rows($tableName,$conn){
		$query = "SELECT * FROM $tableName ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);

		return $result;
	}


function get_all_students($conn){
	$query = "SELECT * FROM student order by status ASC,first_name ASC, last_name ASC";
	$result = mysqli_query($conn,$query);
	confirm_query($result);

	return $result;
}

function get_student_by_ID($id,$conn){

		$query = "SELECT * FROM student ";
		$query .= "WHERE student_id LIKE '%{$id}%' ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return $result;
}

function get_student_by_name($name,$conn){

		$query = "SELECT * FROM student ";
		$query .= "WHERE first_name LIKE '%{$name}%' or last_name LIKE '%{$name}%' ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return $result;
}



function get_convocation($id,$conn){

		$query = "SELECT * FROM convocation ";
		$query .= "WHERE convocation_id=$id";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return mysqli_fetch_assoc($result);
}



function get_convocation_faculties($faculty,$conn){

		$query = "SELECT * FROM convocation_faculty ";
		$query .= "WHERE faculty='$faculty'";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return $result;
}



function get_settings($conn){

		$query = "SELECT * FROM admin ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return mysqli_fetch_assoc($result);
}



function get_convocation_seats($id,$conn){

		$query = "SELECT * FROM seat_group ";
		$query .= "WHERE convocation_id=$id";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return $result;
}


function get_ticket($id,$conn){

		$query = "SELECT * FROM ticket ";
		$query .= "WHERE ticket_id=$id";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return mysqli_fetch_assoc($result);

}

function get_tickets($id,$conn){

		$query = "SELECT * FROM ticket ";
		$query .= "WHERE convocation_id=$id";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		return  $result;
}


function get_courseName($courseCode,$conn) {

		$query = "SELECT course_name FROM course ";
		$query .= "WHERE course_code='$courseCode' ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		$result = mysqli_fetch_assoc($result);
		return $result["course_name"];
		
}

function get_subjectName($subjectCode,$conn) {

		$query = "SELECT subject_name FROM subject ";
		$query .= "WHERE subject_code='$subjectCode' ";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		$result = mysqli_fetch_assoc($result);
		return $result["subject_name"];
}


function update_cgpa($student_id,$cgpa,$conn) {

		$query =  "UPDATE student ";
		$query .= "SET cgpa = $cgpa ";
		$query .= "WHERE student_id=$student_id";
		$result = mysqli_query($conn,$query);
		confirm_query($result);
}

function get_highest_z($convocation_id,$conn){
	$query = "select MAX(z_index) as max from seat_group ";
	$query .= "where convocation_id=$convocation_id";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	$result = mysqli_fetch_assoc($result);
	return $result["max"];

}


function get_ticket_id($conn){
	$query = "SELECT MAX(ticket_id) as max from ticket ";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	$result = mysqli_fetch_assoc($result);
	return $result["max"];
}

function get_last_convocation_id($conn){
	$query = "SELECT MAX(convocation_id) as max from convocation ";
	$result = mysqli_query($conn,$query);
	confirm_query($result);
	$result = mysqli_fetch_assoc($result);
	if ($result["max"] === null ) {
		return 0;
	}
	return $result["max"];
}


		
?>