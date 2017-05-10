<?php

require_once '../../database/dbConnection.php';

class CreateUser {
	
	private $user_name, $user_mobile, $user_email, $user_password;
	public $user_conn_obj;
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function getUserData () {
		$this->user_name = $_POST['user_name'];
		$this->user_mobile = $_POST['user_mobile'];
		$this->user_email = $_POST['user_email'];
		$this->user_password = $_POST['user_pwd'];
	}

	public function addUserData () {
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
?>