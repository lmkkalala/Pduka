<?php
    
    session_start();
    require_once("connexion.php");

    include('fonction_terminaison.php');
	
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
    
    $req="select count(*) as nombre from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client ";
	$rs10=mysqli_query($conn,$req) or die(mysqli_error());
	$ET10=mysqli_fetch_assoc($rs10);
    
    echo Term($ET10['nombre']);
?>