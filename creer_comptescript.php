<?php
 session_start();
 require_once("connexion.php");
 
$id_client = $_SESSION['ID'];

$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
$apropos = htmlspecialchars(trim(addslashes($_POST['apropos'])));
$id_categorie_client = htmlspecialchars(trim(addslashes($_POST['id_categorie_client'])));
$niveau = 1;
//$niveau = htmlspecialchars(trim(addslashes($_POST['niveau']))); // 1.simple 2.premium

 if(isset($_POST['condition']) && isset($_POST['retour']))
 { 
	$condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
    $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
 }

 $tabExt = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');

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
    if(isset($_POST['condition']) && isset($_POST['retour']))
    { 
	    $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
        $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
		
        header("location:creer_compte.php?condition=$condition&retour=$retour&code=2");
	}
	else
	{
	    header("location:creer_compte.php?code=2");
	}
    exit;
 }

$req="select * from COMPTE_CLIENT where NOM_COMPTE_CLIENT = '$nom' and APROPOS_COMPTE_CLIENT = '$apropos'";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
 {
    if(isset($_POST['condition']) && isset($_POST['retour']))
    { 
	    $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
        $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
		
        header("location:creer_compte.php?condition=$condition&retour=$retour&code=1");
	}
	else
	{
	    header("location:creer_compte.php?code=1");
	}
    exit;
 }
 else
 {
    $req="INSERT INTO COMPTE_CLIENT(NOM_COMPTE_CLIENT,APROPOS_COMPTE_CLIENT,PHOTO_COMPTE_CLIENT,NIVEAU_COMPTE_CLIENT,DATE_COMPTE_CLIENT,ID_CATEGORIE_CLIENT,ID_CLIENT) VALUES ('$nom','$apropos','$photo','$niveau',NOW(),'$id_categorie_client','$id_client')";
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
 
    if(isset($_POST['condition']) && isset($_POST['retour']))
    { 
	    $condition=htmlspecialchars(trim(addslashes($_POST['condition'])));
        $retour=htmlspecialchars(trim(addslashes($_POST['retour'])));
		
        header("location:compte.php?condition=$condition&retour=$retour&code=0");
	}
	else
	{
	    header("location:compte.php?code=0");
	}
  
 }
mysqli_close($conn);
?>