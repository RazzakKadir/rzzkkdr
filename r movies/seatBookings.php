<?php
session_start();   // if don't have session user..then
 include('connect.php');

	if(!isset($_SESSION['user']))  {
		die("<script>alert('Please login first before proceed!');
		window.location.href='login.html';</script>");
	}
?><!DOCTYPE>
<html>
<head>
<title>R Movies</title>
<link rel="icon" type="img/ico" href="img/rr.ico"/>
<link rel="stylesheet" href="css/booking.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
<style media="screen">
  .ticketing-row {
    font-size: 15px;
    display: flex;
    margin: 0 auto;
    padding: 3px;
    width: 100%;
    max-width: 500px;
  }
  .ticketing-col {
    border: 1px solid #000;
    flex-grow: 1;
    background: #a7ef8a;
    flex-basis: 0;
  }
  .clearseats{
    width: 50%;
    height: 50%;
    top: 50%%;
    left: 50%;
    transform: translate(50%,20%);
    border-radius: 30px 30px 30px 30px;
    box-shadow: 0 30px 60px 0 white;
    color:black;
    padding-top: 20px;
  }
  .screen{
    color: black;
  }
  footer p {
    margin-top: 89vh;
    width: 100%;
    color:white;
    bottom: 0;
  }
</style>
</head>
<body>
  <a href="home.php"><input type="button" class="home" value="HOME"></a>
  <div class="book-box">
      <section>
        <?php
          $query = "SELECT * FROM showtime_t WHERE show_ID = " . $_POST['showtime'];
          $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
          $showtimeInfo = mysqli_fetch_array($myrecord);
          mysqli_free_result($myrecord);
        ?>
        <center><u><h2>Seat Booking</h2></u></center>
        <p><b>Hall</b>: Hall <?php echo chr(65 + $showtimeInfo['hall_ID'] - 1) ?></p>
        <?php
          $query = "SELECT * FROM movie_t WHERE movie_ID = " . $showtimeInfo['movie_ID'];
          $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
          $movieInfo = mysqli_fetch_array($myrecord);
          mysqli_free_result($myrecord);
        ?>
        <p><b>Movie</b>: <?php echo $movieInfo['movie_Name'] ?></p>
        <p><b>Show Time</b>: <?php echo $showtimeInfo['show_Date'] . " " . $showtimeInfo['show_Time'] . " (" . $showtimeInfo['show_Day'] . ")" ?></p>
      </section>

    <section class="clearseats">
      <form method="post" action="buyingTicket.php" onsubmit="return check();">
        <?php
          $query = "SELECT * FROM hall_t WHERE hall_ID = " . $showtimeInfo['hall_ID'];
          $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
          $hallInfo = mysqli_fetch_array($myrecord);
          mysqli_free_result($myrecord);

          $query = "SELECT * FROM ticket_t WHERE show_ID = " . $showtimeInfo['show_ID'];
          $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
          $seatsOccupied;
          $numberOfSeatsOccupied = 0;
          while ($row = mysqli_fetch_array($myrecord)) {
            $seatsOccupied[$numberOfSeatsOccupied][0] = $row['tkt_SeatRow'];
            $seatsOccupied[$numberOfSeatsOccupied][1] = $row['tkt_SeatCol'];
            $numberOfSeatsOccupied++;
          }
          mysqli_free_result($myrecord);
        ?>
        <?php
          while ($hallInfo['hall_Row']) {
              $rowName = chr(65 + $hallInfo['hall_Row'] - 1);
        ?>
            <div class="ticketing-row">

            <?php
            for ($i = 1; $i <= $hallInfo['hall_Col']; $i++) {
              $isReserved = 0;

              for ($it = 0; $it < $numberOfSeatsOccupied; $it++) {
                if ($seatsOccupied[$it][0] == $hallInfo['hall_Row'] && $seatsOccupied[$it][1] == $i)
                  $isReserved = 1;
              }


              if ($isReserved) {
                echo "<div class='ticketing-col reserved'>";
                echo "Sold " . $rowName . $i;
              }
              else {
                echo "<div class='ticketing-col'>";
                echo "<input type='checkbox' class='checkbox' name='seat[]' value='" . $hallInfo['hall_Row'] . "|" . $i . "'>";
                echo $rowName . $i;
              }
              echo "</div>";
            }
            $hallInfo['hall_Row']--;
            echo "</div>"; // Ticketing-row end
          }
        ?>
        <div class="ticketing-row">
          <div class="ticketing-col screen">
            Screen
          </div>
        </div>
        <div class="btns" style="margin-top:20px;">
          <center>
          <button type="submit" name="submit" id="submit" class="two-button-one">Seats selected</button>
          <a href="home.php">
            <button type="button" name="cancel" class="two-button-two">Cancel</button>
          </a>
          </center>
        </div>
        <input type="hidden" name="showtime" value=" <?php echo $showtimeInfo['show_ID'] ?> ">
      </form>
    </section>
  </div>

<footer>

  <script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrap.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript">
    function check() {
      var flag = -1;
      var listOfCheckboxes = document.getElementsByClassName('checkbox');
      for (var i = 0; i < listOfCheckboxes.length; i++) {
        if (listOfCheckboxes[i].checked)
          flag = 1;
      }
      if (flag == -1) {
        alert("Please choose at least one seat.");
        return false;
      }
    }
  </script>
  <center>
  <p style="">Developed by ARK </p>
</center>
</footer>
</body>
</html>
