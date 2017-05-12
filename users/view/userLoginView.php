<?php
session_start();
require_once 'template/bookshareViewHeader.php';
require_once '../controller/userLoginController.php';
require_once '../../database/pdoDriverConnection.php';  

if (isset($_POST['submit'])) {
    $Database = new Database();
    $Database->getConnection();

    $ValidateLogin = new ValidateLogin($Database->conn);
    $ValidateLogin->validateUser(); 
    $ValidateLogin->validateInputs();

    $form_errors = $ValidateLogin->user_form_errors;
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
        <div class="col-lg-12">
            <h1><small>Login</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" name="loginform" onsubmit="return validateUserLogin();" action=<?php $_SERVER["PHP_SELF"] ?> >
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="user_login_email" class="form-control" placeholder="Enter email" onfocusout = "return validateEmail()">
                    <span id="erroremail"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="user_login_pwd" class="form-control" placeholder="Enter password" onfocusout = "return validatePassword()">
                    <span id="errorpassword"></span>
                </div>
                <div class="text-right">
                    <button type="submit" name="submit" id="login" value="login" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../public/assets/js/userLogin.js"></script>
<?php
require_once 'template/bookshareViewFooter.php';
?>
