<?php
    session_start();
    require_once("connexion.php");
    
    $id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
	$req="select * from NOMBRE_TELECHARGEMENT where ID_APPLICATION = $id_application ";
    $rs3=mysqli_query($conn,$req) or die(mysqli_error());
    $ET3=mysqli_fetch_assoc($rs3);
 
    if($ET3['NOMBRE_TELECHARGEMENT'] == 0)
    {
        $nbre_telechargement = 0;
    } 
    else 
    {  
        $nbre_telechargement = $ET3['NOMBRE_TELECHARGEMENT'];
    }

    echo $nbre_telechargement;

?>