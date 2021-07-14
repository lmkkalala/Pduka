<?php
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
    
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));

    $req="select count(*) as nombre from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs20=mysqli_query($conn,$req) or die(mysqli_error());
    $ET20=mysqli_fetch_assoc($rs20);

    echo Term($ET20['nombre'] + 0).' Abonné'; if($ET20['nombre'] + 0 > 1) echo 's';
?>