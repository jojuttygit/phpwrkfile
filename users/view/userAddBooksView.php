<?php 
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
//require_once '../../database/dbConnection.php';
//require_once '../controller/userBookUploadController.php';

require_once '../../autoloader/autoloader.php';

require_once 'template/userHomeHeader.php';

if (isset($_POST['submit'])) {
    $dbConnection = new dbConnection();
    $dbConnection->getConnection();

    $userBookUploadController = new userBookUploadController($dbConnection->conn);
    $userBookUploadController->getBookData();
    $userBookUploadController->validateInputs();
    $form_errors = $userBookUploadController->addBookData();
}    
?>
<div class="container">
    <div class="row">
        <div class ="col-lg-10">
            <form name="bookupload" method="POST" onsubmit ="return validateAddBook();" enctype="multipart/form-data">
        <div class="form-group">
            <label for="book_name">Book Title</label>
            <input type="text" name="book_title" class="form-control" placeholder="Enter book name" onfocusout = "return validateTitle()" required>
            <span id="title_error_id"></span>
        </div>
        <div class="form-group">
            <label for="book_author">Book author</label>
            <input type="text" name="book_author" class="form-control" placeholder="Enter author name" onfocusout = "return validateAuthor()" required>
            <span id="error_author_name"></span>
        </div>
        <div class="form-group">
            <label for="book_publisher">Book Publisher</label>
            <input type="text" name="book_publisher" class="form-control" placeholder="Enter publisher" onfocusout = "return validatePublisher()" required>
            <span id="publisher_error_id"></span>
        </div>
        <div class="form-group">
            <label for="book_type">Book Type</label>
            <input type="text" name="book_type" class="form-control" placeholder="Category of Book" onfocusout = "return validateBookType()" required>
            <span id="error_book_type"></span>
        </div>
        <div class="form-group">
            <label for="book_description">Description</label>
            <textarea class="form-control" rows="5" id="comment" name="book_description" required></textarea>
        </div>
        <div class="form-group">
            <label for="cover_image">Cover image</label>
            <label class="custom-file">
                <input type="file" id="cover_image" name="cover_image" class="custom-file-input" accept="image/*" onfocusout = "return validateCoverImg()" required>
                <span class="custom-file-control"></span>
            </label>
            <span id="error_image"></span>
        </div>
        <div class="form-group">
            <label for="upload_book">Upload Book</label>
            <label class="custom-file">
                <input type="file" id="upload_book" name="upload_book" class="custom-file-input" onfocusout = "return validateBook()" required>
                <span class="custom-file-control"></span>
            </label>
            <span id="error_doc"></span>
        </div>
        <div class="text-right">
                <button type="submit" id="bookupload" name="submit" value="upload" class="btn btn-success">Upload Book</button>
        </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../public/assets/js/userAddBook.js"></script>
<br>
<?php
if (isset($_POST['submit'])) {
    if($form_errors) { 
    foreach ($form_errors as $value) {
        ?>
        <div class="alert alert-danger">
            <strong><?php echo $value; ?></strong>
        </div>
        <?php
    }
    }
}
?>
<?php
require_once 'template/userHomeFooter.php';

?>