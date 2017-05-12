<?php 
session_start();
if(!$_SESSION['user_email']) {
    header("Location: ../view/bookshareview.php");
}
//require_once '../../database/dbConnection.php';

require_once '../../autoloader/autoloader.php';

//require '../controller/userPasswordChangeController.php';

    if(isset($_POST['changepwd'])) {
        $dbConnection = new dbConnection();
        $dbConnection->getConnection();

        $userPasswordChangeController = new userPasswordChangeController($dbConnection->conn);
        $userPasswordChangeController->validateInputs();
        $userPasswordChangeController->updatePassword();
        $form_errors = $userPasswordChangeController->user_form_errors;
        $form_success = $userPasswordChangeController->user_form_success;
    } 

require_once 'template/userHomeHeader.php';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><small>Change Your Password</small></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <form method="POST" name="changepassword" onsubmit="return changePassword();">
                <div class="form-group">
                    <label for="pwd">Current Password</label>
                    <input type="password" name="current_pwd" class="form-control" onfocusout = "return validateCurrentPwd()" required>
                    <span id="error_current_pwd"></span>
                </div>
                <div class="form-group">
                    <label for="pwd">New Password</label>
                    <input type="password" name="new_pwd" class="form-control" onfocusout = "return validateNewPwd()" required>
                    <span id="error_new_pwd"></span>
                </div>
                <div class="form-group">
                    <label for="pwd">Confirm Password</label>
                    <input type="password" name="confirm_pwd" class="form-control" onfocusout = "return validateConfirmPwd()" required>
                    <span id="error_confirm_pwd"></span>
                </div>
                <div class="text-right">
                    <button type="submit" id="changepwd" name="changepwd" value="changepwd" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../public/assets/js/validatePwdChange.js"></script>
<?php
require_once 'template/userHomeFooter.php';
echo "<br>";
if (isset($_POST['changepwd'])) { 
    foreach ($form_errors as $value) {
        ?>
        <div class="alert alert-danger">
            <strong><?php echo $value; ?></strong>
        </div>
        <?php
    }
    foreach ($form_success as $value) {
        ?>
        <div class="alert alert-success">
            <strong><?php echo $value; ?></strong>
        </div>
        <?php
    }
}
?>
