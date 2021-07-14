<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$id_client = $_SESSION['ID'];

require_once("client_connecter.php");

 $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
 $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
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
            <button><a href="application.php?id_application=<?php echo $id_application ?>"><i class="fa fa-long-arrow-alt-left"> Retour</i></a></button>
        </div>  
        <div class="corp-chaine">
            <div class="detail_chaine">
                <a href="photo.php?lien=Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&id_compte_client=<?php echo $id_compte_client ?>&id_application=<?php echo $id_application ?>&file=<?php echo ($ET['PHOTO_COMPTE_CLIENT']) ?>">
                    <img class="photo_chaine" src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="">
			    </a>
                <h5 class="nom_chaine"><?php echo ($ET['NOM_COMPTE_CLIENT']) ?></h5>
					<?php 
					    $req="select count(*) as nombre from ABONNER_COMPTE where ID_COMPTE_CLIENT = $id_compte_client ";
                        $rs20=mysqli_query($conn,$req) or die(mysqli_error());
			            $ET20=mysqli_fetch_assoc($rs20);
					?>
                <h6 class="abonne_chaine">
					<?php echo Term($ET20['nombre'] + 0).' Abonne'; if($ET20['nombre'] > 1) echo 's'; ?>
				</h6>
            </div>
            <div class="chaine_couleur">
                <div class="single_album">
                   
				<?php
					    $req="select * from APPLICATION where ID_COMPTE_CLIENT = $id_compte_client order by ID_APPLICATION desc";
                        $rs2=mysqli_query($conn,$req) or die(mysqli_error());
						
					    while($ET2=mysqli_fetch_assoc($rs2)){
												
						    $file = 'Medias/application/'.$ET2['APPLICATION'];
							
	                            if(!empty($file) && file_exists($file) && is_file($file))
	                            {
		                            $taille = round((filesize($file)/(1024*1024)),2);
	                            }
	                            else
	                            {
	                                $taille = 0;
	                            }
						
					?>
                    <div class="musique_box">
                        <a href="application.php?id_application=<?php echo $ET2['ID_APPLICATION'] ?>">
				        <div class="music_info">
                            <div class="music_img">
                                <img src="Medias/logo/<?php echo $ET2['LOGO_APPLICATION'] ?>" alt="">
                            </div>
                            <div class="music_name">
                            <p class="titre_droit">
					            <?php if(strlen($ET2['NOM_APPLICATION'])<=20){ ?>
                                    <?php echo ucfirst(strtolower($ET2['NOM_APPLICATION'])); ?>
					            <?php } else { ?>
						            <?php echo substr(ucfirst(strtolower($ET2['NOM_APPLICATION'])),0,20).'...'; ?>
					            <?php } ?> 
					        </p>
                            <br>
                            <p class="music_icon">   
                                <p>
                                    <h4>
									    <?php echo ucfirst(strtolower($ET2['CATEGORIE_APPLICATION'])); ?>
								    </h4>
                                    <h4>
									    <?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET2['DATE_APPLICATION']) ?>
									</h4>
                                </p>
                            </p>
                        </a>
                        </div>
                    </div>
		            <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>