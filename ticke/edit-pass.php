<?php

require_once "config.php";

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="admin"){
      header('Location: index.php?err=2');
    }

$id="$_REQUEST[id]";
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($link, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="admin.php">Home</a> 
| <a href="creare_user.php">Insert New Record</a> 
| <a href="logout.php">Logout</a></p>
<h1>Update Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id= mysqli_real_escape_string($link, "$_REQUEST[id]");
//$trn_date = date("Y-m-d H:i:s");
$username = mysqli_real_escape_string($link, "$_REQUEST[username]");
$password = mysqli_real_escape_string($link, "$_REQUEST[password]");
$role = mysqli_real_escape_string($link, "$_REQUEST[role]");
$created_at = mysqli_real_escape_string($link, "$_REQUEST[created_at]");
$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
//$submittedby = $_SESSION["username"];
$update="update users set username='".$username."', password='".$param_password."',role='".$role."',created_at='".$created_at."' where id='".$id."'";
if(mysqli_query($link, $update))
{
  //  echo 'da';
} else {
   // echo 'nu';
    die(mysqli_error($link));
}
//or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='management_utilizatori.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
Name:<p><input type="text" name="username" placeholder="Enter Name" 
required value="<?php echo $row['username'];?>" /></p>
Password:<p><input type="text" name="password" placeholder="Enter the new password" 
required value="" /></p>
Role:<p><input type="text" name="role" placeholder="Enter role" 
required value="<?php echo $row['role'];?>" /></p>
<p><input type="hidden" name="created_at" placeholder="---" 
required value="<?php echo $row['created_at'];?>" /></p>

<p><input name="submit" type="submit" value="update" /></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>