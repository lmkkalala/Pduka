<?php
   $req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    $nbre_visite = $u['NOMBRE_VUES_MUSIQUE'];
    $nbre_visite += 1;
	$req="update NOMBRE_VUES_MUSIQUE set NOMBRE_VUES_MUSIQUE = $nbre_visite where ID_MUSIQUE = $id_musique ";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 { 
   $nbre_visite = 1;
   $req="INSERT INTO NOMBRE_VUES_MUSIQUE(NOMBRE_VUES_MUSIQUE,ID_MUSIQUE) values ('$nbre_visite','$id_musique')";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
?>