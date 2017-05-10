<?php
session_start();

require_once '../../database/dbConnection.php';

class ValidateLogin {
	private $user_input_email, $user_input_pwd;
	public $user_conn_obj;
	public $loginerror;
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function validateUser () {
		$this->user_input_email = $_POST['user_login_email'];
		$this->user_input_pwd = $_POST['user_login_pwd'];

		$sql = "SELECT 
				*FROM
				tbl_users 
				WHERE user_email = '$this->user_input_email'
				AND user_pwd = '$this->user_input_pwd' 
				AND user_status = 'active'";

			$result = $this->user_conn_obj->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION['user_email'] = $row['user_email'];
				$_SESSION['user_pwd'] = $row['user_pwd'];
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_id'] = $row['user_id'];
				header("Location: userDashboardView.php");
			}
			else {
			//echo"<script>alert('Invalid Login Credentials')</script>";
			header("Location: userLoginView.php");
			}	
	}
	
}
?>