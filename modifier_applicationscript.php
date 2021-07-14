<?php
session_start();
require_once("connexion.php");

$id_client=$_SESSION['ID'];

$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));

$nom=htmlspecialchars(trim(addslashes($_POST['nom'])));
$version=htmlspecialchars(trim(addslashes($_POST['version'])));
$apropos=htmlspecialchars(trim(addslashes($_POST['apropos'])));

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

if(!empty($_POST['categorie']))
{
  $categorie=htmlspecialchars(trim(addslashes($_POST['categorie'])));
}
else
{
  $categorie=htmlspecialchars(trim(addslashes($_GET['categorie'])));
}

if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
{
 $photo=htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));
 
 $extension = pathinfo($photo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
  $photo = 'Pduka_Logo_'.md5(uniqid()).'.'.$extension;
 
 $file_tmp_name=$_FILES['photo']['tmp_name'];
 move_uploaded_file($file_tmp_name,"./Medias/logo/$photo");
 }
 else
 {
    if(isset($condition) && isset($retour))
    {
        header("location:modifier_application.php?id_application=$id_application&id_compte_client=$id_compte_client&code=1&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:modifier_application.php?id_application=$id_application&id_compte_client=$id_compte_client&code=1");
	   exit;
	}
 }
}
else
{
 $photo=htmlspecialchars(trim(addslashes($_GET['photo'])));
}

   $req="update APPLICATION set NOM_APPLICATION='$nom',VERSION_APPLICATION='$version',APROPOS_APPLICATION='$apropos',CATEGORIE_APPLICATION='$categorie',LOGO_APPLICATION='$photo' where ID_APPLICATION=$id_application";
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
	  $source = imagecreatefromjpeg("Medias/logo/".$photo);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
	  $source = imagecreatefrompng("Medias/logo/".$photo);
   }

   $destination = imagecreatetruecolor(500, 500);
   $largeur_source = imagesx($source);
   $hauteur_source = imagesy($source);
   $largeur_destination = imagesx($destination);
   $hauteur_destination = imagesy($destination);
   imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
   
   if(in_array(strtolower($extension),$Ext1))
   {
	  imagejpeg($source, "Medias/logo/".$photo, 10);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
	  imagepng($source, "Medias/logo/".$photo, 10);
   }

} 

if(isset($condition) && isset($retour))
{
	header("location:modifier_application.php?id_application=$id_application&id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	exit;
}
else
{
	header("location:modifier_application.php?id_application=$id_application&id_compte_client=$id_compte_client&code=0");
	exit;
}
   
mysqli_close($conn);
?>