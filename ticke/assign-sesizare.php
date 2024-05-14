<?php

require_once "config.php";

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="tech"){
      header('Location: index.php?err=2');
    }

$id="$_REQUEST[id]";
$query = "SELECT * from sesizari where id='".$id."'"; 
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
<p><a href="tech.php">Home</a> 
| <a href="logout.php">Logout</a></p>
<h1>Update Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id="$_REQUEST[id]";
//$trn_date = date("Y-m-d H:i:s");
$Subiect_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Subiect_sesizare]");
$Data_interventie = mysqli_real_escape_string($link, "$_REQUEST[Data_interventie]");
$Descriere_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Descriere_sesizare]");
$Prioritate_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Prioritate_sesizare]");
$Status_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Status_sesizare]"); 
$Info_sesizare = mysqli_real_escape_string($link, "$_REQUEST[Info_sesizare]");
$created_at = mysqli_real_escape_string($link, "$_REQUEST[created_at]");
$closed_at = mysqli_real_escape_string($link, "$_REQUEST[closed_at]");
$submittedby =mysqli_real_escape_string($link, "$_REQUEST[submittedby]");
$technician =mysqli_real_escape_string($link, "$_REQUEST[technician]");
$update="update sesizari set Subiect_sesizare='".$Subiect_sesizare."', Data_interventie='".$Data_interventie."',Descriere_sesizare='".$Descriere_sesizare."',Prioritate_sesizare='".$Prioritate_sesizare."',Status_sesizare='".$Status_sesizare."' ,Info_sesizare='".$Info_sesizare."',created_at='".$created_at."',closed_at='".$closed_at."',submittedby='".$submittedby."',technician='".$technician."' where id='".$id."'";
if(mysqli_query($link, $update))
{
  //  echo 'da';
} else {
   // echo 'nu';
    die(mysqli_error($link));
}
//or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='sesizari_adm.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
ID:<input name="id" type="text" value="<?php echo $row['id'];?>" readonly/>
<br><br><br>Subiect<p><input type="text" name="Subiect_sesizare" placeholder="Subiect" 
required value="<?php echo $row['Subiect_sesizare'];?>" readonly/></p>
<br>Data la care se doreste interventia<p><input type="text" name="Data_interventie" placeholder="Data interventie" 
required value="<?php echo $row['Data_interventie'];?>" readonly/></p>
<br>Descriere sesizare<p><input type="text" name="Descriere_sesizare" placeholder="Descriere sesizare" 
required value="<?php echo $row['Descriere_sesizare'];?>" readonly/></p>
<br>Prioritate sesizare<p><input type="text" name="Prioritate_sesizare" placeholder="prioritate sesizare" 
required value="<?php echo $row['Prioritate_sesizare'];?>" readonly/></p>
<br>Status sesizare<p><input type="text" name="Status_sesizare" placeholder="status sesizare" 
required value="<?php echo $row['Status_sesizare'];?>" readonly/></p>
<br>Raspuns sesizare<p><input type="text" name="Info_sesizare" placeholder="raspuns sesizare" 
required value="<?php echo $row['Info_sesizare'];?>" /></p>
<br>Creata la data de<p><input type="text" name="created_at" placeholder="creata la data de" 
required value="<?php echo $row['created_at'];?>" readonly/></p>
<p><input type="hidden" name="closed_at" placeholder="inchisa la data de" 
required value="<?php echo $row['closed_at'];?>" /></p>
<br>Adaugata de utilizatorul<p><input type="text" name="submittedby" placeholder="adaugata de utilizatorul" 
required value="<?php echo $row['submittedby'];?>" readonly/></p>
<br>Atribuita technicianului<p><input type="text" name="technician" placeholder="atribuita technicianului" 
required value="<?php echo $row['technician'];?>" /></p>

<p><input name="submit" type="submit" value="update" /></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>