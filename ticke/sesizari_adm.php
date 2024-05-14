<?php
require_once "config.php";
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="admin"){
      header('Location: index.php?err=2');
    }

 //tech_sort();   
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="admin.php">Home</a> 
| <a href="tech_sort.php">Sort by technician</a> 
| <a href="status_sort.php">Sort by status</a> 
| <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>Id</strong></th>
<th><strong>Subiect sesizare</strong></th>
<th><strong>Data interventie</strong></th>
<th><strong>Descriere sesizare</strong></th>
<th><strong>Prioritate sesizare</strong></th>
<th><strong>Status sesizare</strong></th>
<th><strong>Raspuns</strong></th>
<th><strong>created at</strong></th>
<th><strong>closed at</strong></th>
<th><strong>submitted by</strong></th>
<th><strong>technician</strong></th>
<th><strong>Edit</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="Select * from sesizari ORDER BY id ;";
$result = mysqli_query($link,$sel_query); //$link din config
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["Subiect_sesizare"]; ?></td>
<td align="center"><?php echo $row["Data_interventie"]; ?></td>
<td align="center"><?php echo $row["Descriere_sesizare"]; ?></td>
<td align="center"><?php echo $row["Prioritate_sesizare"]; ?></td>
<td align="center"><?php echo $row["Status_sesizare"]; ?></td>
<td align="center"><?php echo $row["Info_sesizare"]; ?></td>
<td align="center"><?php echo $row["created_at"]; ?></td>
<td align="center"><?php echo $row["closed_at"]; ?></td>
<td align="center"><?php echo $row["submittedby"]; ?></td>
<td align="center"><?php echo $row["technician"]; ?></td>
<td align="center">
<a href="edit-sesizare.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
</body>
</html>