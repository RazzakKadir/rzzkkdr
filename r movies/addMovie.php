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
<meta charset="utf-8">
<title>R Movies</title>
<link rel="icon" type="img/ico" href="img/rr.ico"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap-grid.css"/>
<style media="screen">
*{
margin: 0;
padding:0;
background-color: #808080;
font-weight:bold;
}

.home{
  border: 0.1px solid ;
  width: 100%;
  padding: 5px;
  margin-bottom: 100px;
  transition: 0.5s;
  background: transparent;
}
.home:hover{
  box-shadow: 0 0 10px 4px black;
}

h1::after{
  content: '';
  background: black !important;
  display: block;
  height: 4px;
  margin: 5px auto 5px;
  width: 150px;
}
tr{
  border: black;
  text-align: center;
}
th{
  padding:10px;
}
td{
  width:400px;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
::placeholder{
  color: black;
}
.add-btn{
  margin-top: 20px;
  margin-bottom: 35px;
}
/* Modal Content */
.modal-content {
  background-color: black;
  margin: auto;
  padding: 10px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */
.close {
  color: grey;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
#mybtn{
  margin:20px;
}
.button{
  padding:20px;
}
.button:hover{
  box-shadow: 0 0 10px 4px black;

}
</style>
</head>
  <body>
  <center>
    <a href="adminpage.php"><input type="button" class="home" value="HOME"></a>
    <h1>Movies</h1>
    <button id="btn">Add Movies</button>

    <div id="myModal" class="modal">
      <div class="modal-content" >
        <form  method="POST" action="insertMovie.php" enctype="multipart/form-data">
          <h1>ADD</h1>
          <h3>Movie Name:</h3>
          <div class="textbox">
            <input id="name" name="name" type="text" placeholder="Movie Name" required="required">
          </div>
          <h3>Movie Duration:</h3>
          <div class="textbox">
            <input id="duration" name="duration" type="text" placeholder="Movie Duration" required="required">
          </div>
          <h3>Movie Synopsis:</h3>
          <div class="textbox">
            <input id="synopsis" name="synopsis" type="text" placeholder="Synopsis" required="required">
          </div>
          <h3>Upload Photo:</h3>
          <div>
            <input type="file" name="photo" id="photo" required="required" style="background:white;"/>
          </div>
          <input type="submit" class="add-btn" value="Add Movie" style="color:black;">
        </form>
        <span class="close">&times;</span>
      </div>
    </div>
    <table border="1" class="userDetail">
      <tbhead>
        <tr>
          <th>Movie Picture</th>
          <th>Movie ID</th>
          <th>Movie Name</th>
          <th>Movie Duration</th>
          <th>Movie Synopsis</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </tbhead>
      <?php
        include('connect.php');//add connection to the php page

        $sql = "Select * from movie_t";//add a new sql query
        $result = mysqli_query($connect, $sql);// run the sql query and all the data store in variable result

        if(mysqli_num_rows($result)<=0)//if no result, then run the die () code
        {
        }
        else
        {

        }while ($rows =mysqli_fetch_array($result))
        {

          echo "<tr>";
          echo "<td><img src='".$rows['photo_path']."'width='100%' height='300px'/></td>";
          echo "<td>".$rows ['movie_ID']."</td>";
          echo "<td>".$rows ['movie_Name']."</td>";
          echo "<td>".$rows ['movie_Duration']."</td>";
          echo "<td>".$rows ['movie_Synopsis']."</td>";
          //Create 2 buttons(edit button and delete button in each column)
          echo "<td><a href='movieUpdate.php?id=".$rows['movie_ID']."'><button class='button'>Update</button></a></td>";
          echo "<td><a href='deleteMovie.php?id=".$rows['movie_ID']."'><button class='button'>Delete</button></a></td>";
          echo "</tr>";
        }

       ?>
    </table>
  <div class="footer" style="margin-top:100px;">

  </div>
  </center>
  <footer>
    <script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>
    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("btn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>
  </footer>
  </body>
</html>
