<?php
    session_start();
    require_once("connexion.php");
    
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
    $id_client = htmlspecialchars(trim(addslashes($_GET['id_client'])));

    $req="select * from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client and ID_CLIENT = $id_client ";
    $rs20=mysqli_query($conn,$req) or die(mysqli_error());
    if($ET20=mysqli_fetch_assoc($rs20))
    {
        echo '<span style=" color: #f4e195;"><i class="fa fa-play"></i> Abonné</span>';
    }
    else
    {
        echo '<span><i class="fa fa-play"></i> S\'abonner</span>';
    }
?>