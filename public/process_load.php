<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
 	require_once("../includes/functions.php");


 	  $id = $_POST["id"];
 	  $convo = get_convocation($id,$conn);
 	  if($convo){

	 	   $seats = get_convocation_seats($id,$conn);
		   if($seats){

			   	$results = array();
			   	foreach($seats as $seat)
			   	{	

			   	    $rows = $seat['rows'];
			   	    $coloumns = $seat['coloumns'];
			   	    $label = $seat['label'];
			   	    $x = $seat['left_position'];
			   	    $y = $seat['top_position'];
			   	    $color = $seat['color'];
			   	    $reservable = $seat['reservable'];
			   	    $z_index = $seat['z_index'];

			   	    $results[] = array("rows" => $rows, "coloumns" => $coloumns, "label" => $label,"x" => $x,"y" => $y, "color" => $color,"reservable" => $reservable,"z_index" => $z_index);
			   	}


			   	echo json_encode($results);


		   }



 	  }
	   
	   
 ?>