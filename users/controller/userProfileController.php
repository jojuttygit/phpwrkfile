<?php 
if(!$_SESSION['user_email']) {
	header("Location: view/bookshareview.php");
}
?>
<?php
class userProfileController {
    public $user_conn_obj;
    public $user_data = array();

    public function __construct($connObj) { 
        $this->user_conn_obj = $connObj;
    }

    public function getUserData() {
        $user_email = $_SESSION['user_email'];
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT 
                *FROM tbl_users 
                WHERE user_id = '$user_id'";
        $result_set = $this->user_conn_obj->query($sql);
        $this->user_data = $result_set->fetch_assoc();
    }            
}
?>