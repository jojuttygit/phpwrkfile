<?php 
session_start();
if(!$_SESSION['user_email']) {
	header("Location: ../view/bookshareview.php");
}
?>
<?php

require_once '../../autoloader/autoloader.php';

//require_once '../../database/dbConnection.php';
//require_once '../controller/userRentRequestController.php';
require_once 'template/userHomeHeader.php';

$dbConnection = new dbConnection();
$dbConnection->getConnection();

$userRentRequestController = new userRentRequestController($dbConnection->conn);
$userRentRequestController->selectReuests();
$rented_books = $userRentRequestController->rent_request;
?>
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Renter</th>
                    <th>Request Status</th>
                    <th>Approve</th>
                    <th>Release</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($rented_books as $row) {
            ?>    
                <tr>
                    <td><?php echo $row['book_id']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['renter_status']; ?></td>
                    <td><a href="../controller/rentApprovalController.php?renter_id=<?php echo $row['renter_id']; ?>&book_id=<?php echo $row['book_id']; ?>&renter_status=Approved">Approved</a></td>
                    <td><a href="../controller/rentApprovalController.php?renter_id=<?php echo $row['renter_id']; ?>&book_id=<?php echo $row['book_id']; ?>&renter_status=Release" >Release</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="../../public/assets/js/bookshare.js"></script>
<?php
require_once 'template/userHomeFooter.php';
?>