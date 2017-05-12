<?php 
session_start();
if(!$_SESSION['user_email']) {
    header("Location: view/bookshareview.php");
}

require_once '../../autoloader/autoloader.php';

//require_once '../../database/dbConnection.php';
//require '../controller/userProfileController.php';
//require '../controller/userProfileUpdateController.php';

$dbConnection = new dbConnection();
$dbConnection->getConnection();

$userProfileController = new userProfileController($dbConnection->conn);
$userProfileController->getUserData();
$row = $userProfileController->user_data;
    if(isset($_POST['user_update'])) {
        $userProfileUpdateController = new userProfileUpdateController($dbConnection->conn);
        $userProfileUpdateController->validateInputs();
        $userProfileUpdateController->updateUserData();
        $form_errors = $userProfileUpdateController->user_form_errors;
    } 

require_once 'template/userHomeHeader.php';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><small>Update Your Profile</small></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <form method="POST" name="updateUserProfile" onsubmit="return validateupdate();">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="user_name" class="form-control" placeholder="Enter name" onfocusout = "return validateName()" value=<?php echo $row['user_name'] ?> required>
                    <span id="error_name"></span>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="user_mobile" class="form-control" value=<?php echo $row['user_mobile'] ?> onfocusout = "return userMobile()" placeholder="Enter mobile number">
                    <span id="error_number"></span>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" rows="5" name="user_address" id="comment" placeholder="Enter Address"><?php echo $row['user_address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="datepicker" name="user_date" value = <?php echo $row['user_dob'] ?>>
                </div>
                <div class="text-right">
                    <button type="submit" id="profileUpdate" name="user_update" value="user_update" class="btn btn-success">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../public/assets/js/updateUserProfile.js"></script>
<?php
require_once 'template/userHomeFooter.php';
echo "<br>";
if (isset($_POST['user_update'])) { 
    foreach ($form_errors as $value) {
        ?>
        <div class="alert alert-danger">
            <strong><?php echo $value; ?></strong>
        </div>
        <?php
    }
}
?>
