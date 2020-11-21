<?php
include("connect.php");
$uid= intval($_GET['id']);

$sql="DELETE FROM movie_t WHERE movie_ID=$uid";
$result=mysqli_query($connect, $sql);

if(mysqli_affected_rows($connect)<=0)
  {
    echo "<script>alert('Unable to delete data!');";
    die ("window.location.href='addMovie.php';</script>");
  }
    mysqli_close($connect);
    echo "<script>alert('Movie Deleted!');</script>";
    echo "<script>window.location.href='addMovie.php';</script>";


?>
