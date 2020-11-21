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
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap-grid.css"/>
  <script type="text/javascript" src="js/script.js"></script>
  <style media="screen">
  body{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    animation: bookcolor 20s ease infinite;
  }
  .book-box{
    width: 80%;
    height: 80%;
    top: 45%;
    left: 50%;
    color: white;
    border-radius: 30px 30px 30px 30px;
    box-shadow: 0 30px 60px 0 white;
    padding: 50px;
    margin:auto;
    margin-top: 30px;
    margin-bottom: 20px;

  }
  .home{
    border: 0.1px solid ;
    width: 100%;
    padding: 5px;
    transition: 0.5s;
    background: transparent;
    animation: color-change 20s ease infinite;
    font-weight: bold;

  }
  .home:hover{
    box-shadow: 0 0 10px 4px;
    color: white;

  }
  footer p {
    width: 100%;
    color:white;
    bottom: 0;
  }
  .bar{
    text-align: center;
  }
  .box{
    border-bottom: 6px solid white;
    padding-bottom: 20px;
  }
  @keyframes color-change {
      0% { color: white; }
      25% {color: black;}
      50% { color: white; }
      75% {color: black;}
      100% { color: white; }
  }
  @keyframes bookcolor {
      0% {
          background-color : #000000;
      }
      25% {
          background-color :#730c04;
      }
      50% {
          background-color :#000000;
      }
      75% {
          background-color :#730c04;
      }

      100% {
          background-color :#000000;
      }

  }
  </style>
</head>
<body>
<a href="home.php"><input type="button" class="home" value="HOME"></a>
<div class="book-box">
  <div class="bar">
    <u><h2>Booking History</h2></u>
    <span class="aside"><i>Your Username - <?php echo $_SESSION['user'] ?></i></span>
  </div>
  <?php

    $query = "SELECT * FROM ticket_t WHERE user_ID = '" . $_SESSION['id'] ."'";
    $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
    while ($row = mysqli_fetch_array($myrecord)) {
      $query2 = "SELECT * FROM showtime_t WHERE show_ID = " . $row['show_ID'];
      $myrecord2 = mysqli_query($connect, $query2) or die("Query Error!".mysqli_error($connect));
      $showtimeRow = mysqli_fetch_array($myrecord2);
      mysqli_free_result($myrecord2);
      $query2 = "SELECT * FROM movie_t WHERE movie_ID = " . $showtimeRow['movie_ID'];
      $myrecord2 = mysqli_query($connect, $query2) or die("Query Error!".mysqli_error($connect));
      $movieRow = mysqli_fetch_array($myrecord2);
      mysqli_free_result($myrecord2);
      $rowName = chr(64 + $row['tkt_SeatRow']);
  ?>
  <div class="box">
    <p><b>Hall</b>: Hall <?php echo chr(65 + $showtimeRow['hall_ID'] - 1) ?></p>
    <p><b>SeatNo</b>: <?php echo $rowName . $row['tkt_SeatCol'] ?></p>
    <p><b>Movie</b>: <?php echo $movieRow['movie_Name'] ?></p>
    <p><b>Show Time</b>: <?php echo $showtimeRow['show_Date'] . " " . $showtimeRow['show_Time'] . " (" . $showtimeRow['show_Day'] . ")" ?></p>
    <p><b>Ticket Fee</b>: <?php
      if ($row['tkt_Fee'] == 50)
        echo "$50(Student/Senior)";
      else
        echo "$75(Adult)";
    ?></p>
  </div>
  <?php
    }
    mysqli_free_result($myrecord);
  ?>
</div>

  <footer>
  <center>
  <p style="color:white;">Developed by ARK </p>
  </center>
  </footer>
  </body>
  </html>
