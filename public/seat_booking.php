<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
 	require_once("../includes/validation_functions.php");
	confrim_student_login();

	$convo = get_convocation($_GET["id"],$conn);

	if(!$convo){
		die("No convocation event found");
	}

?>
<html>
<head>
	<title><?php echo $convo["convocation_name"] ?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/seat_arrangement.css">
	<link rel='stylesheet' href='css/spectrum.css' />


</head>
<body>
	<div class="transparent">
		<p class="message">Please select and book your desired seats.</p>
		<input id="buttonSave" type="submit" value="Nexts">
		<form method="post" action="apply_convocation.php">
			<input  type="submit" name="cancelConvocation" value="Cancel">
		</form>
	</div>
	<div class="viewer">
		<div  class="canvas">

		</div>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/seat_booker.js"></script>
	<script src='js/spectrum.js'></script>
	<script>
	$("#color").spectrum({
	    color: "#ECF0F1"
	});
	</script>

</body>
</html>