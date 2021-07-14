<?php
    require_once("connexion.php");
    
    $req="select COUNT(*) AS nombre from CLIENT_CONNECTER ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
    $ET=mysqli_fetch_assoc($rs);

    echo '<span style="color: teal;">Vous avez </span><strong>'.($ET['nombre']) .'</strong><span style="color: teal;"> clients connectés</span>';
?>