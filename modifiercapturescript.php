<?php
session_start();
require_once("connexion.php");

$id_capture=htmlspecialchars(trim(addslashes($_GET['id_capture'])));
$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

if(!empty($_FILES['photo']['name']))
{
 $photo=htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));
 
 $extension = pathinfo($photo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
 $photo= 'Pduka_Capture_'.md5(uniqid()).'.'.$extension;
 
 $file_tmp_name=$_FILES['photo']['tmp_name'];
 move_uploaded_file($file_tmp_name,"./Medias/capture/$photo");
 }
 else
 {
    header("location:photo.php?code=1");
	exit;
 }
}

   $req="update CAPTURE set CAPTURE = '$photo' where ID_CAPTURE =  $id_capture ";
   mysqli_query($conn,$req) or die(mysqli_error());
   
   $lien_actuel = 'Medias/capture/'.$photo;
   
   if(! empty($_GET['lien']))
   {
      if(file_exists($_GET['lien']) && is_file($_GET['lien']))
      {
         unlink($_GET['lien']);

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
         $source = imagecreatefromjpeg("Medias/capture/".$photo);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         $source = imagecreatefrompng("Medias/capture/".$photo);
      }
   
      $destination = imagecreatetruecolor(500, 500);
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
         imagejpeg($source, "Medias/capture/".$photo, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         imagepng($source, "Medias/capture/".$photo, 10);
      }
   
   } 
   
   header("location:photo.php?code=0&id_application=$id_application&lien=$lien_actuel&retour=$retour&id_capture=$id_capture");
   
mysqli_close($conn);

?>