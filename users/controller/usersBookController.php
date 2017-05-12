<?php 
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
?>
<?php
class usersBookController {
    public $user_conn_obj;
    public $book_list = array();

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }
    
    public function selectMyBooks () {
            $user_email = $_SESSION['user_email'];
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT 
                    *FROM 
                    tbl_user_books 
                    WHERE book_user_id = '$user_id'";
            
            $result_set = $this->user_conn_obj->query($sql);
            if ($result_set->num_rows > 0) {
                while ($row = $result_set->fetch_assoc()) {
                    $book_list[$row['book_id']]['book_id'] = $row['book_id'];
                    $book_list[$row['book_id']]['book_title'] = $row['book_title'];
                    $book_list[$row['book_id']]['book_author'] = $row['book_author'];
                    $book_list[$row['book_id']]['book_publisher'] = $row['book_publisher'];
                    $book_list[$row['book_id']]['book_type'] = $row['book_type'];
                    $book_list[$row['book_id']]['book_description'] = $row['book_description'];
                    $book_list[$row['book_id']]['book_status'] = $row['book_status'];
                }
                return $book_list;
            }
    }
} 
?>