<?php
    session_start();
	
    require_once("connexion.php");
	
	$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
	$id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	
	$req="select * from APPLICATION where ID_APPLICATION = $id_application ";
    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
	
	$ET1=mysqli_fetch_assoc($rs1);
	
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
	
	
    header("location:gestion_compte_developpeur.php?id_compte_client=$id_compte_client&code=4");
  
    mysqli_close($conn);
	
?>