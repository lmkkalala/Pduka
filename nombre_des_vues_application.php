<?php
   $req="select * from NOMBRE_VUES_APPLICATION where ID_APPLICATION = $id_application ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    $nbre_visite = $u['NOMBRE_VUES_APPLICATION'];
    $nbre_visite += 1;
	$req="update NOMBRE_VUES_APPLICATION set NOMBRE_VUES_APPLICATION = $nbre_visite where ID_APPLICATION = $id_application ";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 { 
   $nbre_visite = 1;
   $req="insert into NOMBRE_VUES_APPLICATION(ID_NOMBRE_VUES_APPLICATION,NOMBRE_VUES_APPLICATION,ID_APPLICATION) values ('',$nbre_visite,$id_application)";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
?>