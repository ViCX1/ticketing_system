<?php 
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
        

  <a href="sesizari_adm.php">Lista sesizari</a> 
| <a href="management_utilizatori.php">Management utilizatori</a> 
| <a href="stats.php">Statistici</a> 
| <a href="logout.php">Logout</a></p>
            
        
    </div>    
</body>
</html>