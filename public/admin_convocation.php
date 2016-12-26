<?php 
	
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
 	require_once("../includes/validation_functions.php");



	confrim_admin_login();

	$tab = 1;

	$convocations = get_all_rows('convocation',$conn);

	if(isset($_POST["delete_convocation"])){

		$tab = 2;

		if(empty($_POST["deletions"])){
			$errors["deletions"] = "No convcation were selected.";
	 		$_SESSION["errors"] = $errors;

		} else {

			foreach ($_POST["deletions"] as $event) {

				$tickets =	get_tickets($event,$conn);

				if(mysqli_num_rows($tickets) > 0) {
					$errors["ohoh"] = "You cannot delete an active convocation";
					break;
				}


				$query = "DELETE FROM convocation ";
	 			$query .= "WHERE convocation_id={$event} ";
	 			$result = mysqli_query($conn,$query);


				if(!$result) {
					die("Operation failed. query: " . $query);
				}


				$query = "DELETE FROM convocation_faculty ";
	 			$query .= "WHERE convocation_id={$event} ";
	 			$result = mysqli_query($conn,$query);

	 			
				if(!$result) {
					die("Operation failed. query: " . $query);
				}

			}

	 		$_SESSION["errors"] = $errors;

		}

		// redirect_to("admin_convocation.php");
	}

	if(isset($_POST["create_event"])){



		$date = str_replace('/', '-', $_POST["convocation_date"]);
		if (!preg_match("/^(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])-[0-9]{4}$/",$date)){
					$errors["convocation_date"] = fieldname_as_text("convocation_date") . " is in invalid format";
		}

		validate_time_format(array("convocation_starting_time","convocation_ending_time"));

		validate_presences(array("convocation_name","convocation_date","convocation_starting_time","convocation_ending_time"));

		
		if(empty($_POST["faculties"])){
			$errors["empty"] = "At least one faculty must be selected";	
		}

		if(!empty($errors)){
 			$_SESSION["errors"] = $errors;
 			redirect_to("admin_convocation.php");
 		} else {

 			$convo_name = $_POST["convocation_name"];
 			$convo_date = $_POST["convocation_date"];
 			$convo_start= $_POST["convocation_starting_time"];
 			$convo_end =  $_POST["convocation_ending_time"];
 			$faculties =  $_POST["faculties"];

 			
 			

 			$id = get_last_convocation_id($conn) + 1;
 			$query = "INSERT INTO convocation ";
 			$query .= "values(";
 			$query .= "$id,'$convo_name','$convo_start','$convo_end','$convo_date'";
 			$query .= ")";

			$result = mysqli_query($conn,$query);
			confirm_query($result);

			foreach ($faculties as $key => $value) {
 				
 				$query = "INSERT INTO convocation_faculty ";
 				$query .= "values(";
 				$query .= "null,$id,'$value'";
 				$query .= ")";
				$result = mysqli_query($conn,$query);
				confirm_query($result);
 			}

			

			if($result) {
				$_SESSION["message"] = "Convocation successfully created. ";
				redirect_to("admin_convocation.php");
			} else {
				$_SESSION["message"] = "Failed to create the convocatoin";
				redirect_to("admin_convocation.php");
			}
 		}
	}


	$data = array(
		'view' => 'admin_convocation',
		'page_title' => "Convocations",
		'convocations' => $convocations,
		'tab'  => $tab
 	);

 	view($data);
?>