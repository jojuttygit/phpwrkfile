<?php

class adminLoginController {
	private $admin_input_email, $admin_input_pwd;
	public $admin_conn_obj;
	private $input;
	public $user_form_errors = array();
	
	public function __construct($connObj) { 
		$this->admin_conn_obj = $connObj;
		$this->admin_input_email = $this->SanitizeInput($_POST['admin_email']);
		$this->admin_input_pwd = $this->SanitizeInput($_POST['admin_pwd']);
	}

	private function SanitizeInput ($data) {
		$this->input = trim($data);
  		$this->input = stripslashes($this->input);
  		$this->input = htmlspecialchars($this->input);
  		return $this->input;
	}
	
	public function validateInputs () {
		$pwd_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";
		if ($this->admin_input_email == "") {
			array_push($this->user_form_errors, 'Must Fill the Email Address');
		}
		if (empty($this->admin_input_email) == false) {
			if (filter_var($this->admin_input_email, FILTER_VALIDATE_EMAIL) === false) {
				array_push($this->user_form_errors, 'Invalid Email Address');
			}
		}
		if ($this->admin_input_pwd == "" ) {
			array_push($this->user_form_errors, 'Must Fill the Password');
		}
		if (empty($this->admin_input_pwd) == false) {
			if (!(strlen($this->admin_input_pwd) > 6) || !preg_match($pwd_pattern,$this->admin_input_pwd) || !(strlen($this->admin_input_pwd) < 16)) {
					array_push($this->user_form_errors, 'Invalid the Password');
			}
		}
	}

	public function validateAdmin () {
		if (count($this->user_form_errors) == 0) {

				$sql = "SELECT count(*) as row_count,
						admin_email,admin_name
						FROM tbl_admin 
						WHERE admin_email = :username 
						AND admin_pwd = :password";
				

				$stmt = $this->admin_conn_obj->prepare($sql); 
   				$stmt->bindParam(":username" ,$this->admin_input_email);
				$stmt->bindParam(":password" ,$this->admin_input_pwd);
				$stmt->execute();

				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$row_count = $result['row_count'];
				if($row_count > 0) {
					$_SESSION['admin_email'] = $result['admin_email'];
					$_SESSION['admin_name'] = $result['admin_name'];
					header("Location: ../view/adminDashboardView.php");
				}
				else {
    				array_push($this->user_form_errors, 'Invalid User Credentials');
				}
		}
	}
}
?> 