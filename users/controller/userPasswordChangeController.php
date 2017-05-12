<?php
class userPasswordChangeController {
	private $user_new_password, $user_current_pwd, $user_confirm_pwd;
	public $user_conn_obj;
	private $input;
	public $user_form_errors = array();
	public $user_form_success = array();
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
		$this->user_current_pwd = $this->SanitizeInput($_POST['current_pwd']);
		$this->user_new_password = $this->SanitizeInput($_POST['new_pwd']);
		$this->user_confirm_pwd = $this->SanitizeInput($_POST['confirm_pwd']);
	}

	private function SanitizeInput ($data) {
		$this->input = trim($data);
  		$this->input = stripslashes($this->input);
  		$this->input = htmlspecialchars($this->input);
  		return $this->input;
	}

	public function validateInputs () {

		$pwd_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";

		if ($this->user_current_pwd == "" ) {
			array_push($this->user_form_errors, 'Fill Your Current Password');
		}
		if (empty($this->user_current_pwd) == false) {
			if (!(strlen($this->user_current_pwd) > 6) || !preg_match($pwd_pattern,$this->user_current_pwd) || !(strlen($this->user_current_pwd) < 16)) {
					array_push($this->user_form_errors, 'Invalid current Password Format');
			}
		}

		if(count($this->user_form_errors) == 0) {

			$user_id = $_SESSION['user_id'];
        	$sql = "SELECT user_pwd
                	FROM tbl_users 
                	WHERE user_id = '$user_id'";
        	$result_set = $this->user_conn_obj->query($sql);
        	$user_data = $result_set->fetch_assoc();

        	if ($user_data['user_pwd'] !== $this->user_current_pwd) {
        		array_push($this->user_form_errors, 'This is not your Current Password');
        	}

			if ($this->user_new_password == "" ) {
				array_push($this->user_form_errors, 'Fill Your New Password');
			}
			if (empty($this->user_new_password) == false) {

				if (!(strlen($this->user_new_password) > 6) || !preg_match($pwd_pattern,$this->user_new_password) || !(strlen($this->user_new_password) < 16)) {

					array_push($this->user_form_errors, 'Invalid New Password Format');
				}
			}

			if($this->user_new_password !== $this->user_confirm_pwd) {
					array_push($this->user_form_errors, 'New and Confirm Password Not match');
			}
		}
	}

	public function updatePassword () {
		if ($this->user_form_errors == false) {
			$new_pwd = $this->user_new_password;
			$user_id = $_SESSION['user_id'];
			$query = "UPDATE tbl_users
					  SET user_pwd = '$new_pwd'
					  WHERE user_id = $user_id";
			$result_set = $this->user_conn_obj->query($query);
			if($result_set > 0) {
				array_push($this->user_form_success, 'Password had been updated');
			}
			else {
    			array_push($this->user_form_errors, 'Password Updation Failed');
			}
		}
	}
	
}
?>