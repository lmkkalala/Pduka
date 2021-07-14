<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client=$_SESSION['ID'];
	
	require_once("client_connecter.php");
	
	$contenu_choquant = 0;
	$contenu_non_approprie = 0;

	$id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
	$req="select * from APPLICATION where ID_APPLICATION = $id_application ";
    $rs2=mysqli_query($conn,$req) or die(mysqli_error());
    $ET2=mysqli_fetch_assoc($rs2);
	
	$file = 'Medias/application/'.$ET2['APPLICATION']; 
    if(!empty($file) && file_exists($file) && is_file($file))
	{
		$taille = round((filesize($file)/(1024*1024)),1);
	}
	else
	{
		$taille = 0;
	}
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pduka</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
</head>
<body onload="refresh_div();refresh_div1();refresh_div2();">
	<div class="retour-musique">
	    <?php if(isset($_GET['id_compte_client'])){ 
	        $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
		?>
	        <button><a href="gestion_compte_developpeur.php?id_application=<?php echo $id_application ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
			<?php } else { ?>
		    <button><a href="liste_application.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
		<?php } ?>
	</div>

    <div id="id_application" style="display:none;"><?php echo $id_application ?></div>

	<div class="app_adm">

		<h3><a href="#!"><i class="fa fa-cube"></i></a><br>Statistiques</h3>
		<div class="utilisateur_adm" style="background-color: #4bb0a6;">
			<h4 class="users_adm"><i class="fa fa-exclamation-triangle"></i> Signaler</h4>
			<div  class="nombre_adm">Nbre Signalers <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_signaler_application_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<div class="utilisateur_adm" style="background-color: #F16F51;">
			<h4 class="users_adm"><i class="fa fa-eye"></i> Vues</h4>
			<div  class="nombre_adm">Nbre Vues: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_vue_application_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<br><br>
		
		<div class="utilisateur_adm" style="background-color: #4bb666;">
			<h4 class="users_adm"><i class="fa fa-download"></i> Téléch.</h4>
			<div  class="nombre_adm">Nbre Téléch.: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_telech_application_admin"></span>'; ?></span>
					
			</div>
		</div>
	
		<div class="utilisateur_adm" style="background-color: #cfce84;">
			<h4 class="users_adm">Taille</h4>
			<div  class="nombre_adm">Nbre en Mo: <br>
			
			    <span class="chiffre_adm"><?php echo $taille; ?></span>
					
			</div>
		</div>
		<br>
		<div class="mise_à_jour" style="text-align: center;">
			<?php if(isset($_GET['id_compte_client'])){ ?>
					<h4><a href="#!">Cliquer ici pour la mise à jour</a></h4>
			<?php } ?>
		</div>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
	<script src="plugin-frameworks/rafraichir_afficher_signaler_application_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_vue_application_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_telech_application_admin.js"></script>
</body>
</html>