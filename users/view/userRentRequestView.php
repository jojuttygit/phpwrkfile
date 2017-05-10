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
        			<li class="active"><a href="userRentRequestView.php">Rent Request</a></li>
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
  class RenterRequest {
    public $user_conn_obj;

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }
    public function selectReuests () {
    ?>
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                <tr>
                  <th>Book ID</th>
                  <th>Book Title</th>
                  <th>Book Author</th>
                  <th>Renter</th>
                  <th>Request Status</th>
                  <th>Approve</th>
                  <th>Release</th>
                </tr>
            </thead>
            <tbody>
          <?php
            $user_email = $_SESSION['user_email'];
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT 
                    *FROM tbl_book_renter 
                    AS renter JOIN tbl_user_books 
                    AS books 
                    ON renter.renter_book_id = books.book_id 
                    JOIN tbl_users 
                    AS users 
                    ON users.user_id = books.book_user_id 
                    WHERE books.book_user_id = '$user_id'";
            
            $result_set = $this->user_conn_obj->query($sql);
            $row = $result_set->fetch_assoc();
            
            if ($result_set->num_rows > 0) {
        
              while ($row = $result_set->fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo $row['book_id']; ?></td>
                <td><?php echo $row['book_title']; ?></td>
                <td><?php echo $row['book_author']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['renter_status']; ?></td>
                <td><a href="../controller/rentApprovalController.php?renter_id=<?php echo $row['renter_id']; ?>&book_id=<?php echo $row['book_id']; ?>&renter_status=Approved">Approved</a></td>
                <td><a href="../controller/rentApprovalController.php?renter_id=<?php echo $row['renter_id']; ?>&book_id=<?php echo $row['book_id']; ?>&renter_status=Release" >Release</a></td>
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

$RenterRequest = new RenterRequest($Database->conn);
$RenterRequest->selectReuests();
?>