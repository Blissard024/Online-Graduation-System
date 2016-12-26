<?php 

	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
 	require_once("../includes/functions.php");
 	require_once("../includes/validation_functions.php");
	confrim_admin_login();
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
	<form id="generatorForm" action="#" method="POST">
			<input  id="add-seat" name="submit" value=" " >
			<div class="form-container">
				<ul>
					<li>
						<label>Label: </label>
						<input id="label" type="text" name="label">
					</li>

					<li>
						<label>Rows: </label>
						<input id="rows" type="text" name="rows">
					</li>
					<li>
						<label>Coloumns: </label>
						<input id="coloumns" type="text" name="coloumns">
					</li>
					<li>
						<label>Label Color: </label>
						<input type='color' name="color" id="color"  value='#000000'/>
					</li>
					<li>
						<label>Reservable: </label>
						<input type='checkbox' name="reservable" id="reservable" value="0" checked />
					</li>

						<input type="submit" id="generatorButton" name="submit"  value="Add Seats">
						<input type="submit" id="cancel" name="submit"  value="Cancel">				
						<p class="error"></p>
				</ul>
			</div>
		</form>
	<div  class="canvas">
		
	</div>
	<div id="saving" class="clue">
		<p>Saved</p>
	</div>
	<div id="loading" class="clue">
		<p>loading</p>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/seat_manager.js"></script>
	<script src='js/spectrum.js'></script>
	<script>
	$("#color").spectrum({
	    color: "#ECF0F1"
	});
	</script>

</body>
</html>