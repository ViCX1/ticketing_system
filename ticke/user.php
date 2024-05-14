<?php

require_once "config.php";
 
session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="user"){
      header('Location: admin.php');
    }
    
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {  //se da insert cand dau submit , fara asta se executa direct cand se incarca pagina
// Escape user inputs for security
$Subiect_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Subiect_sesizare]");
$Data_interventie = mysqli_real_escape_string($link, "$_REQUEST[Data_interventie]");
$Descriere_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Descriere_sesizare]");
$Prioritate_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Prioritate_sesizare]");
$Status_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Status_sesizare]");
$submittedby = mysqli_real_escape_string($link, "$_SESSION[username]");
 
// Attempt insert query execution

$sql = "INSERT INTO sesizari (Subiect_sesizare, Data_interventie, Descriere_sesizare, Prioritate_sesizare, Status_sesizare, submittedby) VALUES ('$Subiect_sesizare', '$Data_interventie', '$Descriere_sesizare', '$Prioritate_sesizare', 'activa', '$submittedby')";
if(mysqli_query($link, $sql)){
    echo "Sesizarea a fost trimisa!";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        
    <div class ="buton">
        <a href="logout.php" class="btn btn-info" role="button">Logout</a> 
        <a href="sesizari_user.php" class="btn btn-info" role="button">Lista sesizari</a> </div> </div> 
    </div> 

    <h2>Formular cu posibilitatea de deschidere rapidă a unei sesizări</h2>
    <br><br>
<p><span class="error">* OBLIGATORIU</span></p>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Subiect sesizare: <input type="text" name="Subiect_sesizare">
  <span class="error">* <?php echo $Subiect_sesizare_err;?></span>
  <br><br>
  Data interventie(format YYYY-MM-DD): <input type="text" name="Data_interventie">
  <span class="error">* <?php echo $Data_interventie_err;?></span>
  <br><br>

  Descriere sesizare: <textarea name="Descriere_sesizare" rows="5" cols="40"></textarea>
  <br><br>
  Prioritate sesizare:
  <input type="radio" name="Prioritate_sesizare" value="scazuta">Scazuta
  <input type="radio" name="Prioritate_sesizare" value="medie">Medie
  <input type="radio" name="Prioritate_sesizare" value="inalta">Inalta
  <input type="radio" name="Prioritate_sesizare" value="critica">Critica
  <span class="error">* <?php echo $Prioritate_sesizareErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Trimite">  
</form>

