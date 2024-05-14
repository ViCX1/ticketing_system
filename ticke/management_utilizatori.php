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
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="admin.php">Home</a> 
| <a href="creare_user.php">Insert New Record</a> 
| <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>Id</strong></th>
<th><strong>Username</strong></th>
<th><strong>Role</strong></th>
<th><strong>Registration Date</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="Select * from users ORDER BY id ;";
$result = mysqli_query($link,$sel_query); //$link din config
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["username"]; ?></td>
<td align="center"><?php echo $row["role"]; ?></td>
<td align="center"><?php echo $row["created_at"]; ?></td>
<td align="center">
<a href="edit-user.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="stergere-user.php?id=<?php echo $row["id"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
</body>
</html>