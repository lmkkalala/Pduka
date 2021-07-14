<?php
session_start();
require_once("connexion.php");

$id_client=$_SESSION['ID'];

$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$apropos = htmlspecialchars(trim(addslashes($_POST['apropos'])));
$niveau = 1;
//$niveau = htmlspecialchars(trim(addslashes($_POST['niveau'])));

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
{
 $photo=htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));
 
 $extension = pathinfo($photo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
  $photo = 'Pduka_Compte_'.md5(uniqid()).'.'.$extension;
 
 $file_tmp_name=$_FILES['photo']['tmp_name'];
 move_uploaded_file($file_tmp_name,"./Medias/photo_compte_clients/$photo");
 }
 else
 {
    if(isset($condition) && isset($retour))
    {
        header("location:modifier_mon_compte_client.php?id_compte_client=$id_compte_client&code=1&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:modifier_mon_compte_client.php?id_compte_client=$id_compte_client&code=1");
	   exit;
	}
 }
}
else
{
 $photo=htmlspecialchars(trim(addslashes($_GET['photo'])));
}

   $req="update COMPTE_CLIENT set NOM_COMPTE_CLIENT='$nom',APROPOS_COMPTE_CLIENT='$apropos',PHOTO_COMPTE_CLIENT='$photo',NIVEAU_COMPTE_CLIENT=$niveau where ID_COMPTE_CLIENT=$id_compte_client";
   mysqli_query($conn,$req) or die(mysqli_error());

if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
{
   if(!empty($_FILES['photo']['name']))
  {

        if(! empty($_GET['lien']))
		{
		   if(file_exists($_GET['lien']) && is_file($_GET['lien']))
		   {
                unlink($_GET['lien']);

           }
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
	  $source = imagecreatefromjpeg("Medias/photo_compte_clients/".$photo);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
	  $source = imagecreatefrompng("Medias/photo_compte_clients/".$photo);
   }

   $destination = imagecreatetruecolor(500, 500);
   $largeur_source = imagesx($source);
   $hauteur_source = imagesy($source);
   $largeur_destination = imagesx($destination);
   $hauteur_destination = imagesy($destination);
   imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
   
   if(in_array(strtolower($extension),$Ext1))
   {
	  imagejpeg($source, "Medias/photo_compte_clients/".$photo, 10);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
	  imagepng($source, "Medias/photo_compte_clients/".$photo, 10);
   }

} 
  
if(isset($condition) && isset($retour))
{
	header("location:modifier_mon_compte_client.php?id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	exit;
}
else
{
	header("location:modifier_mon_compte_client.php?id_compte_client=$id_compte_client&code=0");
	exit;
}
   
mysqli_close($conn);
?>