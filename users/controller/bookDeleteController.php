<?php
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
require_once '../../database/dbConnection.php';

class DeleteBookRecord {

	public $user_conn_obj;

	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function deleteBook () {
		$book_id = $_GET['book_id'];

		$sql = "DELETE 
				FROM tbl_user_books 
				WHERE book_id = '$book_id'";
		$result_set = $this->user_conn_obj->query($sql);
		echo"<script>location.href='../view/userBooksView.php'</script>";
		
	}

}
$Database = new Database();
$Database->getConnection();

$DeleteBookRecord = new DeleteBookRecord($Database->conn);
$DeleteBookRecord->deleteBook();
?>