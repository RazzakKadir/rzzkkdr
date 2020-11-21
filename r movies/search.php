<?php
    include "connect.php";
    $search_key = isset($POST['search_key'])?
    $_POST['search_key']:'';

    if ($search_key == NULL)
    {
        echo "<script>alert('Please key in your key first!');</script>";
    }else
    {

    }
$sql="SELECT * FROM users WHERE User_Name LIKE '%".
$search_key. "%'";
$result=mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) <= 0)
    {
      echo "<script>alert('No Result!');</script>";
    }
    else
    {
        echo "<table width='90%'>";
        echo "<tr bgcolor='#CC99FF'>";
        echo "<th>Username</th>";
        echo "<th>Email</th>";
        echo "<th>Date of Birth</th>";
        echo "<th>Edit</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        //read from database and put into the table
      }while ($rows = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$rows ['User_ID']."</td>";
        echo "<td>".$rows ['User_Name']."</td>";
        echo "<td>".$rows ['User_Password']."</td>";
        echo "<td>".$rows ['User_Email']."</td>";
        echo "<td>".$rows ['User_Dob']."</td>";
        //Create 2 buttons(edit button and delete button in each column)
        echo "<td><a href='edit.php?id=".$rows['User_ID']."'><button>Edit</button></a></td>";
        echo "<td><a href='delete.php?id=".$rows['User_ID']."'><button>Delete</button></a></td>";
        echo "</tr>";
        }
      echo "</table>";
?>
