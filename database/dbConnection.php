<?php
class dbConnection {
public $conn;
	public function getConnection () {
		require_once '../../config/config.php';
		$this->conn = new mysqli(constant('DB_HOST'), constant('DB_USER'), constant('DB_PASSWORD'), constant('DB_DATABASE'));
		if($this->conn->connect_error) {
			die('Error in connection : '.$conn->connect_error);
		}
	}
}
?>