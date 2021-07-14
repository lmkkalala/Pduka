<?php

$req="select * from CLIENT where MAIL_CLIENT = '$mail'";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
{

session_start();

$_SESSION['NIV'] = $u['NIVEAU_CLIENT'];
$_SESSION['NOM'] = $u['NOM_CLIENT'];
$_SESSION['ID_REGION'] = $u['ID_REGION'];
$_SESSION['ID'] = $u['ID_CLIENT'];

setcookie('mail', $mail , time() + 365*24*3600, null, null, false, true);
setcookie('pass', $pass , time() + 365*24*3600, null, null, false, true);

header("location:accueil.php");

}
else
{
   
session_start();
session_unset();
session_destroy();

setcookie('mail', NULL , -1, null, null, false, true);
setcookie('pass', NULL , -1, null, null, false, true);

header("location:index1.php");

}
 
?>