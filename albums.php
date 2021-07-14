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
                 
					<div class="album_ajoute">
						<a href="chaine_musique.php?id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_single">Single</h5></a>
						<a href="albums.php?id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_album" style="color: #d888f0;">Album</h5></a>
					</div>
                  
                </div>
                
				<div class="musique_album_ajoute">
				    <?php
					    $nombre_telechargement = 0;
						$nombre = 0;
						$nombre_commentaire = 0;
						$nombre_vue = 0;
					
					    $req="select * from ALBUM where ID_COMPTE_CLIENT = $id_compte_client order by ID_ALBUM desc";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
						
						while($ET1=mysqli_fetch_assoc($rs1)){ 
					        $somme = 0;
							$id_album = $ET1['ID_ALBUM'];
							
						    $req="select count(*) as nombre from MUSIQUE where ID_ALBUM = $id_album ";
                            $rs4=mysqli_query($conn,$req) or die(mysqli_error());
                            $ET4=mysqli_fetch_assoc($rs4);
 
                            $req="select * from MUSIQUE where ID_ALBUM = $id_album ";
                            $rs3=mysqli_query($conn,$req) or die(mysqli_error());
 
                            while($ET3=mysqli_fetch_assoc($rs3))
                           {
                                $id_musique1 = $ET3['ID_MUSIQUE'];
								
								$file = 'Medias/musique/'.$ET3['MUSIQUE']; 
	                            if(!empty($file) && file_exists($file) && is_file($file))
	                            {
		                            $taille = round((filesize($file)/(1024*1024)),2);
	                            }
	                            else
	                            {
	                                $taille = 0;
	                            }
	
	                            $somme += $taille;
								
								$req="select * from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique1 ";
                                $rs40=mysqli_query($conn,$req) or die(mysqli_error());
                                $ET40=mysqli_fetch_assoc($rs40);
								
								$nombre_telechargement += $ET40['NOMBRE_TELECHARGEMENT_MUSIQUE'];
								
                                $req="select count(*) as nombre from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique1 ";
                                $rs50=mysqli_query($conn,$req) or die(mysqli_error());
                                $ET50=mysqli_fetch_assoc($rs50);
								
								$nombre += $ET50['nombre'];
							
                                $req="select count(*) as nombre_commentaire from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique1 ";
                                $rs60=mysqli_query($conn,$req) or die(mysqli_error());
                                $ET60=mysqli_fetch_assoc($rs60);
								
								$nombre_commentaire += $ET60['nombre_commentaire'];
							
                                $req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique1 ";
                                $rs70=mysqli_query($conn,$req) or die(mysqli_error());
                                $ET70=mysqli_fetch_assoc($rs70);
								
								$nombre_vue += $ET70['NOMBRE_VUES_MUSIQUE'];
			
                            }
					?>
					<div class="musique_box">
						<a href="album.php?id_album=<?php echo ($ET1['ID_ALBUM']) ?>&id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>">
							<div class="music_info">
								<div class="music_img">
									<img src="Medias/logo_album/<?php echo $ET1['COVER_ALBUM'] ?>" alt="">
									<a href="#!"><h4 class="nbr_chanson"><?php echo $ET4['nombre'] ?></h4></a>
								</div>
							<div class="music_name">
								<p class="titre_droit"><?php echo substr(ucfirst(strtolower($ET1['TITRE_ALBUM'])),0,28);?></p>
							    <br><br>
								<p class="music_icon">   
									<p>
										<h4><?php echo $somme.' Mo' ?> | <?php echo duree($ET1['DATE_ALBUM']) ?></h4>
									</p>
								</p>
						</div>
						</a>
					</div>
				<?php } ?>

                </div>
       

        </div>
	</body>

</html>