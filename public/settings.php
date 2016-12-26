<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/validation_functions.php");
 	require_once("../includes/functions.php");
	require_once("../includes/session_functions.php");
	
	confrim_admin_login();


	$settings = get_settings($conn);
	
	if (isset($_POST["update_settings"])){

		validate_presences(array("ticket_price","postage_cost","eligibility_notification_email"));

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("settings.php");
 		}

 		$ticket_price = mysqli_real_escape_string($conn,$_POST["ticket_price"]);
 		$postage_cost = mysqli_real_escape_string($conn,$_POST["postage_cost"]);
 		$autogen_email_content = mysqli_real_escape_string($conn,$_POST["eligibility_notification_email"]);
 		


		$query = "UPDATE admin SET ";
		$query .= "ticket_price = '{$ticket_price}', ";
		$query .= "postage_cost = '{$postage_cost}', ";
		$query .= "autogen_email_content = '{$autogen_email_content}'  ";		
		$query .= "WHERE username='admin' ";
		
		$result = mysqli_query($conn,$query);
		confirm_query($result);
		if($result) {
			$_SESSION["message"] = "Settings updated successfully. ";
			redirect_to("settings.php");
		} else {
			$_SESSION["message"] = "Failed to update settings.";
			redirect_to("settings.php");
		}
	}


	$data = array(
		'view' => 'settings',
		'page_title' => "Settings",
		'page_header' => "Settings",
		'settings' => $settings
	);


 	view($data);
?>