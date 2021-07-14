<?php
    session_start();
    require_once("connexion.php");
    include('fonction_terminaison.php');
    include('fonction_temps_ecoule.php');

    $id_client = htmlspecialchars(trim(addslashes($_SESSION['ID'])));
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));

    $req="select * from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique and ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
    if($ET=mysqli_fetch_assoc($rs))
    {
        $aime = '<span style=" color: #f4e195; ">Déjà aimé</span>' ;
    }
    else
    {
        $aime = '<span>J\'aime</span>';
    }

    $aimer_musique = '<strong>0</strong>';

    $req="select count(*) as nombre from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs0=mysqli_query($conn,$req) or die(mysqli_error());
    $ET0=mysqli_fetch_assoc($rs0);

    $aimer_musique = '<strong>'.Term($ET0['nombre']).'</strong>';

    
    $nombre_abonner_compte = 0;

    $req="select count(*) as nombre from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client ";
	$rs1=mysqli_query($conn,$req) or die(mysqli_error());
	$ET1=mysqli_fetch_assoc($rs1);

    $nombre_abonner_compte = Term($ET1['nombre']);

    
    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

    $req="select * from MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs2=mysqli_query($conn,$req) or die(mysqli_error());
    $ET2=mysqli_fetch_assoc($rs2);

    $duree = '<strong>'.duree($ET2['DATE_MUSIQUE']).'</strong>';

    

    $table = array(
        'DUREE' => '<strong>'.duree($ET2['DATE_MUSIQUE']).'</strong>',
        'aime' => $aime,
        'aimer_musique' => $aimer_musique,
        'nombre_abonner_compte' => $nombre_abonner_compte,
    );
    echo json_encode($table);

?>