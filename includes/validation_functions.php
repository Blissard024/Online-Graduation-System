<?php 

	$errors = array();

	function fieldname_as_text($fieldname){
		$fieldname = str_replace("_"," ",$fieldname);
		$fieldname = ucfirst($fieldname);
		return $fieldname;
	}
	
	function has_presence($value){
		return isset($value) && $value !== "";
	}



	function isInteger($input){
    return(ctype_digit(strval($input)));
}

	function validate_presences($required_fields){
		global $errors;

			foreach($required_fields as $field){
				$value = trim($_POST[$field]);
				if (!has_presence($value)){
					$errors[$field] = fieldname_as_text($field) . " cannot be blank"; 
				} 
			}
	}


	function validate_intTypes($required_fields){
		global $errors;

			foreach($required_fields as $field){
				$value = trim($_POST[$field]);
				if (!isInteger($value)){
					$errors[$field] = fieldname_as_text($field) . " must be an integer"; 
				} 
			}
	}

	function is_valid_time($time){

		if (preg_match("/^(0[0-9]|1[0-2]):[0-5][0-9] (AM|PM)$/", $time)){
			return true;
		} else {
			return false;
		}
	}



	function validate_time_format($required_fields){
		global $errors;

			foreach($required_fields as $field){
				if (!is_valid_time($_POST[$field])){
					$errors[$field] = fieldname_as_text($field) . " is in invalid format"; 
				} 
			}
	}

	




?>