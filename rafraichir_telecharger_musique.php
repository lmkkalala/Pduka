<?php
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs4=mysqli_query($conn,$req) or die(mysqli_error());
    $ET4=mysqli_fetch_assoc($rs4);

    echo '<strong>'.Term($ET4['NOMBRE_TELECHARGEMENT_MUSIQUE'] + 0).'</strong>';
?>