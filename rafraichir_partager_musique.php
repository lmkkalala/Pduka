<?php
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs170=mysqli_query($conn,$req) or die(mysqli_error());
    $ET170=mysqli_fetch_assoc($rs170);

    echo '<strong>'.Term($ET170['NOMBRE_PARTAGER_MUSIQUE'] + 0).'</strong>';
?>