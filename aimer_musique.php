<?php
    session_start();
    require_once("connexion.php");
	
	$id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    $id_client = $_SESSION['ID'];
	
    $req="select * from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique and ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into AIMER_MUSIQUE(ID_AIMER_MUSIQUE,ID_CLIENT,ID_MUSIQUE) values ('','$id_client',$id_musique)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
    else
    {
        $id_aimer_musique = $u['ID_AIMER_MUSIQUE'];

        $req="delete from AIMER_MUSIQUE where ID_AIMER_MUSIQUE = $id_aimer_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error()); 
    }

	header("location:musique.php?id_musique=$id_musique");

    mysqli_free_result($rs);
    mysqli_close($conn);
?>