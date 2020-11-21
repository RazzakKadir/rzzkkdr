<?php

 session_start();

 echo "<script>alert('You already logged out! Thank You ".$_SESSION['user']."!')</script>";

 session_destroy();

 echo "<script>window.location.href='index.php'</script>";

 ?>
