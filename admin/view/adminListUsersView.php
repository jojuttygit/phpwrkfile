<?php
session_start();
if(!$_SESSION['admin_email']) {
	header("Location: adminLoginView.php");
}
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	 <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- External css -->
	<link rel="stylesheet" type="text/css" 
                        href="../../public/assets/css/bookShareAdmin.css" />
</head>
<body>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="#">Book Share</a>
   			</div>
    		<ul class="nav navbar-nav">
      			<li><a href="adminDashboardView.php">Books</a></li>
      			<li class="active"><a href="adminListUsersView.php">Users</a></li>
    		</ul>
    		<ul class="nav navbar-nav navbar-right">
      			<li><a class="dropdown-toggle" data-toggle="dropdown" href="adminListUsersView.php">
      				<span class="glyphicon glyphicon-user"></span><?php echo " Hi, ".$_SESSION['admin_name'] ?> <span class="caret"></span></a>
      				<ul class="dropdown-menu">
          				<li><a href="../controller/adminLogoutController.php">Logout</a></li>
        			</ul>
        		</li>
    		</ul>
  		</div>
	</nav>
	<?php
	require_once '../../database/dbConnection.php';
	class ListUsers {
		public $admin_conn_obj;

		public function __construct($connObj) { 
			$this->admin_conn_obj = $connObj;
		}
		public function selectUsersDetails () {
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
						$sql = "SELECT 
									*FROM tbl_users  
									ORDER BY user_id DESC";

						$result_set = $this->admin_conn_obj->query($sql);
						if ($result_set->num_rows > 0) {
				
							while ($row = $result_set->fetch_assoc()) {
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
							</tbody>
							<?php
							}
						}
				?>
				</table>
			</div>
		</div>
		<?php
		}
	} 
	?>
		</div>
	</body>
</html>
<?php
$Database = new Database();
$Database->getConnection();

$ListUsers = new ListUsers($Database->conn);
$ListUsers->selectUsersDetails();
?>