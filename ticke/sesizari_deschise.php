<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="tech.php">Home</a>
| <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
</div>
</body>
</html>

<?php
require_once "config.php";
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || ($role!="tech")){
      header('Location: index.php?err=2');
    }

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$user = mysqli_real_escape_string($link, $_SESSION['username']);
$sql = "SELECT * FROM sesizari WHERE technician IS NULL";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table border =2  style=border-collapse:collapse cellpadding=8 cellspacing=50;>";
            echo "<tr>";
            echo "<th><strong>Id</strong></th>";
            echo "<th><strong>Subiect</strong></th>";
            echo "<th><strong>Data interventie</strong></th>";
            echo "<th><strong>Descriere</strong></th>";
            echo "<th><strong>Prioritate</strong></th>";
            echo "<th><strong>Status</strong></th>";
            echo "<th><strong>Info</strong></th>";
            echo "<th><strong>Created at</strong></th>";
            echo "<th><strong>Submitted by</strong></th>";
            echo "<th><strong>Assigned to</strong></th>";
            echo "<th><strong>Edit</strong></th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td align=center>" . $row['id'] . "</td>";
                echo "<td align=center>" . $row['Subiect_sesizare'] . "</td>";
                echo "<td align=center>" . $row['Data_interventie'] . "</td>";
                echo "<td align=center>" . $row['Descriere_sesizare'] . "</td>";
                echo "<td align=center>" . $row['Prioritate_sesizare'] . "</td>";
                echo "<td align=center>" . $row['Status_sesizare'] . "</td>";
                echo "<td align=center>" . $row['Info_sesizare'] . "</td>";
                echo "<td align=center>" . $row['created_at'] . "</td>";
                //echo "<td align=center>" . $row['closed_at'] . "</td>";
                echo "<td align=center>" . $row['submittedby'] . "</td>";
                echo "<td align=center>" . $row['technician'] . "</td>";
                echo "<td align=center><a href=assign-sesizare.php?id=" . $row["id"] . ">Edit</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

