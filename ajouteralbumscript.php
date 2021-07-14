<?php
 session_start();
require_once("connexion.php");

$titre = htmlspecialchars(trim(addslashes($_POST['titre'])));
$artiste = htmlspecialchars(trim(addslashes($_POST['artiste'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));

if(isset($_POST['condition']) && isset($_POST['retour']))
{
   $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
   $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
}

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

$logo=htmlspecialchars(trim(addslashes($_FILES['logo']['name'])));

$extension = pathinfo($logo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
   $logo = 'Pstore_Cover_'.md5(uniqid()).'.'.$extension;
   
   $file_tmp_name=$_FILES['logo']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/logo_album/$logo");
 }
 else
 {  
    if(isset($condition) && isset($retour))
    {
        header("location:ajouteralbum.php?id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:ajouteralbum.php?id_compte_client=$id_compte_client&code=0");
	   exit;
	}
 }
 
$req="select * from ALBUM where TITRE_ALBUM = '$titre' and ARTISTE_ALBUM = '$artiste' ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    header("location:ajouteralbum.php?code=1");
 }
 else
 {
   $req="insert into ALBUM(ID_ALBUM,TITRE_ALBUM,COVER_ALBUM,ARTISTE_ALBUM,DATE_ALBUM,ID_COMPTE_CLIENT) values ('','$titre','$logo','$artiste',NOW(),$id_compte_client)";
   mysqli_query($conn,$req) or die(mysqli_error());

   // reduction des photos
    $Ext = array('jpg','png','jpeg','JPG','PNG','JPEG');
    $Ext1 = array('jpg','jpeg','JPG','JPEG');
    $Ext2 = array('png','PNG');
   
    $extension = pathinfo($logo,PATHINFO_EXTENSION);
   
   if(in_array(strtolower($extension),$Ext))
   {
   
      if(in_array(strtolower($extension),$Ext1))
      {
         $source = imagecreatefromjpeg("Medias/logo_album/".$logo);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         $source = imagecreatefrompng("Medias/logo_album/".$logo);
      }
   
      $destination = imagecreatetruecolor(500, 500);
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
         imagejpeg($source, "Medias/logo_album/".$logo, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         imagepng($source, "Medias/logo_album/".$logo, 10);
      }
   
   }
   
	if(isset($condition) && isset($retour))
    {
        header("location:gestion_compte_musique1.php?id_compte_client=$id_compte_client&condition=$condition&retour=$retour&code=0");
	}
	else
	{
	   header("location:gestion_compte_musique1.php?id_compte_client=$id_compte_client&code=0");
	}
   
 }
mysqli_close($conn);
?>