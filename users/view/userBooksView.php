<?php 
session_start();
if(!$_SESSION['user_email']) {
    header("Location: ../view/bookshareview.php");
}
?>
 <?php
//require_once '../../database/dbConnection.php';
//require_once '../controller/usersBookController.php';

require_once '../../autoloader/autoloader.php';

require_once 'template/userHomeHeader.php';

$dbConnection = new dbConnection();
$dbConnection->getConnection();

$usersBookController = new usersBookController($dbConnection->conn);
$book_list = $usersBookController->selectMyBooks();
?>
<div class="container-fluid">
    <div class="table-responsive">
        <?php 
        if ($book_list) {
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Book Publisher</th>
                    <th>Book Type</th>
                    <th>Book Description</th>
                    <th>Book Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($book_list as $row) {
                ?>
                <tr>
                    <td><?php echo $row['book_id']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['book_publisher']; ?></td>
                    <td><?php echo $row['book_type']; ?></td>
                    <td><?php echo $row['book_description']; ?></td>
                    <td><?php echo $row['book_status']; ?></td>
                    <td><a href="#" onclick="confirmDelete(<?php echo $row['book_id']; ?>)">delete</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        }
        else {
            echo "<strong>No book Found</strong>";
        } 
        ?>
    </div>
</div>
<script type="text/javascript" src="../../public/assets/js/bookshare.js"></script>
<?php
require_once 'template/userHomeFooter.php';
?>
