<?php 
if(!$_SESSION['user_email']) {
    header("Location: ../view/bookshareview.php");
}
?>
<?php

class userRentRequestController {
    public $user_conn_obj;
    public $rent_request = array();

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }
    
    public function selectReuests () {
        $user_email = $_SESSION['user_email'];
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT 
                *FROM tbl_book_renter 
                AS renter JOIN tbl_user_books 
                AS books 
                ON renter.renter_book_id = books.book_id 
                JOIN tbl_users 
                AS users 
                ON users.user_id = renter.renter_user_id 
                WHERE books.book_user_id = '$user_id'";
        $result_set = $this->user_conn_obj->query($sql);
        $row = $result_set->fetch_assoc();
        if ($result_set->num_rows > 0) {
            while ($row = $result_set->fetch_assoc()) {
                $this->rent_request[$row['renter_id']]['book_id'] = $row['book_id'];
                $this->rent_request[$row['renter_id']]['renter_id'] = $row['renter_id'];
                $this->rent_request[$row['renter_id']]['book_title'] = $row['book_title'];
                $this->rent_request[$row['renter_id']]['book_author'] = $row['book_author'];
                $this->rent_request[$row['renter_id']]['user_name'] = $row['user_name'];
                $this->rent_request[$row['renter_id']]['renter_status'] = $row['renter_status'];
            }
            return $this->rent_request;
        }
    }
} 
?>