<?php
session_start();
if(!$_SESSION['admin_email']) {
	header("Location: ../view/adminLoginView.html");
}
//require_once '../../database/dbConnection.php';
require_once '../../autoloader/autoloader.php';

class BlockUser {

	public $admin_conn_obj;

	public function __construct($connObj) { 
		$this->admin_conn_obj = $connObj;
	}

	public function blockMyUser () {
		$user_id = $_GET['user_id'];
		$status = $_GET['user_status'];
		print_r($status);
		//print_r(expression)
		if($_GET['user_status'] == 'block') {
			$sql = "UPDATE tbl_users
					SET user_status = 'inactive' 
					WHERE user_id = '$user_id'";
		}
		if($_GET['user_status'] == 'unblock') {
			$sql = "UPDATE tbl_users
					SET user_status = 'active' 
					WHERE user_id = '$user_id'";	
		}

		$result_set = $this->admin_conn_obj->query($sql);
		if($result_set > 0) {
			//echo"<script>alert('User Had Blocked')</script>";
			echo"<script>location.href='../view/adminListUsersView.php'</script>";
		}
	}

}
$dbConnection = new dbConnection();
$dbConnection->getConnection();

$BlockUser = new BlockUser($dbConnection->conn);
$BlockUser->blockMyUser();
?>