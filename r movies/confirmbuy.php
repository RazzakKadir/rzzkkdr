<?php
  session_start();   // if don't have session user..then
 include('connect.php');

	if(!isset($_SESSION['user']))  {
		die("<script>alert('Please login first before proceed!');
		window.location.href='login.html';</script>");
	}
  ?>
  <!DOCTYPE>
  <html>
  <head>
  <title>R Movies</title>
  <link rel="icon" type="img/ico" href="img/rr.ico"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
  <style media="screen">
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
  .box{
    border-bottom: 6px solid white;
  }
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
  footer p {
    width: 100%;
    color:white;
    bottom: 0;
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
    <a href="home.php" style="margin-bottom:30px;"><input type="button" class="home" value="HOME"></a>
    <div class="book-box">
      <?php
        $query = "SELECT * FROM showtime_t WHERE show_ID = " . $_POST['showtime'];
        $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
        $showtimeInfo = mysqli_fetch_array($myrecord);
        mysqli_free_result($myrecord);

        $showtime_ID = $_POST['showtime'];
        $userid = $_SESSION['id'];
        $query = "SELECT * FROM movie_t WHERE movie_ID = " . $showtimeInfo['movie_ID'];
        $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
        $movieInfo = mysqli_fetch_array($myrecord);
        mysqli_free_result($myrecord);
      ?>
      <?php
        $total = 0;
        for ($i = 0; $i < sizeof($_POST['seat']); $i++) {
          list($row,$col) = explode('|', $_POST['seat'][$i]);
          $rowName = chr(65 + $row - 1);
      ?>
      <div class="confirm">
        <div class="box">
          <center><u><h2>Confirm buy</h2></u></center>
          <p><b>Hall</b>: Hall <?php echo chr(65 + $showtimeInfo['hall_ID'] - 1) ?></p>
          <p><b>SeatNo</b>: <?php echo $rowName . $col ?></p>
          <p><b>Movie</b>: <?php echo $movieInfo['movie_Name'] ?></p>
          <p><b>Show Time</b>: <?php echo $showtimeInfo['show_Date'] . " " . $showtimeInfo['show_Time'] . " (" . $showtimeInfo['show_Day'] . ")" ?></p>
          <p><b>Ticket Fee</b>: <?php
            $total = $total + $_POST['type'][$i];
            if ($_POST['type'][$i] == 15)
              echo "RM 15(Student/Senior)";
            else
              echo "RM 20(Adult)";
              ?>
          </p>
          <?php
            $ticketFee = $_POST['type'][$i];
            $ticketType;
            if ($ticketFee == 15)
              $ticketType = "Student/Senior";
            else
              $ticketType = "Adult";
            $query = "INSERT INTO ticket_t(tkt_SeatRow, tkt_SeatCol, show_ID, user_ID, tkt_Type, tkt_Fee) VALUES ('$row', '$col', '$showtime_ID', '$userid', '$ticketType', '$ticketFee')";
            mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
           ?>
         </div>
      </div>
      <?php
        }
      ?>
      <section style="padding: 1rem 3rem;">
        <h3>Total Fee: RM <?php echo $total ?></h3>
        <a href="home.php">
          <button type="button" name="okay" class="form-button" onclick="myFunction()">Confirm!</button>
        </a>
      </section>
    </div>
    <footer>
      <script>
      function myFunction() {
        alert("Booking successful");
      }
      </script>
    <center>
    <p style="color:white;">Developed by ARK </p>
    </center>
    </footer>
  </body>
  </html>
