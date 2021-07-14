<?php
    session_start();
    require_once("connexion.php");
    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs = mysqli_query($conn,$req) or die(mysqli_error());
    $ET = mysqli_fetch_assoc($rs);

    echo '<span style="color: teal;">Vous avez </span><strong>'.(($ET['NOMBRE_ECOUTER_MUSIQUE'] + 0) * 20) .' Fc</strong><span style="color: teal;"> dans votre compte promotion.</span>';
?>