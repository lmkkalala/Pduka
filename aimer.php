<?php
    session_start();
    require_once("connexion.php");
	
	$id_commentaire = htmlspecialchars(trim(addslashes($_GET['id_commentaire'])));
	//$id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
    $id_client = $_SESSION['ID'];
	
    $req="select * from AIMER where ID_COMMENTAIRE = $id_commentaire and ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into AIMER(ID_AIMER,ID_CLIENT,ID_COMMENTAIRE) values ('','$id_client',$id_commentaire)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
	header("location:application.php");

    mysqli_free_result($rs);
    mysqli_close($conn);
?>