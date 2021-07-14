<?php
session_start();
require_once("connexion.php");

$id_categorie_musique = htmlspecialchars(trim(addslashes($_POST['id_categorie_musique'])));
$titre = htmlspecialchars(trim(addslashes($_POST['titre'])));
$style = htmlspecialchars(trim(addslashes($_POST['style'])));
$id_album = htmlspecialchars(trim(addslashes($_POST['id_album'])));
$id_compte_client = htmlspecialchars(trim(addslashes($_POST['id_compte_client'])));
$prix = 0;


$req="select * from ALBUM where ID_ALBUM = $id_album ";
$rs1=mysqli_query($conn,$req) or die(mysqli_error());
$ET1=mysqli_fetch_assoc($rs1);

$photo_album = $ET1['COVER_ALBUM'];

$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());
$ET=mysqli_fetch_assoc($rs);

$artiste = $ET['NOM_COMPTE_CLIENT'];

//$tabExtapp = array('mp3','mp4','wav','OGG','ogg','MP3','MP4','WAV','mjpeg','MJPEG','m4a','M4A','WMA','wma','aac','AAC','aa','AA','acd','ACD','aif','AIF','aiff','AIFF','all','ALL','amr','AMR','ape','APE','ase','ASE','asf','ASF','atrac','ATRAC','au','AU','aup','AUP','caf','CAF','cda','CDA','cdr','CDR','flac','FLAC','gp','GP','gp4','GP4','gp5','GP5','m3u','M3U','m4b','M4B','m4p','M4R','mp1','MP1','mp2','MP2');
$tabExtapp = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG','html','HTML','php','PHP','js','JS','pdf','PDF','doc','DOC','htm','HTM');
 
$musique=htmlspecialchars(trim(addslashes($_FILES['musique']['name'])));

$extension = pathinfo($musique,PATHINFO_EXTENSION);
 
 if(in_array(strtolower($extension),$tabExtapp))
 {
   $titre_musique = str_replace(' ','_',$titre);
   $musique = $titre_musique.'.'.$extension;
   
   $file_tmp_name=$_FILES['musique']['tmp_name'];
   move_uploaded_file($file_tmp_name,"./Medias/musique/$musique");
 }
 else
 {
	header("location:ajoutermusique_album.php?id_compte_client=$id_compte_client&id_album=$id_album&code=0");
	exit;
 }
 
$req="select * from MUSIQUE where TITRE_MUSIQUE = '$titre' and ID_CATEGORIE_MUSIQUE = $id_categorie_musique ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
   header("location:ajoutermusique_album.php?id_compte_client=$id_compte_client&id_album=$id_album&code=1");
 }
 else
 {
   $req="insert into MUSIQUE(ID_MUSIQUE,TITRE_MUSIQUE,LOGO_MUSIQUE,MUSIQUE,DATE_MUSIQUE,NOM_ARTISTE,PRIX_MUSIQUE,ID_CATEGORIE_MUSIQUE,ID_ALBUM,ID_COMPTE_CLIENT) values ('','$titre','$photo_album','$musique',NOW(),'$artiste',$prix,$id_categorie_musique,$id_album,$id_compte_client)";
   mysqli_query($conn,$req) or die(mysqli_error());

   $req="select * from MUSIQUE order by ID_MUSIQUE desc ";
   $rs2=mysqli_query($conn,$req) or die(mysqli_error());
   $ET2=mysqli_fetch_assoc($rs2);

   $id_musique = $ET2['ID_MUSIQUE'];

   $req="insert into ACTIVER_TELECHARGEMENT(ID_ACTIVER_TELECHARGEMENT,ACTIVER_TELECHARGEMENT,ID_MUSIQUE) values ('',1,$id_musique)";
   mysqli_query($conn,$req) or die(mysqli_error());
   

   header("location:mon_album.php?id_compte_client=$id_compte_client&id_album=$id_album&code=0");
   
 }
mysqli_close($conn);
?>