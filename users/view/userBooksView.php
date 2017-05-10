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
        			<li class="active"><a href="userBooksView.php">My Books</a></li>
        			<li><a href="userRentRequestView.php">Rent Request</a></li>
        			<li><a href="userAddBooksView.php">Add Books</a></li>
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
  require_once '../../database/dbConnection.php';
  class MyBooks {
    public $user_conn_obj;

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }
    public function selectMyBooks () {
    ?>
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                <tr>
                  <th>Book ID</th>
                  <th>Book Title</th>
                  <th>Book Author</th>
                  <th>Book Publisher</th>
                  <th>Book Type</th>
                  <th>Book Description</th>
                  <th>Book Status</th>
                  <th>Delete</th>
                </tr>
            </thead>
            <tbody>
          <?php
            $user_email = $_SESSION['user_email'];
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT 
                    *FROM 
                    tbl_user_books 
                    WHERE book_user_id = '$user_id'";
            
            $result_set = $this->user_conn_obj->query($sql);
            if ($result_set->num_rows > 0) {
        
              while ($row = $result_set->fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo $row['book_id']; ?></td>
                <td><?php echo $row['book_title']; ?></td>
                <td><?php echo $row['book_author']; ?></td>
                <td><?php echo $row['book_publisher']; ?></td>
                <td><?php echo $row['book_type']; ?></td>
                <td><?php echo $row['book_description']; ?></td>
                <td><?php echo $row['book_status']; ?></td>
                <td><a href="#" onclick="confirmDelete(<?php echo $row['book_id']; ?>)">delete</a></td>
              </tr>
              </tbody>
              <?php
              }
  
            }
        ?>
        </table>
      </div>
    </div>
    <?php
    }
  } 
  ?>
    </div>
   <script type="text/javascript" src="../../public/assets/js/bookshare.js"></script>
  </body>
</html>
<?php
$Database = new Database();
$Database->getConnection();

$MyBooks = new MyBooks($Database->conn);
$MyBooks->selectMyBooks();
?>