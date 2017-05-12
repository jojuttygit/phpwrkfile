<!DOCTYPE html>
<head>
	<title>Book Share</title>
	 <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- External css -->
	<link rel="stylesheet" type="text/css" 
                            href="../../public/assets/css/bookShareusers.css" />
</head>
<body>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bookShareNav">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      			</button>
      			<a class="navbar-brand" href="#">Book Share</a>
    		</div>
    		<div class="collapse navbar-collapse" id="bookShareNav">
      			<ul class="nav navbar-nav">
        			<li><a href="userDashboardView.php">Home</a></li>
        			<li><a href="userBooksView.php">My Books</a></li>
        			<li><a href="userRentRequestView.php">Rent Request</a></li>
        			<li><a href="userAddBooksView.php">Add Books</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      					<span class="glyphicon glyphicon-user"></span><?php echo " Hi, ".$_SESSION['user_name'] ?> <span class="caret"></span></a>
      					<ul class="dropdown-menu">
      						<li><a href="userProfileView.php">My profile</a></li>
                  <li><a href="../view/userChangePasswordView.php">Change Password</a></li>
          				<li><a href="../controller/userLogoutController.php">Logout</a></li>
        				</ul>
        			</li>
    			</ul>
    		</div>
  		</div>
	</nav>