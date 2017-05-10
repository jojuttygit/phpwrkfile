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
        			<li class="active"><a href="bookshareview.php">Home</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
        			<li><a href="userSignUpView.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        			<li><a href="userLoginView.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>
<?php
require_once '../controller/userSignUpController.php'; 
class UserSignUpView {
   function __construct() {
    ?>
    <!-- user signup model -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><small>Sign Up</small></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" name="signup" onsubmit="return usersignup();" action=<?php $_SERVER["PHP_SELF"] ?>>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="user_name" class="form-control" onfocusout = "return usersignup()" placeholder="Enter name" required>
                        <span id="errorname"></span>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" name="user_mobile" class="form-control" onfocusout = "return usersignup()" placeholder="Enter mobile number" required>
                        <span id="errornumber"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="user_email" class="form-control" onfocusout = "return usersignup()" placeholder="Enter email" required>
                        <span id="erroremail"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="user_pwd" class="form-control" onfocusout = "return usersignup()" placeholder="Enter password" required>
                        <span id="errorpassword"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="user_confirm_pwd" class="form-control" onfocusout = "return usersignup()" placeholder="Enter password" required>
                        <span id="errorconfirmpassword"></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" id="useraccount" name="userAccount" class="btn btn-success" value="signup">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    }
}
$UserSignUpView = new UserSignUpView;
if (isset($_POST['userAccount'])) {
    $Database = new Database();
    $Database->getConnection();

    $CreateUser = new CreateUser($Database->conn);
    $CreateUser->getUserData();
    $CreateUser->addUserData();
}
?>
<script type="text/javascript" src="../../public/assets/js/usersignup.js"></script>
</body>
</html>			