<?php
session_start();
//if(!$_SESSION['admin_email']) {
//	header("Location: adminLoginView.php");
//}
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	 <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- External css -->
	<link rel="stylesheet" type="text/css" 
                        href="../../public/assets/css/bookShareAdmin.css" />
</head>
<body>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="#">Book Share</a>
   			</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="adminDashboardView.php">Books</a></li>
      			<li><a href="adminListUsersView.php">Users</a></li>
    		</ul>
    		<ul class="nav navbar-nav navbar-right">
      			<li><a class="dropdown-toggle" data-toggle="dropdown" href="adminListUsersView.php">
      				<span class="glyphicon glyphicon-user"></span><?php echo " Hi, ".$_SESSION['admin_name'] ?> <span class="caret"></span></a>
      				<ul class="dropdown-menu">
          				<li><a href="../controller/adminLogoutController.php">Logout</a></li>
        			</ul>
        		</li>
    		</ul>
  		</div>
	</nav>
  <?php
  require_once '../../database/dbConnection.php';
  class ListBooks {
    public $admin_conn_obj;

    public function __construct($connObj) { 
      $this->admin_conn_obj = $connObj;
    }
    public function selectUsersBooks () {
    ?>
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                <tr>
                  <th>Book ID</th>
                  <th>Uploader</th>
                  <th>Book Title</th>
                  <th>Book Author</th>
                  <th>Book Publisher</th>
                  <th>Book Type</th>
                  <th>Book Status</th>
                  <th>Book Permission</th>
                </tr>
            </thead>
            <tbody>
          <?php
            $sql = "SELECT 
                        *FROM tbl_user_books 
                        AS books JOIN tbl_users 
                        AS users ON 
                        users.user_id = books.book_user_id 
                        ORDER BY book_id DESC";

            $result_set = $this->admin_conn_obj->query($sql);
            if ($result_set->num_rows > 0) {
        
                while ($row = $result_set->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['book_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['book_publisher']; ?></td>
                    <td><?php echo $row['book_type']; ?></td>
                    <td><?php echo $row['book_status']; ?></td>
                    <td><a href="../controller/adminBookPermissionController.php?book_status=<?php echo $row['book_status']; ?>&book_id=<?php echo $row['book_id']; ?>">Change Permission</a></td>
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
  </body>
</html>
<?php
$Database = new Database();
$Database->getConnection();

$ListBooks = new ListBooks($Database->conn);
$ListBooks->selectUsersBooks();
?>