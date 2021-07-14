<?php
  session_start();
  require_once("connexion.php");

	$id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	$signaler = htmlspecialchars(trim(addslashes($_POST['signaler'])));
    $id_client = $_SESSION['ID'];
	
    $req="select * from SIGNALER where ID_APPLICATION = $id_application and ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into SIGNALER(ID_SIGNALER,SIGNALER,ID_CLIENT,ID_APPLICATION) values ('','$signaler',$id_client,$id_application)";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
    mysqli_free_result($rs);	
	
	require_once("bloquer_automatiquement_application.php");
	
	header("location:application.php?id_application=$id_application");
	
    mysqli_close($conn);
?>