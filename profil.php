<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client = $_SESSION['ID'];
	
	require_once("client_connecter.php");

    $req="select * from CLIENT where ID_CLIENT = $id_client ";
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
	<?php }else if(($_GET['code'])==1){ ?>
	        <script>			
				swal.fire({
				text: "Type du fichier photo non supporté !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
	<?php } } ?>
    <div class="retour-musique">
	    <button><a href="plus.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<a href="accueil.php"><i class="color-profil home-return fa fa-home"></i></a>
	</div>
    <div class="profile__container">
		<form action="modifierprofilscript.php?photo=<?php echo $ET['PHOTO_CLIENT'] ?>&lien=Medias/photo_clients/<?php echo $ET['PHOTO_CLIENT'] ?>" method="post" enctype="multipart/form-data">
		<div class="identity">
			<div class="photo">
			    <!--
				<label  id="fpic"for="pic1" class="label"><i class="fa fa-camera"></i></label>
				-->
				<a href="photo.php?lien=Medias/photo_clients/<?php echo $ET['PHOTO_CLIENT'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['PHOTO_CLIENT']) ?>">
					<img src="Medias/photo_clients/<?php echo $ET['PHOTO_CLIENT'] ?>" alt="Profil" title="">
				</a>
			</div>
			<?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
				$condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
				$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
			?>
				<input type="hidden" name="condition" id="" value="<?php echo $condition ?>">
				<input type="hidden" name="retour" id="" value="<?php echo $retour ?>">
				
			<?php } ?>
			<div class="name">
				<input type="text" name="nom" id="" value="<?php echo $ET['NOM_CLIENT'] ?>" placeholder="<?php echo $ET['NOM_CLIENT'] ?>">
			</div>
		</div>
		<div class="profile__det">
			<div class="view__identity">
				<p><i class="fa fa-envelope" style="color: blue;"></i> Adresse mail</p>
				<div class="mod"><input type="email" name="mail" id="" value="<?php echo $ET['MAIL_CLIENT'] ?>" placeholder="<?php echo $ET['MAIL_CLIENT'] ?>"></div>
			</div>
			<div class="view__identity">
				<p><i class="fa fa-map-marker" style="color: blue;"></i> Pays</p>
				<div class="select_info_input">
				<select name="id_region" id="region" class="input-field" required>
				<?php
					$region = '';
					
					$req="select * from REGION order by REGION ";
					$rs=mysqli_query($conn,$req) or die(mysqli_error());
					
					while($ET1=mysqli_fetch_assoc($rs)){
					
					if($ET1['ID_REGION'] == $ET['ID_REGION'])
					{
						$region = 'selected';
					}
					else
					{
						$region = '';
					}
				?>
					<option value=<?php echo ($ET1['ID_REGION']) ?> <?php echo $region ?> ><?php echo ($ET1['REGION']) ?></option>
				<?php } ?>
				</select>
				</div>
			</div>
			<div class="view__identity">
				<p><i class="fa fa-camera" style="color: blue;"></i> Photo</p>
				<div class="select_info_input"><input id="pic1" type="file" class="input" name="photo" value="<?php echo $ET['PHOTO_CLIENT'] ?>"></div>
			</div>
			
		<p class="ajoute_champ">Cliquer sur l'information pour la modifier</p>
		</div>
		<button type="submit">Modifier</button>
		</form>
	</div>
</body>

</html>