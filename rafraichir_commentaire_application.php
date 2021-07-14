<?php
    require_once("connexion.php");

    include('fonction_temps_ecoule.php');

    $id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
                            
    $req="select * from COMMENTAIRE where ID_APPLICATION = $id_application order by DATE_COMMENTAIRE desc";
    $rs1=mysqli_query($conn,$req) or die(mysqli_error());

    while($ET1=mysqli_fetch_assoc($rs1))
    {

        echo '</h4><hr><p>'.wordwrap($ET1['COMMENTAIRE'],80,'<br/>').'</p>';
       
    }
?>