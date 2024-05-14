<html>
    <body>
    <div class ="buton">
        <a href="logout.php" class="btn btn-info" role="button">Logout</a> 
        <a href="user.php" class="btn btn-info" role="button">Acasa<br><br></a> </div> </div> 
    </div> 
</body>
    </html>

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "config.php";

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || ($role!="user" && $role!="admin" && $role!="tech")){
      header('Location: index.php?err=2');
    }
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM sesizari";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Nr.</th>";
                echo "<th>Subiect</th>";
                echo "<th>Data</th>";
                echo "<th>Descriere</th>";
                echo "<th>Prioritate</th>";
                echo "<th>Status</th>";
                echo "<th>Info</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['Subiect_sesizare'] . "</td>";
                echo "<td>" . $row['Data_interventie'] . "</td>";
                echo "<td>" . $row['Descriere_sesizare'] . "</td>";
                echo "<td>" . $row['Prioritate_sesizare'] . "</td>";
                echo "<td>" . $row['Status_sesizare'] . "</td>";
                echo "<td>" . $row['Info_sesizare'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

