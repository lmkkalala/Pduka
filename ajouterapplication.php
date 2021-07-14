<?php
session_start();
require_once("protection_pages.php");

$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <title>Pduka</title>
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
    <script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
    <script src="sweetalert2.all.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<style>
.app__form form input[type=file] {
    display: block;
}
</style>

<body>
   
	<?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==1){ ?>
	        <script>			
				swal.fire({
				text: " Ce nom existe déjà , veillez saisir un autre nom !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
	<?php } else if(($_GET['code'])==0) { ?>
	        <script>			
				swal.fire({
				text: " Vérifier le type de vos fichiers !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
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

    <div class="app__form">
        <h3><a href="#!"><i class="fa fa-gamepad"></i></a><br>Ajouter une application/game</h3>
        <div class="form__content">
            <form action="ajouterapplicationscript.php" method="post" enctype="multipart/form-data" >
			
			    <?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	                $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		            $retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	            ?>
				    <input type="hidden" name="condition" id="" value="<?php echo $condition ?>">
					<input type="hidden" name="retour" id="" value="<?php echo $retour ?>">
					
				<?php } ?>
			        <input type="hidden" name="id_compte_client" id="" value="<?php echo $id_compte_client ?>">
                <div class="add">
                    <div class="info__add"><i class="fa fa-pencil-alt"></i><input type="text" name="nom" id="" placeholder="Nom application / game" required/></div>
                </div>
				<div class="add">
                    <div class="info__add"><i class="fa fa-pencil-alt"></i><input type="text" name="version" id="" placeholder="Version application / game" required/></div>
                </div>
                <div class="add">
                    <div class="info__add"><i class="fa fa-align-left"></i><Textarea name="apropos"  placeholder="A propos application / game" required></Textarea></div>
                </div>
				<div class="add_musique">
					<div class="info_add_music">
                        <i for="pic1" class="fa fa-camera" style="color:#0077f0;"></i><input type="file" name="logo" id="logo" required>
		            </div>
                </div>
				<div class="add_musique">
					<div class="info_add_music">
                        <i for="pic1" class="fa fa-gamepad" style="color:#0077f0;"></i><input type="file" name="application" id="apk" required/>
		            </div>
                </div>
				<div class="add_application_label">
				    <div class="add_application_input"><label for="apk"><i class="fa fa-choice"></i></label>
				        <input type="radio" name="categorie" value="APK" id="APK" selected /> 
					    <label for="APK">Apk</label>
                        <input type="radio" name="categorie" value="JEU" id="JEU" /> 
						<label for="JEU">Game</label>
					</div>
				</div>
				<p class="ajoute_champ">Veillez remplir tous les champs svp !</p>
                <button type="submit">Ajouter</button>

            </form>
        </div>

    </div>

</body>
</html>