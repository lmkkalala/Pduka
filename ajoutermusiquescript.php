<?php
session_start();
require_once("connexion.php");

$titre = htmlspecialchars(trim(addslashes($_POST['titre'])));
$id_categorie_musique = htmlspecialchars(trim(addslashes($_POST['id_categorie_musique'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));
$artiste = htmlspecialchars(trim(addslashes($_POST['artiste'])));
$prix = 0;

if(isset($_POST['prix']))
{
   $prix = htmlspecialchars(trim(addslashes($_POST['prix'])));
}


$id_album = 0; // car single

if(isset($_POST['condition']) && isset($_POST['retour']))
{
   $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
   $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
}

$tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');
//$tabExtapp = array('mp3','mp4','wav','OGG','ogg','MP3','MP4','WAV','mjpeg','MJPEG','m4a','M4A','WMA','wma','aac','AAC','aa','AA','acd','ACD','aif','AIF','aiff','AIFF','all','ALL','amr','AMR','ape','APE','ase','ASE','asf','ASF','atrac','ATRAC','au','AU','aup','AUP','caf','CAF','cda','CDA','cdr','CDR','flac','FLAC','gp','GP','gp4','GP4','gp5','GP5','m3u','M3U','m4b','M4B','m4p','M4R','mp1','MP1','mp2','MP2');
$tabExtapp = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG','html','HTML','php','PHP','js','JS','pdf','PDF','doc','DOC','htm','HTM');

$logo=htmlspecialchars(trim(addslashes($_FILES['logo']['name'])));

$extension = pathinfo($logo,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExt))
 {
   $logo = 'Pduka_Cover_'.md5(uniqid()).'.'.$extension;
   
   $file_tmp_name=$_FILES['logo']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/logo_musique/$logo");
 }
 else
 {  
    if(isset($condition) && isset($retour))
    {
        header("location:ajoutermusique.php?id_compte_client=$id_compte_client&code=0&condition=$condition&retour=$retour");
	    exit;
	}
	else
	{
	   header("location:ajoutermusique.php?id_compte_client=$id_compte_client&code=0");
	   exit;
	}
 }
 
$musique = htmlspecialchars(trim(addslashes($_FILES['musique']['name'])));

$extension = pathinfo($musique,PATHINFO_EXTENSION);
 
 if(!in_array(strtolower($extension),$tabExtapp))
 {
   $titre_musique = str_replace(' ','_',$titre);
   $musique = $titre_musique.'.'.$extension;
   
   $file_tmp_name=$_FILES['musique']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/musique/$musique");
 }
 else
 {  
    
   if(isset($condition) && isset($retour))
   {
      header("location:ajoutermusique.php?id_compte_client=$id_compte_client&code=2&condition=$condition&retour=$retour");
      exit;
	}
	else
	{
	   header("location:ajoutermusique.php?id_compte_client=$id_compte_client&code=2");
	   exit;
	}
 }
 
$req="select * from MUSIQUE where TITRE_MUSIQUE = '$titre' and NOM_ARTISTE = '$artiste' ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
   header("location:ajoutermusique.php?id_compte_client=$id_compte_client&code=1");
 }
 else
 {
   $req="INSERT INTO MUSIQUE(TITRE_MUSIQUE,LOGO_MUSIQUE,MUSIQUE,DATE_MUSIQUE,NOM_ARTISTE,PRIX_MUSIQUE,ID_CATEGORIE_MUSIQUE,ID_ALBUM,ID_COMPTE_CLIENT) VALUES ('$titre','$logo','$musique',NOW(),'$artiste',$prix,$id_categorie_musique,$id_album,$id_compte_client)";
   mysqli_query($conn,$req) or die(mysqli_error());

   $req="select * from MUSIQUE order by ID_MUSIQUE desc ";
   $rs=mysqli_query($conn,$req) or die(mysqli_error());
   $ET=mysqli_fetch_assoc($rs);

   $id_musique = $ET['ID_MUSIQUE'];

   $req="INSERT INTO ACTIVER_TELECHARGEMENT(ACTIVER_TELECHARGEMENT,ID_MUSIQUE) values (1,$id_musique)";
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
         $source = imagecreatefromjpeg("Medias/logo_musique/".$logo);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         $source = imagecreatefrompng("Medias/logo_musique/".$logo);
      }
   
      
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);

      $destination = imagecreatetruecolor(500, 500);

      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
      
      if(in_array(strtolower($extension),$Ext1))
      {
         imagejpeg($source, "Medias/logo_musique/".$logo, 10);
      }
      elseif (in_array(strtolower($extension),$Ext2)) 
      {
         imagepng($source, "Medias/logo_musique/".$logo, 10);
      }
   
   }

   header("location:gestion_compte_musicien.php?id_compte_client=$id_compte_client&code=0");
   
 }
mysqli_close($conn);
?>