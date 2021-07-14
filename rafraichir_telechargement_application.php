<?php
session_start();
require_once("connexion.php");

include('fonction_terminaison.php');

 $id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
 
 $req="select * from NOMBRE_TELECHARGEMENT where ID_APPLICATION = $id_application ";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 $ET3=mysqli_fetch_assoc($rs);
 
if($ET3['NOMBRE_TELECHARGEMENT'] == 0)
{
     $nbre_telechargement = 0;
} 
else 
{  
     $nbre_telechargement = $ET3['NOMBRE_TELECHARGEMENT'];
}

echo '<strong>'.Term($nbre_telechargement + 0).'</strong>';

?>