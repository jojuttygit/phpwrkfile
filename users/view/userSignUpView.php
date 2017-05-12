<?php
//require_once '../../database/dbConnection.php';
//require_once '../controller/userSignUpController.php';

require_once '../../autoloader/autoloader.php'; 

if (isset($_POST['userAccount'])) {
    $dbConnection = new dbConnection();
    $dbConnection->getConnection();

    $userSignUpController = new userSignUpController($dbConnection->conn);
    $userSignUpController->validateInputs();
    $userSignUpController->addUserData();
    $form_errors = $userSignUpController->user_form_errors;
}
require_once 'template/bookshareViewHeader.php';
?>
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
                        <input type="text" name="user_name" class="form-control" onfocusout="userName()" placeholder="Enter name" required>
                        <span id="errorname"></span>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" name="user_mobile" class="form-control" onfocusout = "return userMobile()" placeholder="Enter mobile number" required>
                        <span id="errornumber"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="user_email" class="form-control" onfocusout = "return userEmail()" placeholder="Enter email" required>
                        <span id="erroremail"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="user_pwd" class="form-control" onfocusout = "return password()" placeholder="Enter password" required>
                        <span id="errorpassword"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="user_confirm_pwd" class="form-control" onfocusout = "return confirmPassword()" placeholder="Enter password" required>
                        <span id="errorconfirmpassword"></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" id="useraccount" name="userAccount" class="btn btn-success" value="signup">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript" src="../../public/assets/js/usersignup.js"></script>
<?php
require_once 'template/bookshareViewFooter.php';
?>
<br>
<?php
if (isset($_POST['userAccount'])) { 
    foreach ($form_errors as $value) {
        ?>
        <div class="alert alert-danger">
            <strong><?php echo $value; ?></strong>
        </div>
        <?php
    }
}
?>