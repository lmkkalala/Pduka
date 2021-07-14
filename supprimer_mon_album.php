<?php
    session_start();
	
    require_once("connexion.php");
	
	$id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));
	$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	
	$req="select * from MUSIQUE where ID_ALBUM = $id_album ";
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
		
		$req="delete from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
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
	
	$req="delete from MUSIQUE where ID_ALBUM = $id_album ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	
	$req="select * from ALBUM where ID_ALBUM = $id_album ";
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
	
	$req="delete from ALBUM where ID_ALBUM = $id_album ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
    header("location:gestion_compte_musique1.php?id_compte_client=$id_compte_client&code=0");
  
    mysqli_close($conn);
	
?>