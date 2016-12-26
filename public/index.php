<?php 
	
	require_once("../includes/validation_functions.php");
	require_once("../includes/db_connection.php");
	require_once("../includes/db_functions.php");
	require_once("../includes/session_functions.php");
	require_once("../includes/functions.php");


	if (isset($_POST["submit"])){
		
		validate_presences(array("username","password"));

		if(!empty($errors)){
			$_SESSION["errors"] = $errors;
 			redirect_to("index.php");
		}

		$username = $_POST["username"]; 
 		$password = $_POST["password"];

		if ($user = get_by_username('admin',$username,$conn)) {
			if(password_verify($password, $user["password"])){
				$_SESSION["username"] = $user["username"];
 				$_SESSION["admin"] = true;
 				redirect_to("admin_profile.php");
			}
 			$_SESSION["message"] = "Username or password is incorrect.";
			
		} elseif ($user = get_by_username('student',$username,$conn)) {
			if(password_verify($password, $user["password"])){
				$_SESSION["username"] = $user["username"];
 				$_SESSION["student"] = false;
 				$_SESSION["step"] = 0;
 				redirect_to("student_profile.php?id={$user["student_id"]}");
			}
 			$_SESSION["message"] = "Username or password is incorrect.";
		} else {
 			$_SESSION["message"] = "Username or password is incorrect.";
			redirect_to("index.php");
 		}
	}


?>

<html>
<head>
	<title>Online Graduation System</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<img class="bg" src="img/login-bg.jpg">
	<!-- absolute positioning used to acheive transparent background -->
	<!-- login-background is the white background -->
	<div class="Login-background"></div>
	<div class="login-form">
		<h2>Online Graduation System</h2>
		<form action="index.php" method="POST">
			<ul>
				<li>
					<label  for="username">Username</label>
					<input autofocus type="text" name="username" id="username" >
				</li>
				<li>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" >
				</li>
				<li>
					<input type="submit" name="submit" value="Login"></input>
				</li>
			</ul>
			<?php 
				echo message();
				$errors = errors();
				echo form_errors($errors);
			?>
		</form>
	</div>
	
</body>
</html>