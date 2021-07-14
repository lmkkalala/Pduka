<?php
    
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
	
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    
    $req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs8=mysqli_query($conn,$req) or die(mysqli_error());
	$ET8=mysqli_fetch_assoc($rs8);
    
    echo '<strong>'.Term($ET8['NOMBRE_ECOUTER_MUSIQUE'] + 0).'</strong>';
?>