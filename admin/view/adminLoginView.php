<?php 
session_start();
require_once '../../database/pdoDriverConnection.php';
require_once '../../autoloader/autoloader.php';

require_once 'template/admin_header.php';

if (isset($_POST['login'])) {
	$Database = new Database();
	$Database->getConnection(); 
	$adminLoginController = new adminLoginController($Database->conn); 
	$adminLoginController->validateInputs();
	$adminLoginController->validateAdmin();
	$form_errors = $adminLoginController->user_form_errors;
	foreach ($form_errors as $value) {
		?>
		<div class="alert alert-danger">
  			<strong><?php echo $value; ?></strong>
		</div>
		<?php
	}
}
?>
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
<script type="text/javascript" src="../../public/assets/js/adminLogin.js"></script>	
<?php 
require_once 'template/admin_footer.php';
?>			