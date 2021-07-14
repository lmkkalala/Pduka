<?php
    session_start();
    require_once("connexion.php");
	
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
    
    $id_client1 = $_SESSION['ID'];
	
    $req="select * from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client and ID_CLIENT = $id_client1 ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into ABONNER_COMPTE(ID_ABONNER_COMPTE,ID_CLIENT,ID_COMPTE_CLIENT) values ('','$id_client1',$id_compte_client)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
    else
    {
        $id_abonner_compte = $u['ID_ABONNER_COMPTE'];

        $req="delete from ABONNER_COMPTE where ID_ABONNER_COMPTE = $id_abonner_compte ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error()); 
    }

    mysqli_free_result($rs);
    mysqli_close($conn);
?>