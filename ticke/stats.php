<?php 

require_once "config.php";

ini_set('display_errors',1);
error_reporting(E_ALL);

    session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="admin"){
      header('Location: index.php?err=2');
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 650px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        

  <a href="admin.php">Home</a> 
| <a href="logout.php">Logout</a></p>
            
        
    </div>    
</body>
</html>

<?php

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT Status_sesizare FROM sesizari WHERE Status_sesizare='activa'";

if ($result=mysqli_query($link,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  printf("Exista %d sesizari active.\n",$rowcount);
  // Free result set
  mysqli_free_result($result);
  }

//mysqli_close($link);
?>

<?php

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT Status_sesizare FROM sesizari WHERE Status_sesizare='inactiva'";

if ($result=mysqli_query($link,$sql))
  {
  
  $rowcount=mysqli_num_rows($result);
  echo "<br><br>";
  printf("\nExista %d sesizari inactive.\n",$rowcount);
  echo "<br><br>";
  
  mysqli_free_result($result);
  }

//mysqli_close($link);
?>

<?php /*

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql="SELECT Status_sesizare FROM sesizari WHERE Status_sesizare='activa'";

if ($result=mysqli_query($link,$sql))
  {
  // Return the number of rows in result set
  $origin = mysqli_real_escape_string($link, $_REQUEST['$created_at']);
$target = mysqli_real_escape_string($link, $_REQUEST['$closed_at']);
$interval = date_diff($origin, $target);
echo $interval->format('%R%a days');
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($link);


*/

?>