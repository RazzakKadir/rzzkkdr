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
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/bootstrap(css)/bootstrap-grid.css"/>
  <script type="text/javascript" src="js/script.js"></script>
  <style media="screen">
#movies{
  padding-top: 100px;
  color: white;
}
#movies img{
  width:200px;
}

#aboutUs{
  padding:50px;
  color: white !important;
}
#aboutUs h1::after {
    content: '';
    background: white !important;
    display: block;
    height: 3px;
    width: 170px;
    margin: 20px auto 5px;
    margin-bottom: 20px;
}
.movieButton{
  margin-left: 5px;
  color: white;
  width: 30%;
  background: transparent;
  border: 1px solid white;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  margin: 12px 10px ;
  transition: 0.5s;
  box-shadow: 0 0 10px 4px white;
}
  </style>
</head>
<body>
  <header id="navBar">
      <nav class="navbar navbar-expand-lg">
          <a class="navbarBrand" href="home.php"><img src="img/r.jpg"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="" aria-hidden="true"></i></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#movies">Movies</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#aboutUs">about Us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#contact">Contact Us</a>
                  </li>
									<li class="nav-item dropdown">
										<div>
	                    <a class="nav-link dropdown" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<img src="img/user_profile.png"  >
                        <?php  if (isset($_SESSION['user'])) : ?>
                          <strong><?php echo $_SESSION['user']; ?></strong>
                        <?php endif ?>

	                    </a>
										</div>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="bookingHistory.php" style="color: red;">Booking History</a>
                      <a class="dropdown-item" href="logout.php" style="color: red;">logout</a>
                    </div>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <div id="slider">
      <div id="headerSlider" class="carousel slide carousel-fade" data-ride="carousel" >
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <img src="img/it.jpg" class="d-block img-fluid" alt="First slide">
              </div>
              <div class="carousel-item">
                  <img src="img/sm.jpg" class="d-block img-fluid" alt="Second slide">
              </div>
              <div class="carousel-item">
                  <img src="img/divergent.jpeg" class="d-block img-fluid" alt="Third slide">
              </div>
              <div class="carousel-item">
                  <img src="img/47.jpg" class="d-block img-fluid" alt="Fifth slide">
              </div>
          </div>
          <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
  <div id="movies">
    <center>
      <center><h1>Movies</h1></center>
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
          ?>
          <div class=container>
            <div class="row">
              <div class="col-5">
                <img src="<?php echo $rows['photo_path']?>">
              </div>
              <div class="col-7">
                <h3><?php echo $rows ['movie_Name']?></h3>
                <p><?php echo $rows ['movie_Synopsis'] ?></p>
                <form style="padding:0;" method="post" action="seatBookings.php">
          SHOWTIME:<select name="showtime">
                    <?php
                      $query = "SELECT * FROM showtime_t WHERE movie_ID = ".$rows['movie_ID'];
                      $myrecord = mysqli_query($connect, $query) or die("Query Error!".mysqli_error($connect));
                      while ($rows2 = mysqli_fetch_array($myrecord)) {
                    ?>
                    <!-- Drop down section -->
                      <option value="<?php echo $rows2['show_ID'] ?>">
                        <?php echo $rows2['show_Date'] . " " . $rows2['show_Time'] . " (" . $rows2['show_Day'] . ")"?>
                      </option>
                    <?php
                      }
                      mysqli_free_result($myrecord);
                     ?>
                   </select>
                   <button type="submit" name="submit" id="submit" class="movieButton">Book</button>
                </form>
              </div>
            </div>
          </div>
      <?php }?>
    </center>
  </div>
  <center>
  <div id="aboutUs">
    <h1>About Us</h1>
    <p>Since first opening our doors in 1994, we’ve entertained countless moviegoers with memories of a special day out.
From the latest blockbusters to intimate dramas, with a dash of documentaries, sports and culture also in the mix, TGV’s
diverse range of entertainment means there’s something for everyone. Pamper yourself in the trappings of Malaysia’s premier
luxury cinema, TGV Indulge, or lounge in the blissful comfort of our Beanieplex halls. Why not bring your kids for some Family
Friendly fun, or treat your eyes to the astonishing clarity of the world's largest cinema LED screen, Samsung ONYX. To top it
all off, dive into the most immersive movie experience on Earth - IMAX®. The choice is yours!</p>
</div>
  </center>
  <section id="contact">
      <div class="contact-section">
          <h1>Contact Us</h1>
          <form class="contact-form" method="post">
              <input type="text" class="contact-form-text" placeholder="Name">
              <input type="email" class="contact-form-text" placeholder="Email Address">
              <input type="text" class="contact-form-text" placeholder="Contact Number">
              <textarea class="contact-form-text" placeholder="Your Message"></textarea>
              <input type="submit" class=" contact-form-btn" value="Send">
          </form>
      </div>
  </section>

  <button onclick="topFunction()"id="topBtn"><i class="fa fa-angle-double-up" aria-hidden="true">UP</i></button>
<footer>
<script type="text/javascript" src="js/bootstrap(js)/bootstrapjquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="js/bootstrap(js)/bootstrap.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript">
mybutton = document.getElementById("topBtn");

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.documentElement.scrollTop = 0;
}
</script>

<center>
<p style="color:white;">Developed by ARK </p>
</center>
</footer>
</body>
</html>
