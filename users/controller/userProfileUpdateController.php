<?php 
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
require_once '../../database/dbConnection.php';

class UpdateUser {
	
	private $user_name, $user_mobile, $user_address, $user_date;
	public $user_conn_obj;
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function getUserData () {
		$this->user_name = $_POST['user_name'];
		$this->user_mobile = $_POST['user_mobile'];
		$this->user_address = $_POST['user_address'];
		print_r($_POST['user_date']);
		$dob=date_create($_POST['user_date']);
		$this->user_date = date_format($dob,"Y/m/d");
	}

	public function updateUserData () {
		$user_email = $_SESSION['user_email'];
		$user_id = $_SESSION['user_id'];
		/*
		$query = "SELECT login_user_id FROM tbl_user_login WHERE login_user_email = '$user_email'";
		$result = $this->user_conn_obj->query($query);
		$userrow = $result->fetch_assoc();
		$user_id = $userrow['login_user_id'];
		*/
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
?>