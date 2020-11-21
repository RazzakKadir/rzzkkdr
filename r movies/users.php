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
    <meta >
    <title>Users</title>
    <style media="screen">
    *{
      margin: 0;
      padding:0;
      background-color: #808080;
      font-weight:bold;
    }
    #navBar img{
      margin-top: 10px;
      margin-bottom: 15px;
      border-radius:60px 60px 60px 60px;
    }
    #memBer{
      width: 71%;
      height:40px;
      margin-top:20px;
      margin-bottom: 40px;
      box-shadow: 0 20px 30px 0;
    }
    .home{
      border: 0.1px solid ;
      width: 100%;
      padding: 5px;
      margin-bottom: 50px;
      transition: 0.5s;
      background: transparent;
    }
    .home:hover{
      box-shadow: 0 0 10px 4px black;
    }
    .button:hover{
      box-shadow: 0 0 10px 4px black;
    }
    table{
      width:70%;
    }
    #searchBar{
      margin: 20px;
    }
    ::placeholder{
      color: black;
      text-align: center;
    }
    input{
      padding: 5px;
    }
#searchBar input{
  cursor: pointer;
}
    </style>
  </head>
  <body>
  <center>
    <a href="adminpage.php"><input type="button" class="home" value="HOME" style="font-weight:bold;"></a>
    <header id="navBar" >
      <img src="img/admin.png"></br>
    </header>
      <div id="memBer">
        <h2>Users</h2>
      </div>
      <a href='create_user.php'><button class='button' style='padding: 10px;margin:20px;'>Create Users</button></a>

      <form id="searchBar" method="post" action="users.php">
        <input name="search_key" type="text" placeholder="Enter Username" />
        <input name="submit1" type="submit" value="Search" />
        <a href="users.php"><input name="back" type="submit" value="Back" /></a>
      </form>
      <?php
      include('connect.php');//add connection to the php page
      $search_key = isset($_POST['search_key'])?$_POST['search_key']:'';

      	if ($search_key === NULL)
      	{

      	}
      	else
      	{
        }
        $sql="SELECT * FROM users_t WHERE user_Name like '%".$search_key. "%'";
        $result = mysqli_query($connect, $sql);// run the sql query and all the data store in variable result

        if(mysqli_num_rows($result)<=0)//if no result, then run the die () code
        {
          echo "<script>alert('No data from database!');";
          die("window.location.href='users.php';</script>");
        }
        else
        {
          echo "<table border='1' class='userDetail' style='text-align:center;'>";
          echo "<tbhead>";
          echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>Username</th>";
          echo "<th>Email</th>";
          echo "</tr>";
          echo "</tbhead>";

        }while ($rows =mysqli_fetch_array($result))
        {
          echo "<tr>";
          echo "<td>".$rows ['user_ID']."</td>";
          echo "<td>".$rows ['user_Name']."</td>";
          echo "<td>".$rows ['user_Email']."</td>";
          echo "</tr>";
        }

       ?>
    </table>
  </center>
  </body>
</html>
