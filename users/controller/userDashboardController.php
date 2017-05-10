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
        			<li class="active"><a href="userDashBoard.php">Home</a></li>
        			<li><a href="userBooks.php">My Books</a></li>
        			<li><a href="userRentRequest.php">Rent Request</a></li>
        			<li><a href="userAddBook.php">Add Books</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      					<span class="glyphicon glyphicon-user"></span><?php echo " Hi, ".$_SESSION['user_name'] ?> <span class="caret"></span></a>
      					<ul class="dropdown-menu">
      						<li><a href="userProfile.php">My profile</a></li>
          					<li><a href="userLogout.php">Logout</a></li>
        				</ul>
        			</li>
    			</ul>
    		</div>
  		</div>
	</nav>
<?php
  require_once '../../database/dbConnection.php';
  class MyBooks {
    public $user_conn_obj,$pagination_count,$page;

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }

    public function selectMyBooks () {
    	if (isset($_GET["page"])) { 
				$page  = $_GET["page"]; 
		} 
		else { 
		$page = 1; 
		}
		 if(!empty($_POST['searchbtn'])) {
            	
            	$search_item = $_POST['search_item'];
            	
            } 
            else {
            	$search_item = "";
            }
		$start_from = ($page-1) * $this->pagination_count; 
    	$query = "SELECT *FROM tbl_user_books AS books JOIN tbl_users AS users ON books.book_user_id = users.user_id WHERE book_status = 'for_rent' AND book_title like '%".$search_item."%'";    
        $tbl_user_books = $this->user_conn_obj->query($query);
        $total_records = $tbl_user_books->num_rows;
		$total_pages = ceil($total_records / $this->pagination_count);
		?>
		<div class="container-fluid">
			<div class="row" id="searchbox">
				<div class="col-lg-5">
					<form action="userDashBoard.php" method="POST">
    				<div class="input-group">
      					<input type="text" class="form-control" placeholder="Search" name="search_item">
      					<div class="input-group-btn">
        					<button class="btn btn-default" name="searchbtn" value="search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      					</div>
    				</div>
  					</form>
  				</div>
  			</div>
			<div class="row">
				<div class="col-lg-12">
				<ul class="pagination pagination">
					<?php
					echo "<li><a href='userDashBoard.php?page=1'>".'<'."</a></li> ";
					for ($i=1; $i<=$total_pages; $i++) { 
            			echo "<li><a href='userDashBoard.php?page=".$i."'>".$i."</a></li> "; 
					}
					echo "<li><a href='userDashBoard.php?page=$total_pages'>".'>'."</a></li> ";
					 ?>
  				</ul>
  				</div>
			</div>
		</div>
    	<div class="container-fluid">
    
          <?php
            $user_email = $_SESSION['user_email'];
           
            $sql = "SELECT *FROM tbl_user_books AS books JOIN tbl_users AS users ON books.book_user_id = users.user_id WHERE book_status = 'for_rent' AND book_title like '%".$search_item."%'  LIMIT $start_from, $this->pagination_count";
            
            $result_set = $this->user_conn_obj->query($sql);
            if ($result_set->num_rows > 0) {
        
              while ($row = $result_set->fetch_assoc()) {
              ?>
                <div class="row text-left">
             
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <img class="img-thumbnail img-responsive" src=<?php echo "book_cover_images/".$row['book_image_name'] ?> alt=<?php echo $row['book_title']?> width="180" height="180">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 class="text-success">Book Title : <?php echo $row['book_title']?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="text-info">Book Type : <?php echo $row['book_type']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="text-info">Author : <?php echo $row['book_author']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="text-info">Publisher : <?php echo $row['book_publisher']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="text-info">Description : <?php echo $row['book_description']?></p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-lg-12">
                                                <input type="button" class="btn btn-warning" value="Make Rent" onclick="makeRent(<?php echo $row['book_id']?>)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
              <?php
              }
  
            }
        ?>
    </div>
		<?php
    }
  } 
  ?>
    <script type="text/javascript" src="../../public/assets/js/bookshare.js"></script>
  </body>
</html>
<?php
$Database = new Database();
$Database->getConnection();

$MyBooks = new MyBooks($Database->conn);
$MyBooks->pagination_count = constant('pagination');
$MyBooks->selectMyBooks();
?>
