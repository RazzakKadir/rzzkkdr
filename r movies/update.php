<?php
  include "connect.php";

  $target_dir = "uploads/";

  $uid = $_POST['uid'];
  $name = $_POST['name'];
  $duration = $_POST['duration'];
  $target_file = $target_dir.basename($_FILES["photo"]["name"]);


    $sql = "Update movie_t SET
    movie_Name = '$name',
    movie_Duration = '$duration',
    photo_path = '$target_file' Where movie_ID = $uid";

mysqli_query($connect,$sql);
if(mysqli_affected_rows($connect)<=0)
{
  die("<script>alert('Unable to update data!');</script>");
  echo "<script>window.location.href='movieEdit.php?id=$uid';</script>";
}
mysqli_close($connect);

echo "<script>alert('Data updated successfully!');</script>";
echo "<script>window.location.href='addMovie.php';</script>";
?>
