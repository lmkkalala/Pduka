<?php
    session_start();
    require_once("connexion.php");

    $id_client = htmlspecialchars(trim(addslashes($_GET['id_client'])));
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique and ID_CLIENT = $id_client ";
    $rs20=mysqli_query($conn,$req) or die(mysqli_error());
    if($ET20=mysqli_fetch_assoc($rs20))
    {
        echo '<span style=" color: #f4e195; ">Déjà aimé</span>' ;
    }
    else
    {
        echo '<span>J\'aime</span>';
    }
?>