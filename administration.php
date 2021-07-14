<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
	$nombre_apk = 0;
	$nombre_game = 0;
	$nombre_client_simple = 0;
	$nombre_developpeur = 0;
	$nombre_musicien = 0;
	$nombre_boutiquier = 0;
	$nombre_client_speciaux = 0;
	$nombre_client_admin = 0;
	$nombre_album = 0;
	$nombre_musique = 0;
	$nombre_compte = 0;
	
	$req="select * from MUSIQUE ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {
		$nombre_musique++;
	}
	
	$req="select * from COMPTE_CLIENT ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {
		$nombre_compte++;
	}
	
	$req="select * from ALBUM ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {
		$nombre_album++;
	}
	
	$req="select * from APPLICATION ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {
	    if($ET['CATEGORIE_APPLICATION'] == 'APK')
	    { 
           $nombre_apk++;
        }
		else
		{
		   $nombre_game++;
		}
	}
	
	$req="select * from CLIENT ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
	while($ET=mysqli_fetch_assoc($rs))
    {   
	    if($ET['NIVEAU_CLIENT'] == 1)
	    { 
           $nombre_client_admin++;
        }
		
	    if($ET['ID_CATEGORIE_CLIENT'] == 1)
	    { 
           $nombre_client_simple++;
        }
		else if($ET['ID_CATEGORIE_CLIENT'] == 2)
		{
		   $nombre_developpeur++;
		}
		else if($ET['ID_CATEGORIE_CLIENT'] == 3)
		{
		   $nombre_musicien++;
		}
		else if($ET['ID_CATEGORIE_CLIENT'] == 4)
		{
		   $nombre_boutiquier++;
		}
		else if($ET['ID_CATEGORIE_CLIENT'] == 0)
		{
		   $nombre_client_speciaux++;
		}
	}

	$req="select count(*) as nombre from CLIENT_NON_INSCRIT ";
	$rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET=mysqli_fetch_assoc($rs);

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
<body onload="refresh_div();">
	<div class="retour-musique">
	    <button><a href="plus.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	</div>

	<div class="app_adm">

		<h3><a href="#!"><i class="fa fa-cog"></i></a><br>Administration</h3>

		<div style="color: black; text-align: center;"><?php echo '<span id="rafraichir_afficher_client"></span>'; ?></div>

		<div class="utilisateur_adm" style="background-color: #4bb0a6;">
			<h4 class="users_adm"><a href="liste_application.php">Applications</a></h4>
			<div  class="nombre_adm">Nbre Applic.: <br>
			
			    <span class="chiffre_adm"><?php echo $nombre_game + $nombre_apk; ?></span>
					
			</div>
		</div>
		
		<div class="utilisateur_adm" style="background-color: #F16F51;">
			<h4 class="users_adm"><a href="liste_client.php">Clients</a></h4>
			<div  class="nombre_adm">Clients inscrits: <br>
			
			    <span class="chiffre_adm"><?php echo $nombre_client_simple + $nombre_developpeur + $nombre_musicien + $nombre_boutiquier + $nombre_client_speciaux; ?></span>
					
			</div>
			<div  class="nombre_adm">Clients non inscrits: <br>
			
			    <span class="chiffre_adm"><?php echo Term($ET['nombre']); ?></span>
					
			</div>
		</div>
		
		<br><br>
		
		<div class="utilisateur_adm" style="background-color: #4bb666;">
			<h4 class="users_adm"><a href="liste_album.php">Albums(<?php echo $nombre_album; ?>)</a></h4>
			<div  class="nombre_adm">Nbre <a href="liste_musique.php">Musiques</a>: <br>
			
			    <span class="chiffre_adm"><?php echo $nombre_musique; ?></span>
					
			</div>
		</div>
	
		<div class="utilisateur_adm" style="background-color: #cfce84;">
			<h4 class="users_adm"><a href="liste_compte.php">Comptes</a></h4>
			<div  class="nombre_adm">Nbre Comptes: <br>
			
			    <span class="chiffre_adm"><?php echo $nombre_compte; ?></span>
					
			</div>
		</div>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
    <script src="plugin-frameworks/rafraichir_afficher_client.js"></script>
</body>
</html>