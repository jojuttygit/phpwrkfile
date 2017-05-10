<?php
require_once '../../database/dbConnection.php';
class ValidateAdminLogin {
	private $admin_input_email, $admin_input_pwd;
	public $admin_conn_obj;
	
	public function __construct($connObj) { 
		$this->admin_conn_obj = $connObj;
	}

	public function validateAdmin () {
		$this->admin_input_email = $_POST['admin_email'];
		$this->admin_input_pwd = $_POST['admin_pwd'];

		$sql = "SELECT 
				admin_email,admin_name 
				FROM tbl_admin 
				WHERE admin_email = '$this->admin_input_email'
				AND admin_pwd = '$this->admin_input_pwd'";
			
			$result = $this->admin_conn_obj->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION['admin_email'] = $row['admin_email'];
				$_SESSION['admin_name'] = $row['admin_name'];
				header("Location: ../view/adminDashboardView.php");
			}
			else {
				echo"<script>alert('Invalid Login Credentials')</script>";
				echo"<script>location.href='adminLoginView.php'</script>";
			}
	}
}
?>