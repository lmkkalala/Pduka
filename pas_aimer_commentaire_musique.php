<?php
    session_start();
    require_once("connexion.php");
	
	$id_commentaire_musique = htmlspecialchars(trim(addslashes($_GET['id_commentaire_musique'])));
	//$id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    $id_client1 = $_SESSION['ID'];
	
    $req="select * from PAS_AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = $id_commentaire_musique and ID_CLIENT = $id_client1 ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into PAS_AIMER_COMMENTAIRE_MUSIQUE(ID_PAS_AIMER_COMMENTAIRE_MUSIQUE,ID_CLIENT,ID_COMMENTAIRE_MUSIQUE) values ('','$id_client1',$id_commentaire_musique)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
	header("location:musique.php");

    mysqli_free_result($rs);
    mysqli_close($conn);
?>