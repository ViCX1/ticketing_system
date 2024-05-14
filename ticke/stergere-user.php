<?php

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="admin"){
      header('Location: index.php?err=2');
    }

$id=mysqli_real_escape_string($link, "$_REQUEST[id]");
$query = "DELETE FROM users WHERE id=$id"; 
$result = mysqli_query($link,$query) or die ( mysqli_error());
header("Location: management_utilizatori.php"); 
?>