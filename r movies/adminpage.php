<?php
session_start();   // if don't have session user..then
 include('connect.php');

	if(!isset($_SESSION['user']))  {
		die("<script>alert('Please login first before proceed!');
		window.location.href='login.html';</script>");
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>R Movies</title>
  <link rel="icon" type="img/ico" href="img/rr.ico"/>
	<link rel="stylesheet" type="text/css" href="css/adminpage.css">
  <style media="screen">
  footer p {
    margin-top: 53vh;
    width: 100%;
    color:white;
    bottom: 0;
  }
  </style>
</head>
<body>
	<center>
	<header id="navBar">
		<img src="img/admin.png"></br>
    <?php  if (isset($_SESSION['user'])) : ?>
      <strong><?php echo $_SESSION['user']; ?></strong>
    <?php endif ?>
	</header>
		<div id="admin_panel">
			<h2>Admin Panel</h2>
		</div>

<div id="Bar">
	<ul>
	  <li><a href="users.php">Users</a></li>
		<li><a href="addMovie.php">Movies</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>
</center>
<footer>
  <center>
  <p style="color:white;">Developed by ARK </p>
  </center>
<script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>

</footer>
</body>
</html>
