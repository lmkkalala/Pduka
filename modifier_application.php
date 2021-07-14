<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client=$_SESSION['ID'];
	
	$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
	$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	
	$req="select * from APPLICATION where ID_APPLICATION = $id_application ";
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
<style>
.identity .photo input {
    display: block;
}
</style>

<body >
    <?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==0){?>
	        <script>			
				swal.fire({
				text: "Bien modifié !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } else if(($_GET['code'])==1){?>
	        <script>			
				swal.fire({
				text: "On n\'accepte pas ce type de fichier ici !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } } ?>
	
	<div class="retour-musique">
	<?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	    $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	?>
	    <button><a href="gestion_compte_developpeur.php?id_compte_client=<?php echo $id_compte_client ?>&condition=<?php echo $condition ?>&id_musique=<?php echo $id_musique ?>&retour=<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php }else{ ?>
	    <button><a href="gestion_compte_developpeur.php?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php } ?>
	<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	
    <div class="profile__container">
        
			<form action="modifier_applicationscript.php?id_application=<?php echo $id_application ?>&photo=<?php echo $ET['LOGO_APPLICATION'] ?>&lien=Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>&categorie=<?php echo $ET['CATEGORIE_APPLICATION'] ?>" method="post" enctype="multipart/form-data">
                <?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	                $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		            $retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	            ?>
				    <input type="hidden" name="condition" id="" value="<?php echo $condition ?>">
					<input type="hidden" name="retour" id="" value="<?php echo $retour ?>">
					
				<?php } ?>
			        <input type="hidden" name="id_compte_client" id="" value="<?php echo $id_compte_client ?>">
                <div class="identity">
                <div class="photo">
					<!--
                    <label  id="fpic"for="pic1" class="label"><i class="fa fa-camera"></i></label>
                    -->
					<a href="photo.php?lien=Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&id_compte_client=<?php echo $id_compte_client ?>&id_application=<?php echo $id_application ?>&file=<?php echo ($ET['LOGO_APPLICATION']) ?>">
                    <img src="Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>" alt="Profil" title="Profil">
					</a>
                </div>
                <div class="name">
                    <input type="text" name="nom" id="" value="<?php echo $ET['NOM_APPLICATION'] ?>" placeholder="<?php echo $ET['NOM_APPLICATION'] ?>">
                </div>
            </div>
            <div class="profile__det">
                <div class="view__identity">
                    <p><i class="fa fa-pencil-alt" style="color: blue;"></i> Version</p>
                    <div class="mod"><input type="text" name="version" id="" value="<?php echo $ET['VERSION_APPLICATION'] ?>" placeholder="<?php echo $ET['VERSION_APPLICATION'] ?>"></div>
                </div>
                <div class="view__identity">
                    <p><i class="fa fa-align-left" style="color: blue;"></i> A propos</p>
                    <div class="mod"><input type="text" name="apropos" id="" value="<?php echo $ET['APROPOS_APPLICATION'] ?>" placeholder="<?php echo $ET['APROPOS_APPLICATION'] ?>"></div>
                </div>
                <div class="view__identity">
                    <div class="mod">
					<?php if($ET['CATEGORIE_APPLICATION'] == 'JEU'){ ?>
				        <input type="radio" name="categorie" value="APK" id="APK" /> 
					    <label for="APK"><strong>Apk</strong></label>
                        <input type="radio" name="categorie" value="JEU" id="JEU" checked /> 
						<label for="JEU"><strong>Game</strong></label>
					<?php } else { ?>
					    <input type="radio" name="categorie" value="APK" id="APK" checked /> 
					    <label for="APK"><strong>Apk</strong></label>
                        <input type="radio" name="categorie" value="JEU" id="JEU" /> 
						<label for="JEU"><strong>Game</strong></label>
					<?php } ?>
				    </div>
				</div>
				<div class="view__identity">
					<p><i class="fa fa-camera" style="color: blue;"></i> Photo</p>
					<div class="select_info_input"><input id="pic1" type="file" class="input" name="photo" value="<?php echo $ET['LOGO_APPLICATION'] ?>"></div>
				</div>
                
            <p class="ajoute_champ">Cliquer sur l'information pour la modifier</p>
            </div>
            <button type="submit">Modifier</button>
			</form>
        </div>
</body>

</html>