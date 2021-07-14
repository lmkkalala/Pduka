<?php
 session_start();
require_once("connexion.php");

$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

$capture=htmlspecialchars(trim(addslashes($_FILES['capture']['name'])));

$extension = pathinfo($capture,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
   $capture= 'Pduka_Capture_'.md5(uniqid()).'.'.$extension;
   
   $file_tmp_name=$_FILES['capture']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/capture/$capture");
 }
 else
 {
    header("location:ajouter_capture_application.php?id_application=$id_application&code=1");
	exit;
 }

   $req="insert into CAPTURE(ID_CAPTURE,CAPTURE,ID_APPLICATION) values ('','$capture',$id_application)";
   mysqli_query($conn,$req) or die(mysqli_error());


   // reduction des photos
    $Ext = array('jpg','png','jpeg','JPG','PNG','JPEG');
    $Ext1 = array('jpg','jpeg','JPG','JPEG');
    $Ext2 = array('png','PNG');
   
    $extension = pathinfo($capture,PATHINFO_EXTENSION);
   
   if(in_array(strtolower($extension),$Ext))
   {
   
      if(in_array(strtolower($extension),$Ext1))
      {
         $source = imagecreatefromjpeg("Medias/capture/".$capture);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         $source = imagecreatefrompng("Medias/capture/".$capture);
      }
   
      $destination = imagecreatetruecolor(500, 500);
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
         imagejpeg($source, "Medias/capture/".$capture, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         imagepng($source, "Medias/capture/".$capture, 10);
      }
   
   }
   
    header("location:ajouter_capture_application.php?id_application=$id_application&code=0");
	 
mysqli_close($conn);
?>