<?php    
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");

    $id_client=$_SESSION['ID'];

    $lien=htmlspecialchars(trim(addslashes($_GET['lien'])));
	$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
        <title>Pduka</title>
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
</head>


<body>
    <div class="retour-musique">
	    <?php if(isset($_GET['id_album']) && isset($_GET['id_musique']) && isset($_GET['id_compte_client'])){
	       $id_album=htmlspecialchars(trim(addslashes($_GET['id_album'])));
		   $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		   $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
		?> 
            <button><a href="<?php echo $retour ?>?id_album=<?php echo $id_album ?>&id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_album']) && isset($_GET['id_compte_client'])){ 
		   $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		   $id_album=htmlspecialchars(trim(addslashes($_GET['id_album'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_musique']) && isset($_GET['id_compte_client'])){ 
		   $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		   $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_compte_client']) && isset($_GET['id_application'])){ 
		   $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		   $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_application=<?php echo $id_application ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_compte_client'])){ 
		   $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_musique'])){ 
		   $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_musique=<?php echo $id_musique ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }else if(isset($_GET['id_application'])){ 
		   $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
		?>
		    <button><a href="<?php echo $retour ?>?id_application=<?php echo $id_application ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php } else {?>
		    <button><a href="<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php } ?>
		<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
    
    <div class="form_content">
	
        <div class="form__content">
            <img src="<?php echo ($lien)?>" class="voirphoto"> 
        </div>
		<?php 
		    if(isset($_GET['id_application']))
			{ 
		     $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
	         $req="select * from APPLICATION where ID_APPLICATION = $id_application ";
             $rs=mysqli_query($conn,$req) or die(mysqli_error());
             $ET=mysqli_fetch_assoc($rs);
			 
			 $id_compte_client = $ET['ID_COMPTE_CLIENT'];
			 $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
             $rs5=mysqli_query($conn,$req) or die(mysqli_error());
			 $ET5=mysqli_fetch_assoc($rs5);

     		 $id_client_compte_client = $ET5['ID_CLIENT'];
		    }
			if(isset($_GET['id_musique']))
			{ 
		     $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
	         $req="select * from MUSIQUE where ID_MUSIQUE = $id_musique ";
             $rs=mysqli_query($conn,$req) or die(mysqli_error());
             $ET=mysqli_fetch_assoc($rs);
			 
			 $id_compte_client = $ET['ID_COMPTE_CLIENT'];
			 $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
             $rs5=mysqli_query($conn,$req) or die(mysqli_error());
			 $ET5=mysqli_fetch_assoc($rs5);

     		 $id_client_compte_client = $ET5['ID_CLIENT'];
		    }
		
		?>
		
		<?php if(isset($_GET['id_capture']) && $id_client_compte_client == $id_client){	?>
		
		<form action="modifiercapturescript.php?id_capture=<?php echo $_GET['id_capture'] ?>&lien=<?php echo $lien ?>&id_application=<?php echo $id_application ?>&retour=<?php echo $retour ?>" method="post" enctype="multipart/form-data">
		
		    <label for="pic1" class="label_photo">
			
               <input id="pic1" type="file" class="input" name="photo" required/>
			
		       <input type="submit" class="input" value="Remplacer">
			
			</label>
			
	    </form>
		
		<?php } ?>

    </div>

</body>
</html>