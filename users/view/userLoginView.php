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
require_once '../controller/userLoginController.php'; 
class userLoginView {
    public $loginerror = "";
     function __construct() {
        ?>
        <!-- user login model -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><small>Login</small></h1>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="error"><?php echo $this->loginerror;?></span>
                <form method="POST" name="loginform" onsubmit="return validateUserLogin();" action=<?php $_SERVER["PHP_SELF"] ?> >
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="user_login_email" class="form-control" placeholder="Enter email" onfocusout = "return validateUserLogin()">
                        <span id="erroremail"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="user_login_pwd" class="form-control" placeholder="Enter password" onfocusout = "return validateUserLogin()">
                        <span id="errorpassword"></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="submit" id="login" value="login" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php
     }
}
$userLoginView = new userLoginView;
if (isset($_POST['submit'])) {
    $Database = new Database();
    $Database->getConnection();

    $ValidateLogin = new ValidateLogin($Database->conn);
    $ValidateLogin->validateUser();
}
?>
<script type="text/javascript" src="../../public/assets/js/userLogin.js"></script>
</body>
</html>			