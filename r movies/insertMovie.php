<?php

 include ("connect.php");


$target_dir = "uploads/";

//the basename($_FILES["photo"]["name"]) means to get the basename (e.g. test.docx)

//from the file path (e.g. D://images/test.docx)

$target_file = $target_dir.basename($_FILES["photo"]["name"]);

//to get the extension of the file (e.g. docx)

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["photo"]["tmp_name"]);

if($check !== false)

{

  echo "<script>alert('File is an image - " . $check["mime"] . ".');</script>";

}

else

{

  echo "<script>alert('File is not an image.Please try again!');</script>";

  die("<script>window.history.go(-1);</script>");

}

// Allow certain file formats

if($imageFileType != "jpg" && $imageFileType != "png" &&

$imageFileType != "jpeg" && $imageFileType != "gif" )

{

   echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.

   Please try again!');</script>";

   die("<script>window.history.go(-1);</script>");

}



//move the file using move_uploaded_file function.

//If not success transfer, give alert message!

if (! move_uploaded_file($_FILES["photo"]["tmp_name"],

$target_file)) {

   echo "<script>alert('Unable to upload photo.Thus, data will not be inserted to

   database. Please try again!');</script>";

   die("<script>window.history.go(-1);</script>");

}



echo "<script>alert('The file ". basename($_FILES["photo"]["name"]). " has been uploaded.');</script>";




 $sql = "INSERT INTO movie_t(movie_Name, movie_Duration, movie_Synopsis, photo_path)

    VALUES
('$_POST[name]','$_POST[duration]','$_POST[synopsis]','$target_file')";

if(!mysqli_query($connect,$sql))
{
  die('Error:'.mysqli_error($connect));
 }

echo '<script>alert("1 record added!");window.location.href ="addMovie.php"; </script>';

mysqli_close($connect);



?>
