<?php 
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}

class userProfileUpdateController {
	
	private $user_name, $user_mobile, $user_address, $user_date;
	public $user_conn_obj;
	public $user_form_errors = array();
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
		$this->user_name = $this->SanitizeInput($_POST['user_name']);
		$this->user_mobile = $this->SanitizeInput($_POST['user_mobile']);
		$this->user_address = $this->SanitizeInput($_POST['user_address']);
		$dob=date_create($_POST['user_date']);
		$this->user_date = date_format($dob,"Y/m/d");
	}

	private function SanitizeInput ($data) {
		$this->input = trim($data);
  		$this->input = stripslashes($this->input);
  		$this->input = htmlspecialchars($this->input);
  		return $this->input;
	}

	public function validateInputs () {
		$NamePattern = "/^[a-zA-Z/'/-\040]+$/";
		$mobile_pattern = "/^[0-9]+$/";

		if ($this->user_name == "") {
			array_push($this->user_form_errors, 'Must Fill the User Name');
		}
		if (empty($this->user_name) == false) {
			if (!ctype_alpha($this->user_name)) {
				array_push($this->user_form_errors, 'Enter a Proper Name');
			}
		}

		if ($this->user_mobile == "") {
			array_push($this->user_form_errors, 'Must Fill Your Mobile Number');
		}
		if (empty($this->user_mobile) == false) {
			if (!preg_match($mobile_pattern, $this->user_mobile) || !strlen($this->user_mobile) == 10) {
				array_push($this->user_form_errors, 'Enter a Valid Mobile Number');
			}
		}
	}

	public function updateUserData () {
		if (count($this->user_form_errors) == 0) {
		$user_email = $_SESSION['user_email'];
		$user_id = $_SESSION['user_id'];
		$sql_update_user = "UPDATE 
							tbl_users 
							SET user_name = '$this->user_name',
								user_mobile = '$this->user_mobile',
								user_address = '$this->user_address',
								user_dob = '$this->user_date' 
							WHERE user_id = '$user_id'";
		$result_set = $this->user_conn_obj->query($sql_update_user);
		if($result_set > 0) {
			$_SESSION['user_name'] = $this->user_name;
			header("Location: ../view/userProfileView.php");
		}
		}
	}

}
?>