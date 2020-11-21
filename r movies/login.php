<?php
session_start();
include "connect.php";
  $username = mysqli_real_escape_string($connect, $_POST['user']);
  $password = mysqli_real_escape_string($connect, $_POST['pass']);

  $sql = "SELECT * FROM users_t WHERE user_Name = '".$username.
  "' and user_Password = '".md5($password)."'";
  $result = mysqli_query($connect, $sql);

  if(mysqli_num_rows($result) <=0)
  {
    $sql = "SELECT * FROM users_t WHERE user_Name = '".$username.
    "' and user_Password = '".$password."'";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) <=0)
    {
        echo "<script>alert('Wrong username / password! Please Try Again!');";
        die("window.history.go(-1);</script>");
    }
  }

  if($row=mysqli_fetch_array($result))
  {
    $_SESSION['id'] = $row['user_ID'];
    $_SESSION['user'] = $row['user_Name'];
    $_SESSION['password'] = $row['user_Password'];
    $_SESSION['role'] = $row['user_Role'];
    $_SESSION['photo_path'] = $row[''];
  }
  if($_SESSION['role']==="1")
  {
      echo "<script>alert('Welcome back! ".$_SESSION['user']."');";
      echo "window.location.href='home.php';</script>";
  }
  else if($_SESSION['role']==="0")
  {
      echo "<script>alert('Welcome back! ".$_SESSION['user']."');";
      echo "window.location.href='adminpage.php';</script>";
  }
?>
