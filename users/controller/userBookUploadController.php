<?php
require_once '../../database/dbConnection.php';
class UploadBook {
	
	private $book_title, $book_author, $book_publisher, $book_type, $book_description;
	private $cover_image_name, $upload_book_name;
	public $user_conn_obj;
	
	public function __construct($connObj) { 
		$this->user_conn_obj = $connObj;
	}

	public function getBookData () {
		$this->book_title = $_POST['book_title'];
		$this->book_author = $_POST['book_author'];
		$this->book_publisher = $_POST['book_publisher'];
		$this->book_type = $_POST['book_type'];
		$this->book_description = $_POST['book_description'];

		$sql = "SELECT MAX(book_id) AS counter from tbl_user_books;";

		$result = $this->user_conn_obj->query($sql);
		$row = $result->fetch_assoc();
		if($row['counter'] == null)
		{
			$file_temp_name = 1;
			$file_name = $file_temp_name.rand(999,9999);
		}
		else {
			$file_temp_name = $row['counter'] + 1;
			$file_name = $file_temp_name.rand(999,9999);
		}
		
		if(!empty($_FILES['cover_image']))
		{
			$cover_image = constant('cover_image_folder');
    		$cover_image_path = "../../public/assets/images/$cover_image/";
    		$image_ext = pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
    		$cover_image_path = $cover_image_path.$file_name;
    		$this->cover_image_name = $file_name;
    		move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_path);
		}
		if(!empty($_FILES['upload_book']))
		{	
			$book_folder = constant('book_upload_folder');

    		$book_path = "../../public/assets/images/$book_folder/";
    		$book_ext = pathinfo($_FILES['upload_book']['name'], PATHINFO_EXTENSION);
    		$book_path = $book_path.$file_name;
    		$this->upload_book_name = $file_name;
    		move_uploaded_file($_FILES['upload_book']['tmp_name'], $book_path);
		}
	}

	public function addBookData () {
		$user_id = $_SESSION['user_id'];
		$sql_add_book = "INSERT INTO 
							tbl_user_books(book_title,book_author,book_publisher,book_type,book_description,book_image_name,book_upload_name,book_status,book_user_id) 
							VALUES('$this->book_title', 
								'$this->book_author', 
								'$this->book_publisher', 
								'$this->book_type', 
								'$this->book_description', 
								'$this->cover_image_name', 
								'$this->upload_book_name', 
								'not_approved', 
								$user_id)";
		$result_set = $this->user_conn_obj->query($sql_add_book);
		if ($result_set > 0) {
			echo"<script>alert('Book Added')</script>";
			echo"<script>location.href='userAddBooksView.php'</script>";
		}
		else {
			echo"<script>alert('Book Not Added')</script>";	
		}
	}

}
?>