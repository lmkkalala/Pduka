<?php
session_start();
require_once("connexion.php");

$id_client = $_SESSION['ID'];

$id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$artiste = htmlspecialchars(trim(addslashes($_POST['artiste'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
{
 $photo = htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));
 
 $extension = pathinfo($photo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
    $photo = 'Pduka_Logo_'.md5(uniqid()).'.'.$extension;
 
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    move_uploaded_file($file_tmp_name,"./Medias/logo_album/$photo");
 
    $req="update MUSIQUE set LOGO_MUSIQUE='$photo' where ID_ALBUM=$id_album";
    mysqli_query($conn,$req) or die(mysqli_error());
 }
 else
 {
    header("location:modifier_album.php?id_album=$id_album&code=1");
	exit;
 }
}
else
{
 $photo=htmlspecialchars(trim(addslashes($_GET['photo'])));
}

   $req="update ALBUM set TITRE_ALBUM='$nom',ARTISTE_ALBUM='$artiste',COVER_ALBUM='$photo' where ID_ALBUM=$id_album";
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
      $source = imagecreatefromjpeg("Medias/logo_album/".$photo);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
      $source = imagecreatefrompng("Medias/logo_album/".$photo);
   }

   $destination = imagecreatetruecolor(500, 500);
   $largeur_source = imagesx($source);
   $hauteur_source = imagesy($source);
   $largeur_destination = imagesx($destination);
   $hauteur_destination = imagesy($destination);
   imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
   
   if(in_array(strtolower($extension),$Ext1))
   {
      imagejpeg($source, "Medias/logo_album/".$photo, 10);
   }
   elseif (in_array(strtolower($extension),$Ext2)) 
   {
      imagepng($source, "Medias/logo_album/".$photo, 10);
   }

}
  
header("location:modifier_album.php?id_compte_client=$id_compte_client&id_album=$id_album&code=0");
   
mysqli_close($conn);
?>