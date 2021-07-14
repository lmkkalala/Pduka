<?php
session_start();
require_once("connexion.php");

$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
$valeur=htmlspecialchars(trim(addslashes($_GET['valeur'])));

   $req="update APPLICATION set VISIBILITE_APPLICATION = $valeur where ID_APPLICATION = $id_application";
   mysqli_query($conn,$req) or die(mysqli_error());
   
   if(isset($valeur) && $valeur == 1)
  {
    $req="delete from SIGNALER where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
  }
   
   header("location:liste_application.php");
   
mysqli_close($conn);
?>