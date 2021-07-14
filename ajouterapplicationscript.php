<?php
 session_start();
require_once("connexion.php");

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$version = htmlspecialchars(trim(addslashes($_POST['version'])));
$apropos = htmlspecialchars(trim(addslashes($_POST['apropos'])));
$categorie = htmlspecialchars(trim(addslashes($_POST['categorie'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));

if(isset($_POST['condition']) && isset($_POST['retour']))
{
   $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
   $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
}

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');
$tabExtapp = array('exe','zip','rar','apk','msi');

$logo=htmlspecialchars(trim(addslashes($_FILES['logo']['name'])));

$extension = pathinfo($logo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
   $logo = 'Pstore_Logo_'.md5(uniqid()).'.'.$extension;
   
   $file_tmp_name=$_FILES['logo']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/logo/$logo");
 }
 else
 {  
    if(isset($condition) && isset($retour))
    {
      header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	   exit;
	}
	else
	{
	   header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=0");
	   exit;
	}
 }

$application = htmlspecialchars(trim(addslashes($_FILES['application']['name'])));

$extension = pathinfo($application,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExtapp))
 {
   $nom_app = str_replace(' ','_',$nom);
   $application = $nom_app.'.'.$extension; 
 
   $file_tmp_name=$_FILES['application']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/application/$application");
 }
 else
 {
    if(isset($condition) && isset($retour))
    {
        header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=0");
	   exit;
	}
 }
 
$req="select * from APPLICATION where NOM_APPLICATION = '$nom' and VERSION_APPLICATION = '$version' ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
	if(isset($condition) && isset($retour))
    {
        header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=1&condition=$condition&retour=$retour");
	}
	else
	{
	   header("location:ajouterapplication.php?id_compte_client=$id_compte_client&code=1");
	}
 }
 else
 {
   $req="insert into APPLICATION(ID_APPLICATION,NOM_APPLICATION,VERSION_APPLICATION,APROPOS_APPLICATION,LOGO_APPLICATION,APPLICATION,CATEGORIE_APPLICATION,NIVEAU_APPLICATION,DATE_APPLICATION,VISIBILITE_APPLICATION,ID_COMPTE_CLIENT) values  ('','$nom','$version','$apropos','$logo','$application','$categorie',1,NOW(),1,$id_compte_client)";
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
        $source = imagecreatefromjpeg("Medias/logo/".$logo);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
        $source = imagecreatefrompng("Medias/logo/".$logo);
      }
   
      $destination = imagecreatetruecolor(500, 500);
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
        imagejpeg($source, "Medias/logo/".$logo, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
        imagepng($source, "Medias/logo/".$logo, 10);
      }
   
   } 
   

     header("location:gestion_compte_developpeur.php?id_compte_client=$id_compte_client");
   
 }
mysqli_close($conn);
?>