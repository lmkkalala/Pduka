<?php
   require_once("connexion.php");

   $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
   
   $req="select * from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    $nbre_partager = $u['NOMBRE_PARTAGER_MUSIQUE'];
    $nbre_partager += 1;
	$req="update NOMBRE_PARTAGER_MUSIQUE set NOMBRE_PARTAGER_MUSIQUE = $nbre_partager where ID_MUSIQUE = $id_musique ";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 { 
   $nbre_partager = 1;
   $req="insert into NOMBRE_PARTAGER_MUSIQUE(ID_NOMBRE_PARTAGER_MUSIQUE,NOMBRE_PARTAGER_MUSIQUE,ID_MUSIQUE) values ('',$nbre_partager,$id_musique)";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
?>