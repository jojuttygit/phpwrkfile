<?php
class ValidateLogin {
	private $user_input_email, $user_input_pwd;
	public $user_conn_obj;
	private $input;
	public $user_form_errors = array();
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
		$this->user_input_email = $this->SanitizeInput($_POST['user_login_email']);
		$this->user_input_pwd = $this->SanitizeInput($_POST['user_login_pwd']);
	}

	private function SanitizeInput ($data) {
		$this->input = trim($data);
  		$this->input = stripslashes($this->input);
  		$this->input = htmlspecialchars($this->input);
  		return $this->input;
	}

	public function validateInputs () {
		$pwd_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";
		if ($this->user_input_email == "") {
			array_push($this->user_form_errors, 'Must Fill the Email Address');
		}
		if (empty($this->user_input_email) == false) {
			if (filter_var($this->user_input_email, FILTER_VALIDATE_EMAIL) === false) {
				array_push($this->user_form_errors, 'Invalid Email Address');
			}
		}
		if ($this->user_input_pwd == "" ) {
			array_push($this->user_form_errors, 'Must Fill the Password');
		}
		if (empty($this->user_input_pwd) == false) {
			if (!(strlen($this->user_input_pwd) > 6) || !preg_match($pwd_pattern,$this->user_input_pwd) || !(strlen($this->user_input_pwd) < 16)) {
					array_push($this->user_form_errors, 'Invalid the Password');
			}
		}
	}

	public function validateUser () {

		if (count($this->user_form_errors) == 0) {

			$sql = "SELECT count(*) as row_count,
							user_email,user_name,user_id
							FROM tbl_users 
							WHERE user_email = :username 
							AND user_pwd = :password
							AND user_status = 'active'";
			$stmt = $this->user_conn_obj->prepare($sql); 
   			$stmt->bindParam(":username" ,$this->user_input_email);
			$stmt->bindParam(":password" ,$this->user_input_pwd);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$row_count = $result['row_count'];
				if($row_count > 0) {
					$_SESSION['user_email'] = $result['user_email'];
					$_SESSION['user_name'] = $result['user_name'];
					$_SESSION['user_id'] = $result['user_id'];
					header("Location: userDashboardView.php");
				}
				else {
    				array_push($this->user_form_errors, 'Invalid User Credentials');
				}
		}
	}
	
}
?>