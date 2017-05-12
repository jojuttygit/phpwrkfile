<?php
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}

require_once '../../autoloader/autoloader.php';
//require_once '../../database/dbConnection.php';

class rentApprovalController {

	public $user_conn_obj;

	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function changeBookPermission () {
		$renter_id = $_GET['renter_id'];
		$renter_status = $_GET['renter_status'];
		$book_id = $_GET['book_id'];
		if ($renter_status == 'Approved') {
			$sql = "UPDATE 
					tbl_book_renter 
					SET renter_status = 'approved' 
					WHERE renter_id = '$renter_id'";
			$query = "UPDATE tbl_user_books 
					SET book_status = 'rented' 
					WHERE book_id = $book_id";
		}
		else {
			$sql = "UPDATE 
					tbl_book_renter 
					SET renter_status = 'released' 
					WHERE renter_id = '$renter_id'";
			$query = "UPDATE tbl_user_books 
					SET book_status = 'for_rent' 
					WHERE book_id = $book_id";
		}
		$result_set = $this->user_conn_obj->query($sql);
		$result = $this->user_conn_obj->query($query);
		if($result_set > 0 && $result > 0) {
			echo"<script>location.href='../view/userRentRequestView.php'</script>";
		}
	}
}
$dbConnection = new dbConnection();
$dbConnection->getConnection();

$rentApprovalController = new rentApprovalController($dbConnection->conn);
$rentApprovalController->changeBookPermission();
?>