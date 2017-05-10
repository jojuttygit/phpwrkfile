<?php 
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
?>
<!DOCTYPE html>
<head>
	<title>Book Share</title>
	 <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- External css -->
	<link rel="stylesheet" type="text/css" 
                            href="../../public/assets/css/bookShareusers.css" />
</head>
<body>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bookShareNav">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      			</button>
      			<a class="navbar-brand" href="#">Book Share</a>
    		</div>
    		<div class="collapse navbar-collapse" id="bookShareNav">
      			<ul class="nav navbar-nav">
        			<li><a href="userDashboardView.php">Home</a></li>
        			<li><a href="userBooksView.php">My Books</a></li>
        			<li><a href="userRentRequestView.php">Rent Request</a></li>
        			<li class="active"><a href="userAddBooksView.php">Add Books</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      					<span class="glyphicon glyphicon-user"></span><?php echo " Hi, ".$_SESSION['user_name'] ?> <span class="caret"></span></a>
      					<ul class="dropdown-menu">
      						<li><a href="userProfileView.php">My profile</a></li>
          					<li><a href="../controller/userLogoutController.php">Logout</a></li>
        				</ul>
        			</li>
    			</ul>
    		</div>
  		</div>
	</nav>
    <?php
    require_once '../controller/userBookUploadController.php';
    class UserAddBooksView {
        public function __construct() { 
            ?>
        <script type="text/javascript" src="../../public/assets/js/userAddBook.js"></script>
        <div class="container">
          <div class="row">
            <div class ="col-lg-10">
                <form name="bookupload" method="POST" onsubmit ="return validateAddBook();" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="book_name">Book Title</label>
                    <input type="text" name="book_title" class="form-control" placeholder="Enter book name" onfocusout = "return validateAddBook()" required>
                </div>
                <div class="form-group">
                    <label for="book_author">Book author</label>
                    <input type="text" name="book_author" class="form-control" placeholder="Enter author name" onfocusout = "return validateAddBook()" required>
                    <span id="error_author_name"></span>
                </div>
                <div class="form-group">
                    <label for="book_publisher">Book Publisher</label>
                    <input type="text" name="book_publisher" class="form-control" placeholder="Enter publisher" onfocusout = "return validateAddBook()" required>
                </div>
                <div class="form-group">
                    <label for="book_type">Book Type</label>
                    <input type="text" name="book_type" class="form-control" placeholder="Category of Book" onfocusout = "return validateAddBook()" required>
                    <span id="error_book_type"></span>
                </div>
                <div class="form-group">
                    <label for="book_description">Description</label>
                    <textarea class="form-control" rows="5" id="comment" name="book_description" onfocusout = "return validateAddBook()" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Cover image</label>
                    <label class="custom-file">
                        <input type="file" id="cover_image" name="cover_image" class="custom-file-input" accept="image/*" onfocusout = "return validateAddBook()" required>
                        <span class="custom-file-control"></span>
                    </label>
                    <span id="error_image"></span>
                </div>
                <div class="form-group">
                    <label for="upload_book">Upload Book</label>
                    <label class="custom-file">
                        <input type="file" id="upload_book" name="upload_book" class="custom-file-input" onfocusout = "return validateAddBook()" required>
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

        <?php
        }
    }
    ?>
<?php
$UserAddBooksView = new UserAddBooksView;
if (isset($_POST['submit'])) {
    $Database = new Database();
    $Database->getConnection();

    $UploadBook = new UploadBook($Database->conn);
    $UploadBook->getBookData();
    $UploadBook->addBookData();    
}
?>

</body>
</html>