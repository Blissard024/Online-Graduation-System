<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");
	
	confrim_admin_login();


	if (isset($_POST["submit"])){
		
		validate_presences(array("username","password","first_name","last_name"));

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("new_admin.php");
 		}

 		$first_name = mysqli_real_escape_string($conn,$_POST["first_name"]);
 		$last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
 		$username = mysqli_real_escape_string($conn,$_POST["username"]);
 		$password = password_hash($_POST["password"],PASSWORD_DEFAULT);

 		$found_user = get_by_username("admin",$username,$conn);

 		if($found_user){
 			$_SESSION["message"] = "Username Already exists in the database";
			redirect_to("new_admin.php");
 		}


 		$query = "INSERT INTO admin ";
		$query .= "values ";
		$query .= "('$username','$password','$first_name','$last_name');";


		$result = mysqli_query($conn,$query);

		if($result) {
			$_SESSION["message"] = "Admin successfully created.";
			redirect_to("new_admin.php");
		} else {
			$_SESSION["message"] = "Admin creation failed.";
			redirect_to("new_admin.php");
		}
	}

	$data = array(
		'view' => 'new_admin',
		'page_title' => "New Admin",
	);

 	view($data);
?>