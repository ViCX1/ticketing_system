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
<h2>Sort by:</h2>
| <a href="status_sort_a.php">Deschise</a> 
| <a href="status_sort_i.php">Inchise</a> 
</body>
</html>