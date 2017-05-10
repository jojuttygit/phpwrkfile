<?php
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/userLoginView.php");
}
require_once '../../database/dbConnection.php';

class MakeRent {

	public $user_conn_obj;

	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function makeBookRent () {
		$book_id = $_GET['book_id'];
		$user_mail = $_SESSION['user_email'];
		$user_id = $_SESSION['user_id'];
		
		$sql = "INSERT INTO 
				tbl_book_renter(renter_user_id,renter_book_id,renter_status) 
				VALUES($user_id,$book_id,'pending')";
		
		$result_set = $this->user_conn_obj->query($sql);
		if($result_set > 0) {
			echo"<script>alert('Request Sented')</script>";
			echo"<script>location.href='../view/userDashboardView.php'</script>";
		}
		
	}

}
$Database = new Database();
$Database->getConnection();

$MakeRent = new MakeRent($Database->conn);
$MakeRent->makeBookRent();
?>