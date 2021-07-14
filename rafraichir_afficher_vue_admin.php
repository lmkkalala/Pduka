<?php
    
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
	
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    
    $req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
	$rs9=mysqli_query($conn,$req) or die(mysqli_error());
	$ET9=mysqli_fetch_assoc($rs9);
    
    echo Term($ET9['NOMBRE_VUES_MUSIQUE'] + 0);
?>