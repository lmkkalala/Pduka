<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client=$_SESSION['ID'];
	
	$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	
	$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
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
		if(($_GET['code'])==0){ ?>
	        <script>			
				swal.fire({
				text: " Bien modifié !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } else if(($_GET['code'])==1){ ?>
	        <script>			
				swal.fire({
				text: " Type de fichier non supporté !",
				icon: "success",
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
	    <button><a href="compte.php?id_compte_client=<?php echo $id_compte_client ?>&condition=<?php echo $condition ?>&id_musique=<?php echo $id_musique ?>&retour=<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php }else{ ?>
	    <button><a href="compte.php?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php } ?>
	<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	
    <div class="profile__container">
        
			<form action="modifier_mon_compte_clientscript.php?id_compte_client=<?php echo $id_compte_client ?>&photo=<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>&lien=Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" method="post" enctype="multipart/form-data">
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
					<a href="photo.php?lien=Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&id_compte_client=<?php echo $id_compte_client ?>&file=<?php echo ($ET['PHOTO_COMPTE_CLIENT']) ?>">
                        <img src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="Profil" title="Profil">
					</a>
                </div>
                <div class="name">
                    <input type="text" name="nom" id="" value="<?php echo $ET['NOM_COMPTE_CLIENT'] ?>" placeholder="<?php echo $ET['NOM_COMPTE_CLIENT'] ?>">
                </div>
            </div>
            <div class="profile__det">
                <div class="view__identity">
                    <p><i class="fa fa-align-left" style="color: blue;"></i>  A propos</p>
                    <div class="mod"><input type="text" name="apropos" id="" value="<?php echo $ET['APROPOS_COMPTE_CLIENT'] ?>" placeholder="<?php echo $ET['APROPOS_COMPTE_CLIENT'] ?>"></div>
                </div>

				<!-- Politique d'activation de la boutton téléchargement ou non
				
				<div class="view__identity">
					<p><i class="fa fa-map-marker" style="color: blue;"></i> Niveau du compte</p>
					<div class="select_info_input">
					<select name="niveau" class="input-field" required>
					    <?php if($ET['NIVEAU_COMPTE_CLIENT'] == 1){ ?>
                        <option value="1" selected >Simple</option>
                        <option value="2" >Premium</option>
						<?php }else{ ?>
                        <option value="1" >Simple</option>
                        <option value="2" selected>Premium</option>
						<?php } ?>
                    </select>
					</div>
				</div>

				-->
				
				<div class="view__identity">
					<p><i class="fa fa-camera" style="color: blue;"></i> Photo</p>
					<div class="select_info_input"><input id="pic1" type="file" class="input" name="photo" value="<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>"></div>
				</div>
                
                
            <p class="ajoute_champ">Cliquer sur l'information pour la modifier</p>
            </div>
            <button type="submit">Modifier</button>
			</form>
        </div>
</body>
</html>