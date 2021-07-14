<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client=$_SESSION['ID'];
	
    $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	
	$id_album=htmlspecialchars(trim(addslashes($_GET['id_album'])));
	
	$req="select * from ALBUM where ID_ALBUM = $id_album ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET=mysqli_fetch_assoc($rs);
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pduka</title>
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="sweetalert2.all.js"></script>
	<script src="sweetalert2.js"></script>
	<script src="sweetalert2.min.js"></script>
	<script src="sweetalert2.all.min.js"></script>
</head>

<body >
    <?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==0){?>
	        <script>			
				swal.fire({
				text: " Bien modifié !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } else if(($_GET['code'])==1){?>
	        <script>			
				swal.fire({
				text: " Type de fichier non supporté !",
				icon: "error",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } } ?>
	
    <div class="retour-musique">
        <button><a href="gestion_compte_musique1.php?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
    <div class="profile__container">
			
			<form action="modifier_albumscript.php?id_album=<?php echo $id_album ?>&photo=<?php echo $ET['COVER_ALBUM'] ?>&lien=Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>" method="post" enctype="multipart/form-data">
            <div class="identity">
                <div class="photo">
                    <!--
                    <label  id="fpic"for="pic1" class="label"><i class="fa fa-camera"></i></label>
                    -->
					<a href="photo.php?lien=Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>&id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['COVER_ALBUM']) ?>">
                    <img src="Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>" alt="Profil" title="Profil">
					</a>
                </div>
                <div class="name">
                    <input type="text" name="nom" id="" value="<?php echo $ET['TITRE_ALBUM'] ?>" placeholder="<?php echo $ET['TITRE_ALBUM'] ?>">
                </div>
            </div>
			<input type="hidden" name="id_compte_client" id="" value="<?php echo $id_compte_client ?>">
            <div class="profile__det">
                <div class="view__identity">
                    <p><i class="fa fa-user" style="color: blue;"></i> Artiste</p>
                    <div class="mod"><input type="text" name="artiste" id="" value="<?php echo $ET['ARTISTE_ALBUM'] ?>" placeholder="<?php echo $ET['ARTISTE_ALBUM'] ?>"></div>
                </div>
            </div>
            <div class="profile__det">
            <div class="view__identity">
                <p><i class="fa fa-camera" style="color: blue;"></i> Photo</p>
                <div class="select_info_input"><input id="pic1" type="file" class="input" name="photo" value="<?php echo $ET['COVER_ALBUM'] ?>"></div>
            </div>
            </div>
                
            <p class="ajoute_champ">Cliquer sur l'information pour la modifier</p>
            <button type="submit">Modifier</button>
			</form>
        </div>
</body>
</html>