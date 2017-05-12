<?php
session_start();
if(!$_SESSION['admin_email']) {
    header("Location: adminLoginView.php");
}
//require_once '../controller/adminDashboardController.php';
//require_once '../../database/dbConnection.php';
require_once '../../autoloader/autoloader.php';
?>
<?php
$dbConnection = new dbConnection();
$dbConnection->getConnection();
$adminDashboardController = new adminDashboardController($dbConnection->conn);
$book_data = $adminDashboardController->selectUsersBooks();

require_once 'template/adminDashboard_header.php';
?>

<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Uploader</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Book Publisher</th>
                    <th>Book Type</th>
                    <th>Book Status</th>
                    <th>Book Permission</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($book_data as $row) {
            ?>
                <tr>
                    <td><?php echo $row['book_id'];?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['book_publisher']; ?></td>
                    <td><?php echo $row['book_type']; ?></td>
                    <td><?php echo $row['book_status']; ?></td>
                    <td><a href="../controller/adminBookPermissionController.php?book_status=<?php echo $row['book_status']; ?>&book_id=<?php echo $row['book_id']; ?>">Change Permission</a></td>
                </tr>
            <?php
            }
            ?>
            </tbody>         
        </table>
    </div>
</div>
<?php
require_once 'template/adminDashboard_footer.php';
?>
 