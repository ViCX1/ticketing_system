<?php 
    session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="tech"){
      header('Location: index.php?err=2');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TECHNICIAN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        
    <a href="sesizari_tech.php">Sesizarile mele</a> 
| <a href="sesizari_deschise.php">Sesizari deschise</a> 
| <a href="logout.php">Logout</a></p>
            
        
    </div>    
</body>
</html>