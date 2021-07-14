<?php
   require_once("connexion.php");

   $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
   
   $req="select * from NOMBRE_PARTAGER_APPLICATION where ID_APPLICATION = $id_application ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    $nbre_partager = $u['NOMBRE_PARTAGER_APPLICATION'];
    $nbre_partager += 1;
	$req="update NOMBRE_PARTAGER_APPLICATION set NOMBRE_PARTAGER_APPLICATION = $nbre_partager where ID_APPLICATION = $id_application ";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 { 
   $nbre_partager = 1;
   $req="insert into NOMBRE_PARTAGER_APPLICATION(ID_NOMBRE_PARTAGER_APPLICATION,NOMBRE_PARTAGER_APPLICATION,ID_APPLICATION) values ('',$nbre_partager,$id_application)";
   mysqli_query($conn,$req) or die(mysqli_error());
 }
?>