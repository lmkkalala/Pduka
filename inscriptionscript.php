<?php
 session_start();
 require_once("connexion.php");

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$mail = htmlspecialchars(trim(addslashes($_POST['mail'])));
$pass = htmlspecialchars(trim(addslashes($_POST['pass'])));
$id_region = htmlspecialchars(trim(addslashes($_POST['id_region'])));
$id_categorie = 1;

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');


 if(!empty($_FILES['photo']['name']) or $_FILES['photo']['name'] != null)
 {
 
  $photo = htmlspecialchars(trim(addslashes($_FILES['photo']['name'])));

  $extension = pathinfo($photo,PATHINFO_EXTENSION);
  
 if(in_array(strtolower($extension),$tabExt))
 {
   $photo = 'Pduka_Profil_'.md5(uniqid()).'.'.$extension;
 
   $file_tmp_name=$_FILES['photo']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/photo_clients/$photo");
 }
 else
 {
   header("location:index1.php?code=3");
	exit;
 }
 }
 else
 {
   $photo = 'profil.png'; 
 }
 
$pass = md5($pass);

$niveau_client = 2;

$req="select * from CLIENT where MAIL_CLIENT = '$mail'";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
{
   header("location:index1.php?code=4&deconnexion=0");
}
else
{
   $req="INSERT INTO CLIENT(NOM_CLIENT,MAIL_CLIENT,PASSE_CLIENT,PHOTO_CLIENT,NIVEAU_CLIENT,ID_REGION,ID_CATEGORIE_CLIENT) VALUES ('$nom','$mail','$pass','$photo',$niveau_client,$id_region,$id_categorie)";
   mysqli_query($conn,$req) or die(mysqli_error());

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
    
   $req="select * from CLIENT where MAIL_CLIENT = '$mail'";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());

   if($u=mysqli_fetch_assoc($rs))
   {
   
      session_start();

      $_SESSION['NIV'] = $u['NIVEAU_CLIENT'];
      $_SESSION['NOM'] = $u['NOM_CLIENT'];
      $_SESSION['ID_REGION'] = $u['ID_REGION'];
      $_SESSION['ID'] = $u['ID_CLIENT'];

      setcookie('mail', $mail , time() + 365*24*3600, null, null, false, true);
      setcookie('pass', $pass , time() + 365*24*3600, null, null, false, true);
   
      header("location:accueil.php?code=5");
   
   }
   

}
 
mysqli_close($conn);

?>