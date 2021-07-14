<?php
session_start();
require_once("connexion.php");

$id_client=$_SESSION['ID'];

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$mail = htmlspecialchars(trim(addslashes($_POST['mail'])));
$id_region = htmlspecialchars(trim(addslashes($_POST['id_region'])));

if(isset($_POST['condition']) && isset($_POST['retour']))
{
   $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
   $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
}

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
{
 $photo=htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));
 
 $extension = pathinfo($photo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
  $photo = 'Pduka_Profil_'.md5(uniqid()).'.'.$extension;
 
 $file_tmp_name=$_FILES['photo']['tmp_name'];
 move_uploaded_file($file_tmp_name,"./Medias/photo_clients/$photo");
 }
 else
 {  
    if(isset($condition) && isset($retour))
    {
        header("location:profil.php?code=1&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:profil.php?code=1");
	   exit;
	}
 }
}
else
{
 $photo=htmlspecialchars(trim(addslashes($_GET['photo'])));
}

   $req="update CLIENT set NOM_CLIENT='$nom',MAIL_CLIENT='$mail',ID_REGION=$id_region,PHOTO_CLIENT='$photo' where ID_CLIENT=$id_client";
   mysqli_query($conn,$req) or die(mysqli_error());

   if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
   {
      if(! empty($_GET['lien']) && $_GET['lien'] != 'Medias/photo_clients/profil.png')
		{
		   if(file_exists($_GET['lien']) && is_file($_GET['lien']))
		   {
                 unlink($_GET['lien']);

         }
      }
   }

   // reduction des photos
    $Ext = array('jpg','png','jpeg','JPG','PNG','JPEG');
    $Ext1 = array('jpg','jpeg','JPG','JPEG');
    $Ext2 = array('png','PNG');

    $extension = pathinfo($photo,PATHINFO_EXTENSION);

   if(in_array(strtolower($extension),$Ext))
   {

      if(in_array(strtolower($extension),$Ext1))
      {
         $source = imagecreatefromjpeg("Medias/photo_clients/".$photo);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         $source = imagecreatefrompng("Medias/photo_clients/".$photo);
      }

      $destination = imagecreatetruecolor(500, 500);
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
         imagejpeg($source, "Medias/photo_clients/".$photo, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         imagepng($source, "Medias/photo_clients/".$photo, 10);
      }

   }

	
   if(isset($condition) && isset($retour))
   {
      header("location:profil.php?code=0&condition=$condition&retour=$retour");
	}
	else
	{
	   header("location:profil.php?code=0");
	}
   
mysqli_close($conn);
?>