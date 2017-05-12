
 <?php
class Database {
	public $conn;
	public function getConnection () {
		
		require_once '../../config/config.php';
		$DB_HOST = constant('DB_HOST');
		$DB_NAME = constant('DB_DATABASE');
		$USER_NAME = constant('DB_USER');
		$DB_PASSWORD = constant('DB_PASSWORD');
		try {
			$this->conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $USER_NAME, $DB_PASSWORD);
    	}
    	catch(PDOException $e) {
    		echo "Connection failed: " . $e->getMessage();
    	}
    }
}
?>