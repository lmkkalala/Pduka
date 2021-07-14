<?php

    session_start();

    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
    $id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));
    $retour = htmlspecialchars(trim(addslashes($_GET['retour'])));
	

    $req="select * from ACTIVER_TELECHARGEMENT where ID_MUSIQUE = $id_musique ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if($u=mysqli_fetch_assoc($rs))
    {
        if($u['ACTIVER_TELECHARGEMENT'] == 1)
        {
            $req="update ACTIVER_TELECHARGEMENT set ACTIVER_TELECHARGEMENT = 0 where ID_MUSIQUE = $id_musique ";
            mysqli_query($conn,$req) or die(mysqli_error());
        }
        else
        {
            $req="update ACTIVER_TELECHARGEMENT set ACTIVER_TELECHARGEMENT = 1 where ID_MUSIQUE = $id_musique ";
            mysqli_query($conn,$req) or die(mysqli_error());
        }
    }
    else
    {
        $req="insert into ACTIVER_TELECHARGEMENT(ID_ACTIVER_TELECHARGEMENT,ACTIVER_TELECHARGEMENT,ID_MUSIQUE) values ('',0,$id_musique)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
	
    header("location:$retour?id_musique=$id_musique&id_compte_client=$id_compte_client&id_album=$id_album");
  
    mysqli_close($conn);
	
?>