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
  <title>Create User</title>
  <link rel="icon" type="img/ico" href="img/rr.ico"/>
  <link rel="stylesheet" href="css/create_user.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap-grid.css"/>
<style media="screen">
.home{
  border: 0.1px solid ;
  width: 100%;
  padding: 5px;
  margin-bottom: 50px;
  transition: 0.5s;
  background: transparent;
}
.home:hover{
  box-shadow: 0 0 10px 4px black;
}
</style>
</head>
<center>
  <body>
    <a href="adminpage.php"><input type="button" class="home" value="HOME" style="font-weight:bold;"></a>
    <form class="createUser-box" method="POST" action="user_create.php">
      <h1>Create Admin/User</h1>
			<div class="textbox">
				<select name="role" id="role" required="required">
					<option value="" disabled selected>User Type</option>
					<option value="0">Admin</option>
					<option value="1">User</option>
				</select>
			</div>
      <div class="textbox">
        <input id="user" name="user" type="text" placeholder="Username" required="required">
      </div>
      <div class="textbox">
        <input id="pass" name="pass" type="password" placeholder="Password" required="required">
      </div>
      <div class="textbox">
        <input id="confirmpass" name="confirmpass" type="password" placeholder="Confirm password" required="required">
      </div>
      <div class="textbox">
        <input id="email" name="email" type="email" placeholder="Email Address" required="required">
      </div>
      <input type="reset" class="button" value="Clear" style="color:black;">
      <input type="submit" class="button" value="Create User" style="color:black;">
    	</form>
<footer>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrap.js"></script>

</footer>
</body>
</center>
</html>
