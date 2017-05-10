<?php session_start();?>
<!DOCTYPE html>
<head>
	<title>Admin Login</title>
	 <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- External css -->
	<link rel="stylesheet" type="text/css" href="../../public/assets/css/bookShareAdmin.css" />
</head>
<body>
	<?php
	require_once '../controller/adminLoginController.php';
	class AdminLoginView
	{
		function __construct()
		{
			?>
			<nav class="navbar navbar-default">
  				<div class="container-fluid">
    				<div class="navbar-header">
      					<a class="navbar-brand" href="adminLoginView.php">BookShare Admin</a>
    				</div>
    				<ul class="nav navbar-nav navbar-right">
      					<li class="active"><a href="adminLoginView.php">Admin panel</a></li>
      					<li><a href="../../users/view/bookshareview.php">BookShare</a></li>
    				</ul>
  				</div>
			</nav>
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<form name="admin_login" onsubmit="return validateAdminLogin();" method="POST" action=<?php $_SERVER["PHP_SELF"] ?>>
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="text" name="admin_email" class="form-control" placeholder="Enter email" onfocusout = "return validateAdminLogin()">
								<span id="errormail"></span>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="admin_pwd" class="form-control" placeholder="Enter password" onfocusout = "return validateAdminLogin()">
								<span id="errorpwd"></span>
							</div>
							<button type="submit" value="submit" class="btn btn-primary" name="login" id="login">Login</button>
						</form>
					</div>
				</div>
			</div>
			<?php
		}
	} ?>
<script type="text/javascript" src="../../public/assets/js/adminLogin.js"></script>
</body>
</html>
<?php 
$AdminLoginView = new AdminLoginView;
if (isset($_POST['login'])) {
	$Database = new Database();
	$Database->getConnection();
	$ValidateAdminLogin = new ValidateAdminLogin($Database->conn);
	$ValidateAdminLogin->validateAdmin();
}
?>			