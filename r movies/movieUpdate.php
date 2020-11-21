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
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<title>R Movies</title>
<link rel="icon" type="img/ico" href="img/rr.ico"/>
<link rel="stylesheet" href="css/adminpage.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap-grid.css"/>
<style media="screen">
  input{
    padding:3px;
  }
  .editbox{
    width: 420px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: black;
    border-radius: 30px 30px 30px 30px;
    padding: 8px;
    margin:auto;
    margin-top: 3px;
    box-shadow: 0 30px 60px 0 ;
  }
  .textbox{
    padding: 15px;
  }
</style>
</head>
<body>
<?php
  //get id from url
  $uid=$_GET['id'];

  //connect to database
  include "connect.php";


  //write the sql query
  $sql = "SELECT * from movie_t where movie_ID = $uid";
  //excute the sql query
  $result=mysqli_query($connect,$sql);

  //get the data from the database and display in html form
  if($rows=mysqli_fetch_array($result))
  {
?>
<center>
  <form class="editbox" method="post" action="update.php" enctype="multipart/form-data">
    <u><h1>Update Form</h1></u>
    <b>Movie ID:</b><input type="text" value="<?php echo $uid;?>" name="uid" readonly/>
    <div class="textbox">
      <b>Movie Name:</b><input id="name" name="name" type="text" value="<?php echo $rows ['movie_Name']?>" required="required"/>
    </div>
    <div class="textbox">
      <b>Movie Duration:</b><input id="duration" name="duration" type="text" value="<?php echo $rows ['movie_Duration']?>" required="required"/>
    </div>
    <div class="textbox">
      <b>Photo:</b><input id="photo" name="photo" type="file" value="<?php echo $rows ['photo_path']?>" />
    </div>
  <input type="submit" name="update" value="Update"/>&nbsp;&nbsp;
    <a href="addmovie.php"><input type="button" value="Cancel" ="addmovie.php"/></a>
  </form>
</center>
<?php
  }
  else
  {
    die("<script>alert('No such user');'</script>");
  }
?>
</body>
</center>
</html>
