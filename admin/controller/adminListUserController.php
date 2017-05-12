<?php
if(!$_SESSION['admin_email']) {
	header("Location: adminLoginView.php");
}

class adminListUserController {
	public $admin_conn_obj;
	public $user_list = array();

	public function __construct($connObj) { 
		$this->admin_conn_obj = $connObj;
	}
	public function selectUsersDetails () {

		$sql = "SELECT 
				*FROM tbl_users  
				ORDER BY user_id DESC";

		$result_set = $this->admin_conn_obj->query($sql);
		if ($result_set->num_rows > 0) {
			while ($row = $result_set->fetch_assoc()) {
				$user_list[$row['user_id']]['user_id'] = $row['user_id'];
                $user_list[$row['user_id']]['user_name'] = $row['user_name'];
                $user_list[$row['user_id']]['user_email'] = $row['user_email'];
                $user_list[$row['user_id']]['user_mobile'] = $row['user_mobile'];
                $user_list[$row['user_id']]['user_address'] = $row['user_address'];
                $user_list[$row['user_id']]['user_status'] = $row['user_status'];
			}
			return $user_list;
		}
	}
} 
?>