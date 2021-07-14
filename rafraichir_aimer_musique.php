<?php
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select count(*) as nombre from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs5=mysqli_query($conn,$req) or die(mysqli_error());
    $ET5=mysqli_fetch_assoc($rs5);

    echo '<strong>'.Term($ET5['nombre']).'</strong>';
?>