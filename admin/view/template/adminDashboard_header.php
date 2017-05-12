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
      			<li><a href="adminListUsersView.php">Users</a></li>
    		</ul>
    		<ul class="nav navbar-nav navbar-right">
      			<li><a class="dropdown-toggle" data-toggle="dropdown" href="adminListUsersView.php">
      				<span class="glyphicon glyphicon-user"></span>
                        <?php echo " Hi, ".$_SESSION['admin_name'] ?> 
                    <span class="caret"></span></a>
      				<ul class="dropdown-menu">
          				<li><a href="../controller/adminLogoutController.php">Logout</a></li>
        			</ul>
        		</li>
    		</ul>
  		</div>
	</nav>