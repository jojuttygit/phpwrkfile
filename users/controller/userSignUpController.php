<?php

class userSignUpController {
	
	private $user_name, $user_mobile, $user_email, $user_password;
	public $user_conn_obj;

	private $input;
	public $user_form_errors = array();
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
		$this->user_name = $this->SanitizeInput($_POST['user_name']);
		$this->user_mobile = $this->SanitizeInput($_POST['user_mobile']);
		$this->user_email = $this->SanitizeInput($_POST['user_email']);
		$this->user_password = $this->SanitizeInput($_POST['user_pwd']);
		$this->user_confirm_password = $this->SanitizeInput($_POST['user_confirm_pwd']);
	}

	private function SanitizeInput ($data) {
		$this->input = trim($data);
  		$this->input = stripslashes($this->input);
  		$this->input = htmlspecialchars($this->input);
  		return $this->input;
	}

	public function validateInputs () {
		$NamePattern = "/^[a-zA-Z/'/-\040]+$/";
		$pwd_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";
		$mobile_pattern = "/^[0-9]+$/";

		if ($this->user_name == "") {
			array_push($this->user_form_errors, 'Must Fill the User Name');
		}
		if (!ctype_alpha($this->user_name)) {
			array_push($this->user_form_errors, 'Enter a Proper Name');
		}

		if ($this->user_mobile == "") {
			array_push($this->user_form_errors, 'Must Fill Your Mobile Number');
		}
		if (!preg_match($mobile_pattern, $this->user_mobile) || !strlen($this->user_mobile) == 10) {
			array_push($this->user_form_errors, 'Enter a Valid Mobile Number');
		}

		if ($this->user_email == "") {
			array_push($this->user_form_errors, 'Must Fill the Email Address');
		}
		if (empty($this->user_email) == false) {
			if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL) === false) {
				array_push($this->user_form_errors, 'Invalid Email Address');
			}
		}
		
		if ($this->user_password == "" ) {
			array_push($this->user_form_errors, 'Must Fill the Password');
		}

		if (empty($this->user_password) == false) {
			if (!(strlen($this->user_password) > 6) || !preg_match($pwd_pattern,$this->user_password) || !(strlen($this->user_password) < 16)) {
					array_push($this->user_form_errors, 'Invalid the Password');
			}
		}

		if ($this->user_password != $this->user_confirm_password) {
			array_push($this->user_form_errors, 'Password and Confirm Password Not Match');
		}
	}

	public function addUserData () {
		if (count($this->user_form_errors) == 0) {
			$sql_insert_user = "INSERT INTO 
								tbl_users(user_name,user_mobile,
								user_email,user_pwd,user_status) 
								VALUES('$this->user_name', 
								'$this->user_mobile',
								'$this->user_email',
								'$this->user_password',
								'active')";
									
			$result_set = $this->user_conn_obj->query($sql_insert_user);
			if($result_set > 0) {
				header("Location: userLoginView.php");
			}
		}
	}
}
?>