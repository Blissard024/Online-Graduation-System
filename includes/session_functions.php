<?php 
	session_start();

	function message(){
		if (isset($_SESSION["message"])){
			$output = "<div class=\"message\">";
			$output .= "<p>" . htmlentities($_SESSION["message"]). "</p>";
			$output .= "</div>";

			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors(){
		if (isset($_SESSION["errors"])){
			$output = $_SESSION["errors"];

			$_SESSION["errors"] = null;
			
			return $output;
		}
	}

?>