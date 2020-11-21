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
      <center><u><h2>Ticket buying</h2></u></center>
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
    <section class="buy">
      <form method="post" action="confirmbuy.php">
        <?php
          for ($i = 0; $i < sizeof($_POST['seat']); $i++) {
            list($row,$col) = explode('|', $_POST['seat'][$i]);
            $rowName = chr(65 + $row - 1);
            echo "<h3 style='padding: 0 1rem 0.3rem 0.5rem; float:left; width:10%; box-sizing: border-box;'>" . $rowName . $col . ": </h3>";
        ?>
          <select name="type[]" style="width:90%;">
            <option value="20">
              Adult (RM 20)
            </option>
            <option value="15">
              Student/Senior (RM 15)
            </option>
          </select>

          <input type="hidden" name="seat[]" value="<?php echo $_POST['seat'][$i] ?>">
          <div class="clearfix"></div>
        <?php
          }
        ?>
        <div class="clearfix"></div>
        <button type="submit" name="submit" id="submit" class="two-button-one">Confirm Order</button>
        <a href="home.php">
          <button type="button" name="cancel" class="two-button-two">Cancel</button>
        </a>
        <input type="hidden" name="showtime" value="<?php echo $_POST['showtime'] ?>">
      </form>
    </section>
  </div>

<footer>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="js/bootstrap(js)/bootstrap.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <center>
  <p style="color:white;">Developed by ARK </p>
  </center>
</footer>
</body>
</html>
