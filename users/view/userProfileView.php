<?php 
session_start();
if(!$_SESSION['user_email']) {
	header("Location: view/bookshareview.php");
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
        			<li class="active"><a href="userDashboardView.php">Home</a></li>
        			<li><a href="userBooksView.php">My Books</a></li>
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

  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><small>Update Your Profile</small></h1>
        </div>
    </div>
    </div>
    <?php
    require_once '../../database/dbConnection.php';
    class UserProfile {
    public $user_conn_obj;

    public function __construct($connObj) { 
      $this->user_conn_obj = $connObj;
    }
    public function getUserData() {
        $user_email = $_SESSION['user_email'];
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT 
                *FROM tbl_users 
                WHERE user_id = '$user_id'";
        $result_set = $this->user_conn_obj->query($sql);
        $row = $result_set->fetch_assoc();
        ?>

        <div class="container">
        <div class="row">
        <div class="col-lg-8">
            <form method="POST" name="updateUserProfile" onsubmit="return validateupdate();">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="user_name" class="form-control" placeholder="Enter name" onfocusout = "return validateupdate()" value=<?php echo $row['user_name'] ?> required>
                    <span id="error_name"></span>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="user_mobile" class="form-control" value=<?php echo $row['user_mobile'] ?> placeholder="Enter mobile number">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" rows="5" name="user_address" id="comment" placeholder="Enter Address"><?php echo $row['user_address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="datepicker" name="user_date" value = <?php echo $row['user_dob'] ?> class="form-control">
                </div>
                <div class="text-right">
                    <button type="submit" id="profileUpdate" name="user_update" value="user_update" class="btn btn-success">Update Profile</button>
                </div>
            </form>
        </div>
        </div>
        <?php
        require '../controller/userProfileUpdateController.php';
    }            
    }
    ?>
    
</div>

<script type="text/javascript" src="../../public/assets/js/updateUserProfile.js"></script>
</body>
</html>
<?php
$Database = new Database();
$Database->getConnection();

$UserProfile = new UserProfile($Database->conn);
$UserProfile->getUserData();
if(isset($_POST['user_update'])) {
$UpdateUser = new UpdateUser($Database->conn);
$UpdateUser->getUserData();
$UpdateUser->updateUserData();
}
?>     