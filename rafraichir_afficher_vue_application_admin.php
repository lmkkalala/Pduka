<?php
    session_start();
    require_once("connexion.php");
	
	$id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
	$req="select * from NOMBRE_VUES_APPLICATION where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET1=mysqli_fetch_assoc($rs);
	
	if(empty($ET1['NOMBRE_VUES_APPLICATION']))
	{
	   $vues = 0;
	}
	else
	{
	   $vues = $ET1['NOMBRE_VUES_APPLICATION'];
    }
    
    echo $vues;
	
?>