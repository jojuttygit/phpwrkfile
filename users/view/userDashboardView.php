<?php 
session_start();
//require_once '../../database/dbConnection.php';
//require_once '../controller/bookshareController.php';

require_once '../../autoloader/autoloader.php';

if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}

$dbConnection = new dbConnection();
$dbConnection->getConnection();

$bookshareController = new bookshareController($dbConnection->conn);
$bookshareController->pagination_count = constant('pagination');
$user_book_data = $bookshareController->selectMyBooks();
$page_count = $bookshareController->total_pages;

require_once 'template/userHomeHeader.php';

require_once 'booksharePaginationView.php';

require_once 'template/userHomeFooter.php';

?>
<script type="text/javascript" src="../../public/assets/js/bookshare.js"></script>
  

