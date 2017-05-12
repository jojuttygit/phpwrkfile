<?php
session_start();
if(!$_SESSION['admin_email']) {
	header("Location: adminLoginView.php");
}
//require_once '../controller/adminListUserController.php';
//require_once '../../database/dbConnection.php';
require_once '../../autoloader/autoloader.php';
?>
<?php
$dbConnection = new dbConnection();
$dbConnection->getConnection();

$adminListUserController = new adminListUserController($dbConnection->conn);
$user_data = $adminListUserController->selectUsersDetails();

require_once 'template/adminDashboard_header.php';
?>
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
      				<tr>
      					<th>User ID</th>
        				<th>Name</th>
        				<th>Email ID</th>
        				<th>Mobile</th>
        				<th>Address</th>
        				<th>User Status</th>
        				<th>Block</th>
        				<th>unblock</th>
      				</tr>
    			</thead>
    			<tbody>
    			<?php
            	foreach ($user_data as $row) {
            	?>
					<tr>
						<td><?php echo $row['user_id']; ?></td>
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $row['user_email']; ?></td>
						<td><?php echo $row['user_mobile']; ?></td>
						<td><?php echo $row['user_address']; ?></td>
						<td><?php echo $row['user_status']; ?></td>
						<td><a href="../controller/blockUserController.php?user_status=block&user_id=<?php echo $row['user_id']; ?>">Block</a></td>
						<td><a href="../controller/blockUserController.php?user_status=unblock&user_id=<?php echo $row['user_id']; ?>">unblock</a></td>
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
