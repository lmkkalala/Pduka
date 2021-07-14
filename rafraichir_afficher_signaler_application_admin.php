<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client=$_SESSION['ID'];
	
	require_once("client_connecter.php");
	
	$contenu_choquant = 0;
	$contenu_non_approprie = 0;
	
	$id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
    $req="select * from SIGNALER where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {
	    if($ET['SIGNALER'] == 'Contenu choquant')
	    { 
           $contenu_choquant++;
        }
		else
		{
		   $contenu_non_approprie++;
		}
	}
    
    echo $contenu_choquant + $contenu_non_approprie;
    
?>    