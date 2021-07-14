<?php
    session_start();
    require_once("connexion.php");

    include('fonction_temps_ecoule.php');
    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
    $ET=mysqli_fetch_assoc($rs);

    echo '<strong>'.duree($ET['DATE_MUSIQUE']).'</strong>';
?>