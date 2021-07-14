<?php
session_start();
require_once("connexion.php");

$id_client = $_SESSION['ID'];

$id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));

$commentaire=htmlspecialchars(trim(addslashes($_POST['commentaire'])));

if(($_POST['commentaire']) == NULL)
{
   header("location:musique.php?id_musique=$id_musique");
   exit;
}
   $req="insert into COMMENTAIRE_MUSIQUE(ID_COMMENTAIRE_MUSIQUE,COMMENTAIRE_MUSIQUE,DATE_COMMENTAIRE_MUSIQUE,ID_MUSIQUE,ID_CLIENT) values ('','$commentaire',NOW(),$id_musique,$id_client)";
   mysqli_query($conn,$req) or die(mysqli_error());
   
   header("location:musique.php?id_musique=$id_musique");
  
mysqli_close($conn);
?>