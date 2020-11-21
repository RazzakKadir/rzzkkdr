<?php
include "connect.php";
$username = mysqli_real_escape_string($connect,$_POST['user']);
$password = mysqli_real_escape_string($connect,$_POST['pass']);
$confirmpassword = mysqli_real_escape_string($connect,$_POST['confirmpass']);
$email = mysqli_real_escape_string($connect,$_POST['email']);

if($password !== $confirmpassword)
{
  echo "<script>alert('Password and confirmed password not same!');";
  die("window.history.go(-1);</script>");
}

$sql = "Insert into users_t (user_Name, user_Password, user_Email, user_Last_Login) VALUES
('$username','".md5($password)."','$email','".date("Y-m-d H:i:s")."');";

mysqli_query($connect, $sql);

// get id of the created user
$logged_in_user_id = mysqli_insert_id($connect);

//echo $sql;
if(mysqli_affected_rows($connect)<=0)
{
  echo"<script>alert('Unable to register ! \\nPlease Try Again!');";
  die("window.history.go(-1);</script>");
}

echo "<script>alert('Registered Successfully!Please login now!');";
echo "window.location.href='home.php';</script>";

?>
