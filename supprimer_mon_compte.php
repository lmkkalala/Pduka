<?php
    session_start();
    require_once("connexion.php");
	
	$id_client = $_SESSION['ID'];
	
	$req="delete from CLIENT where ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="select * from CLIENT where ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET=mysqli_fetch_assoc($rs);

	$photo_client = 'Medias/photo_clients/'.$ET['PHOTO_CLIENT'];
	
	if(! empty($photo_client) && $photo_client != 'Medias/photo_clients/profil.png')
		{
		   if(file_exists($photo_client) && is_file($photo_client))
		   {
                unlink($photo_client);

           }
        }
		
	$req="select * from COMPTE_CLIENT where ID_CLIENT = $id_client ";
    $rs7=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET7=mysqli_fetch_assoc($rs7))
	{
	$photo_compte_client = 'Medias/photo_compte_clients/'.$ET7['PHOTO_COMPTE_CLIENT'];
	
	if(! empty($photo_compte_client))
		{
		   if(file_exists($photo_compte_client) && is_file($photo_compte_client))
		   {
                 unlink($photo_compte_client);

           }
        }
	
	$id_compte_client = $ET7['ID_COMPTE_CLIENT'];
	
	$req="select * from APPLICATION where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET1=mysqli_fetch_assoc($rs1))
	{
	$fichier_application = 'Medias/application/'.$ET1['APPLICATION'];
	$logo_application = 'Medias/logo/'.$ET1['LOGO_APPLICATION'];
	
	if(! empty($fichier_application))
		{
		   if(file_exists($fichier_application) && is_file($fichier_application))
		   {
                 unlink($fichier_application);

           }
        }
	if(! empty($logo_application))
		{
		   if(file_exists($logo_application) && is_file($logo_application))
		   {
                 unlink($logo_application);

           }
        }
	
	$id_application = $ET1['ID_APPLICATION'];
	
	$req="delete from APPLICATION where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="select * from CAPTURE where ID_APPLICATION = $id_application ";
    $rs3=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET3=mysqli_fetch_assoc($rs3))
	{
	
	$capture = 'Medias/capture/'.$ET3['CAPTURE'];
	
	if(! empty($capture))
		{
		   if(file_exists($capture) && is_file($capture))
		   {
                 unlink($capture);

           }
        }
		
    }

	$req="delete from CAPTURE where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="delete from NOMBRE_TELECHARGEMENT where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="delete from NOMBRE_VUES_APPLICATION where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="delete from SIGNALER where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	$req="select * from COMMENTAIRE where ID_APPLICATION = $id_application ";
    $rs2=mysqli_query($conn,$req) or die(mysqli_error());
	if($ET2=mysqli_fetch_assoc($rs2))
	{
	
	$id_commentaire = $ET2['ID_COMMENTAIRE'];
	
	$req="delete from AIMER where ID_COMMENTAIRE = $id_commentaire ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	}
	
	$req="delete from COMMENTAIRE where ID_APPLICATION = $id_application ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	}
	

    // suppression des albums et musiques
	
	$req="select * from MUSIQUE where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs4=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET4=mysqli_fetch_assoc($rs4))
	{
	
	    $logo_musique = 'Medias/logo_musique/'.$ET4['LOGO_MUSIQUE'];
	    $musique = 'Medias/musique/'.$ET4['MUSIQUE'];
		
	    if(! empty($logo_musique))
		{
		   if(file_exists($logo_musique) && is_file($logo_musique))
		   {
                 unlink($logo_musique);

           }
        }
		
	    if(! empty($musique))
		{
		   if(file_exists($musique) && is_file($musique))
		   {
                 unlink($musique);

           }
        }
		
		$id_musique = $ET4['ID_MUSIQUE'];
		
		$req="delete from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	    $req="delete from ACTIVER_TELECHARGEMENT where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	    $req="delete from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
		
		$req="delete from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
		
		$req="delete from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
		
		$req="select * from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs6=mysqli_query($conn,$req) or die(mysqli_error());
		
	    if($ET6=mysqli_fetch_assoc($rs6))
	    {
	
	        $id_commentaire_musique = $ET6['ID_COMMENTAIRE_MUSIQUE'];
	
	        $req="delete from AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = $id_commentaire_musique ";
            $rs=mysqli_query($conn,$req) or die(mysqli_error());
			
			$req="delete from PAS_AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = $id_commentaire_musique ";
            $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	    }
	
	    $req="delete from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	
	}
	
	$req="delete from MUSIQUE where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	
	$req="select * from ALBUM where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs5=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET5=mysqli_fetch_assoc($rs5))
	{
	
	    $logo_album = 'Medias/logo_album/'.$ET5['COVER_ALBUM'];
		
	    if(! empty($logo_album))
		{
		   if(file_exists($logo_album) && is_file($logo_album))
		   {
                 unlink($logo_album);

           }
        }
		
	}
	
	$req="delete from ALBUM where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	}
	
	$req="delete from COMPTE_CLIENT where ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	setcookie('mail', NULL , -1, null, null, false, true);
    setcookie('pass', NULL , -1, null, null, false, true);
		
    header("location:index1.php?code=6&deconnexion=0");
	   
    mysqli_close($conn);
?>