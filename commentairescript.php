<?php
  session_start();
require_once("connexion.php");

$id_client = $_SESSION['ID'];

$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));

$commentaire=htmlspecialchars(trim(addslashes($_POST['commentaire'])));

if(($_POST['commentaire']) == NULL)
{
   header("location:application.php?id_application=$id_application");
   exit;
}
   $req="insert into COMMENTAIRE(ID_COMMENTAIRE,COMMENTAIRE,DATE_COMMENTAIRE,ID_APPLICATION,ID_CLIENT) values ('','$commentaire',NOW(),$id_application,$id_client)";
   mysqli_query($conn,$req) or die(mysqli_error());
   
   header("location:application.php?id_application=$id_application");
  
mysqli_close($conn);
?>