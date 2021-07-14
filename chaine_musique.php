<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$id_client = $_SESSION['ID'];

require_once("client_connecter.php");

 $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
 $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
	
 $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 $ET=mysqli_fetch_assoc($rs);

include('fonction_terminaison.php');
include('fonction_temps_ecoule.php');

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

    <body>
        <div class="retour-musique">
			<button><a href="musique.php?id_musique=<?php echo $id_musique ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	    </div>  
        <div class="app__form">
                <div class="detail_chaine">
                    <img src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="" title="" class="photo_chaine">
                    <h5 class="nom_artiste_single"><?php echo substr(ucfirst(strtolower($ET['NOM_COMPTE_CLIENT'])),0,25);?></h5>
					<?php 
					    $req="select count(*) as nombre from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client ";
                        $rs20=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET20=mysqli_fetch_assoc($rs20);
					?>
                    <h6 class="ajoute_single">
					    <?php echo Term($ET20['nombre'] + 0).' abonné'; if($ET20['nombre'] > 1) echo 's'; ?>
					</h6>
                    <?php if($ET['ID_CATEGORIE_CLIENT'] == 3){ ?>
						<div class="album_ajoute">
							<a href="chaine_musique.php?id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_single" style="color: #d888f0;">Single</h5></a>
							<a href="album_chaine"><a href="albums.php?id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_album">Album</h5></a>
						</div>
                    <?php } ?>
                  
                </div>
                 
				<div class="musique_album_ajoute">
				    <?php 
						$req="select * from MUSIQUE where ID_COMPTE_CLIENT = $id_compte_client and ID_ALBUM = 0 order by ID_MUSIQUE desc";
			            $rs80=mysqli_query($conn,$req) or die(mysqli_error());
						
			            while($ET80=mysqli_fetch_assoc($rs80)){
						
						$id_musique = $ET80['ID_MUSIQUE'];
						
						$file = 'Medias/musique/'.$ET80['MUSIQUE']; 
						if(!empty($file) && file_exists($file) && is_file($file))
						{
							$taille = round((filesize($file)/(1024*1024)),2);
						}
						else
						{
						    $taille = 0;
						}
										
			            $req="select * from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs40=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET40=mysqli_fetch_assoc($rs40);
											
			            $req="select count(*) as nombre from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs50=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET50=mysqli_fetch_assoc($rs50);
										
			            $req="select count(*) as nombre_commentaire from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs60=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET60=mysqli_fetch_assoc($rs60);
										
			            $req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs70=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET70=mysqli_fetch_assoc($rs70);
						
						$req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs8=mysqli_query($conn,$req) or die(mysqli_error());
						$ET8=mysqli_fetch_assoc($rs8);
						
						$req="select * from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
			            $rs170=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET170=mysqli_fetch_assoc($rs170);
										
			            $id_album = $ET80['ID_ALBUM'];

			            $req="select * from ALBUM where ID_ALBUM = $id_album ";
			            $rs30=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET30=mysqli_fetch_assoc($rs30);

			            $dossier = '';
							
			            if($ET80['ID_ALBUM'] == 0)
			            {
			                $dossier = 'logo_musique';
			            }
			            else
			            {
				            $dossier = 'logo_album';
			            }

						$id_compte_client = $ET80['ID_COMPTE_CLIENT'];
			
						$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
						$rs20=mysqli_query($conn,$req) or die(mysqli_error());
						$ET20=mysqli_fetch_assoc($rs20);
					?>
					<div class="musique_box">
							<a href="musique.php?id_musique=<?php echo $ET80['ID_MUSIQUE'] ?>">
							<div class="music_info">
								<div class="music_img">
									<img src="Medias/<?php echo $dossier ?>/<?php echo $ET80['LOGO_MUSIQUE'] ?>" alt="">
								</div>
							<div class="music_name">
                            <p class="titre_droit">
					            <?php if(strlen($ET80['NOM_ARTISTE'])<=14){ ?>
                                    <?php echo ucfirst(strtolower($ET80['NOM_ARTISTE'])).'_'; ?>
					            <?php } else { ?>
						            <?php echo substr(ucfirst(strtolower($ET80['NOM_ARTISTE'])),0,8).'...'.'_'; ?>
					            <?php } ?> 
					        </p>
                            <p class="titre_gauche">
					            <?php if(strlen($ET80['TITRE_MUSIQUE'])<=14){ ?>
                                    <?php echo ucfirst(strtolower($ET80['TITRE_MUSIQUE'])); ?>
					            <?php } else { ?>
						            <?php echo substr(ucfirst(strtolower($ET80['TITRE_MUSIQUE'])),0,9).'...'; ?>
					            <?php } ?> 
					        </p>
                            <br>
                    
                            <p class="music_icon">   
                                <p>
                                    <h4>
								        <?php if($ET80['ID_ALBUM'] == 0){ ?>
                                            <?php if($ET80['PRIX_MUSIQUE'] > 0){ ?>
												<h4>Instrumental</h4>
												<!--<h4><?php echo $ET80['PRIX_MUSIQUE']; ?>  Fc</h4>-->
                                            <?php } else { ?>
                                                <h4>Single</h4>
                                            <?php } ?>
					                    <?php } else { ?>
                                            <?php echo ' '.substr(ucfirst(strtolower($ET30['TITRE_ALBUM'])),0,15) ?>
					                    <?php } ?>
								    </h4>
                                    <h4><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET80['DATE_MUSIQUE']) ?> </h4>
                                </p>
                                <div class="detail_music">
                                    <i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET50['nombre']).'</strong>'; ?></sup></i>
                                    <i class="fa fa-headphones"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET8['NOMBRE_ECOUTER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
						            <i class="fa fa-download"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET40['NOMBRE_TELECHARGEMENT_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                                    <!--
									<i class="fa fa-comment"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET60['nombre_commentaire']).'</strong>'; ?></sup></i>
							        
									<i class="fa fa-share-alt"> <sup class="nombre_aime"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET170['NOMBRE_PARTAGER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
									-->
                                </div>
                            </p>
                                        </a>
                                    </div>
                                </div>
					<?php } ?>

                </div>
       

        </div>
    </body>

</html>