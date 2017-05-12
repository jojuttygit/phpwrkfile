<?php
session_start();
if(!$_SESSION['admin_email']) {
	header("Location: adminLogin.html");
}
//require_once '../../database/dbConnection.php';
require_once '../../autoloader/autoloader.php';

class ChangePermission {

	public $admin_conn_obj;

	public function __construct($connObj) { 
		$this->admin_conn_obj = $connObj;
	}

	public function changeBookPermission () {
		$book_status = $_GET['book_status'];
		$book_id = $_GET['book_id'];
		print_r($book_id);

		if ($book_status == 'not_approved') {
			$sql = "UPDATE tbl_user_books 
					SET book_status = 'for_rent' 
					WHERE book_id = '$book_id'";
		}
		else {
			$sql = "UPDATE tbl_user_books 
					SET book_status = 'not_approved' 
					WHERE book_id = '$book_id'";
		}
		$result_set = $this->admin_conn_obj->query($sql);
		print_r($result_set);
		
		if($result_set > 0) {
			echo"<script>location.href='../view/adminDashboardView.php'</script>";
		}
		
	}

}
$dbConnection = new dbConnection();
$dbConnection->getConnection();

$ChangePermission = new ChangePermission($dbConnection->conn);
$ChangePermission->changeBookPermission();
?>