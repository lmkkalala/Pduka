<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client = $_SESSION['ID'];
	
	require_once("client_connecter.php");
	
	$id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
	
	$req="select * from MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET=mysqli_fetch_assoc($rs);
	
	$file = 'Medias/musique/'.$ET['MUSIQUE']; 
	if(!empty($file) && file_exists($file) && is_file($file))
	{
		$taille = round((filesize($file)/(1024*1024)),1);
		$type = pathinfo($file);
	}
	else
	{
		$taille = 0;
	}
							
	$req="select count(*) as nombre_commentaire from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
    $rs6=mysqli_query($conn,$req) or die(mysqli_error());
	$ET6=mysqli_fetch_assoc($rs6);

	$id_compte_client = $ET['ID_COMPTE_CLIENT'];

	$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
    $rs2=mysqli_query($conn,$req) or die(mysqli_error());
	$ET2=mysqli_fetch_assoc($rs2);

	
  
    include('fonction_terminaison.php');
	
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
<body onload="refresh_div();refresh_div1();refresh_div2();refresh_div3();refresh_div4();refresh_div5();">
	<div class="retour-musique">
	    <?php if(isset($_GET['id_compte_client']) && isset($_GET['retour']) || isset($_GET['id_album'])){ 
	        $id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
			$retour = htmlspecialchars(trim(addslashes($_GET['retour'])));
			$id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));
		?>
	        <button><a href="<?php echo $retour ?>?id_musique=<?php echo $id_musique ?>&retour=<?php echo $retour ?>&id_compte_client=<?php echo $id_compte_client ?>&id_album=<?php echo $id_album ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<?php } else { ?>
		    <button><a href="liste_musique.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php } ?>
		<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	</div>
    <div id="id_compte_client" style="display:none;"><?php echo $ET['ID_COMPTE_CLIENT'] ?></div>
	<div id="id_musique" style="display:none;"><?php echo $id_musique ?></div>
	<div class="app_adm">

		<h3><a href="#!"><i class="fa fa-cube"></i></a><br>Statistiques</h3>
		<!-- Politique d'activation de la boutton téléchargement ou non
		<?php if($ET2['NIVEAU_COMPTE_CLIENT'] == 2){ ?>
		<div style="color: black; text-align: center;"><?php echo '<span id="rafraichir_afficher_promotion1"></span>'; ?></div>
		<?php } ?>
		-->
		<div class="utilisateur_adm" style="background-color: #4bb0a6;">
			<h4 class="users_adm"><i class="fa fa-heart"></i> J'aime</h4>
			<div  class="nombre_adm">Nbre J'aime <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_jaime_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<div class="utilisateur_adm" style="background-color: #F16F51;">
			<h4 class="users_adm"><i class="fa fa-headphones"></i> Ecoute</h4>
			<div  class="nombre_adm">Nbre Ecoute: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_ecoute_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<br><br>
		
		<div class="utilisateur_adm" style="background-color: #4bb666;">
			<h4 class="users_adm"><i class="fa fa-download"></i> Téléch.</h4>
			<div  class="nombre_adm">Nbre Téléch.: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_telech_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<div class="utilisateur_adm" style="background-color: #4bb600;">
			<h4 class="users_adm"><i class="fa fa-eye"></i> Vue</h4>
			<div  class="nombre_adm">Nbre Vue.: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_vue_admin"></span>'; ?></span>
					
			</div>
		</div>
		
		<br><br>
	
		<div class="utilisateur_adm" style="background-color: #cfce84;">
			<h4 class="users_adm">Taille</h4>
			<div  class="nombre_adm">Nbre en Mo: <br>
			
				<span class="chiffre_adm"><?php echo $taille; ?></span>
					
			</div>
		</div>
	
		<div class="utilisateur_adm" style="background-color: #cfce00;">
			<h4 class="users_adm">Abonnés</h4>
			<div  class="nombre_adm">Nbre Abonnés: <br>
			
			    <span class="chiffre_adm"><?php echo '<span id="rafraichir_afficher_abonne_admin"></span>'; ?></span>
					
			</div>
		</div>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
    <script src="plugin-frameworks/rafraichir_afficher_promotion.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_jaime_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_ecoute_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_telech_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_vue_admin.js"></script>
	<script src="plugin-frameworks/rafraichir_afficher_abonne_admin.js"></script>
</body>
</html>