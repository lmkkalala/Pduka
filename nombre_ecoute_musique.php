<?php
   require_once("connexion.php");

   $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
   
   $req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    $nbre_ecoute = $u['NOMBRE_ECOUTER_MUSIQUE'];
    $nbre_ecoute += 1;
	$req="update NOMBRE_ECOUTER_MUSIQUE set NOMBRE_ECOUTER_MUSIQUE = $nbre_ecoute where ID_MUSIQUE = $id_musique ";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 { 
   $nbre_ecoute = 1;
   $req="insert into NOMBRE_ECOUTER_MUSIQUE(ID_NOMBRE_ECOUTER_MUSIQUE,NOMBRE_ECOUTER_MUSIQUE,ID_MUSIQUE) values ('',$nbre_ecoute,$id_musique)";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
?>