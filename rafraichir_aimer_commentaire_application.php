<?php
session_start();
require_once("connexion.php");

 $id_commentaire = htmlspecialchars(trim(addslashes($_GET['id_commentaire'])));
 
 $req="select count(*) as nombre from AIMER where ID_COMMENTAIRE = $id_commentaire ";
 $rs2=mysqli_query($conn,$req) or die(mysqli_error());
 $ET4=mysqli_fetch_assoc($rs2);

echo $ET4['nombre'];

?>