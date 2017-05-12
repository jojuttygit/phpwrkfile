<?php

require_once '../../autoloader/autoloader.php';

//require_once '../../database/dbConnection.php';
//require_once '../controller/bookshareController.php';

$dbConnection = new dbConnection();
$dbConnection->getConnection();

$bookshareController = new bookshareController($dbConnection->conn);
$bookshareController->pagination_count = constant('pagination');
$user_book_data = $bookshareController->selectMyBooks();
$page_count = $bookshareController->total_pages;

require_once 'template/bookshareViewHeader.php';

require_once 'booksharePaginationView.php';

require_once 'template/bookshareViewFooter.php';
?>
		