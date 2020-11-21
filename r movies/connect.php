<?php
$connect = mysqli_connect("localhost","root","","r_movies");
//check connection
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL:". mysqli_connect_error();
  }

  if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location:login.php");
	}


?>
