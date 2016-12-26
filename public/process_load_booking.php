<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");


 	  $id = $_POST["id"];
 	  $convo = get_convocation($id,$conn);
 	  if($convo){

	 	   $tickets = get_tickets($id,$conn);
		   if($tickets){

			   	$results = array();
			   	foreach($tickets as $ticket)
			   	{	

			   	    $first_seat_number = $ticket['first_seat_number'];
			   	    $second_seat_number = $ticket['second_seat_number'];
			   	    

			   	    $results[] = array("first_seat_number" => $first_seat_number, "second_seat_number" => $second_seat_number);
			   	}


			   	echo json_encode($results);


		   }

 	  }
	   
	   
 ?>