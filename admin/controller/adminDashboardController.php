<?php

if(!$_SESSION['admin_email']) {
	header("Location: adminLogin.html");
}
//require_once '../../database/dbConnection.php';

class adminDashboardController {
    public $admin_conn_obj;
    public $user_books = array();

    public function __construct($connObj) { 
        $this->admin_conn_obj = $connObj;
    }
    public function selectUsersBooks () {
        $sql = "SELECT 
                *FROM tbl_user_books 
                AS books JOIN tbl_users 
                AS users ON 
                users.user_id = books.book_user_id 
                ORDER BY book_id DESC";

        $result_set = $this->admin_conn_obj->query($sql);
            if ($result_set->num_rows > 0) {
                while ($row = $result_set->fetch_assoc()) {
                	$user_books[$row['book_id']]['book_id'] = $row['book_id'];
                	$user_books[$row['book_id']]['user_name'] = $row['user_name'];
                	$user_books[$row['book_id']]['book_title'] = $row['book_title'];
                	$user_books[$row['book_id']]['book_author'] = $row['book_author'];
                	$user_books[$row['book_id']]['book_publisher'] = $row['book_author'];
                	$user_books[$row['book_id']]['book_type'] = $row['book_author'];
                	$user_books[$row['book_id']]['book_status'] = $row['book_status'];
                }
                return $user_books;
            }
    }
}
?>