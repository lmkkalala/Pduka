<?php
session_start();
require_once("protection_pages.php");
require_once("connexion.php");

$id_client=$_SESSION['ID'];

require_once("client_connecter.php");
	
$mc="";
if(isset($_GET['categorie']))
{
    $mc=htmlspecialchars(trim(addslashes($_GET['categorie'])));
}
	
 $req="select * from MUSIQUE where TITRE_MUSIQUE like '%$mc%' or NOM_ARTISTE like '%$mc%' order by ID_MUSIQUE desc limit 0,50";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 
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
    <style>
        @media (max-width: 429px)
        {
            .music_info {
                margin: 5px 5px;
                width: 96.5%;
            }
        }
    </style>

    <body>
        <div class="main__container">
            <div class="app__Container">
			    <form>
                <div class="top__bar">
                    <img src="Medias/photo_site/icone.png " id="logo">
					
                    <div class="search">
                        <input type="text" name="categorie" id="" placeholder="Rechercher ici...">
                        <button type="submit" ><i class="fa fa-search"></i></button>
                    </div>
					
                </div>
				</form>
                <div class="menu__content">
                    <ul>
                        <li><a href="accueil.php"><i class="fa fa-home"></i></a></li>
                        <hr>
						
						<li><a href="accueil_application.php"><i class="fa fa-gamepad"></i></a></li>
                        <hr>
                        
                        <li><a href="accueil_musique.php"><i class="fa fa-music" style="color: #4a97e6;"></i></a></li>
                        <hr>
						
                        <li><a href="plus.php?retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&condition=2"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
                
            <div class="app_musique">
            <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
			<?php
     		    $file = 'Medias/musique/'.$ET['MUSIQUE']; 
				if(!empty($file) && file_exists($file) && is_file($file))
				{
				    $taille = round((filesize($file)/(1024*1024)),2);
					$type = pathinfo($file);
				}
				else
				{
					$taille = 0;
				}
							
				$id_musique = $ET['ID_MUSIQUE'];
							
				$req="select * from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs4=mysqli_query($conn,$req) or die(mysqli_error());
                $ET4=mysqli_fetch_assoc($rs4);
								
				$req="select count(*) as nombre from AIMER_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs5=mysqli_query($conn,$req) or die(mysqli_error());
				$ET5=mysqli_fetch_assoc($rs5);
							
				$req="select count(*) as nombre_commentaire from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs6=mysqli_query($conn,$req) or die(mysqli_error());
				$ET6=mysqli_fetch_assoc($rs6);
							
				$req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs7=mysqli_query($conn,$req) or die(mysqli_error());
				$ET7=mysqli_fetch_assoc($rs7);
				
				$req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs8=mysqli_query($conn,$req) or die(mysqli_error());
				$ET8=mysqli_fetch_assoc($rs8);
				
				$req="select * from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
                $rs170=mysqli_query($conn,$req) or die(mysqli_error());
                $ET170=mysqli_fetch_assoc($rs170);
							
				$id_album = $ET['ID_ALBUM'];
				
				$req="select * from ALBUM where ID_ALBUM = $id_album ";
                $rs3=mysqli_query($conn,$req) or die(mysqli_error());
	            $ET3=mysqli_fetch_assoc($rs3);
                $dossier = '';
				
                if($ET['ID_ALBUM'] == 0)
				{
                    $dossier = 'logo_musique';
                }
                else
                {
				    $dossier = 'logo_album';
				}

                $id_compte_client = $ET['ID_COMPTE_CLIENT'];

                $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
                $rs20=mysqli_query($conn,$req) or die(mysqli_error());
                $ET20=mysqli_fetch_assoc($rs20);				
			?>
			    <a href="musique.php?id_musique=<?php echo $ET['ID_MUSIQUE'] ?>&id_compte_client=<?php echo $ET['ID_COMPTE_CLIENT'] ?>">
                <div class="musique_box">
                    
					<div class="music_info">
                    <div class="music_img">
					    <img src="Medias/<?php echo $dossier ?>/<?php echo $ET['LOGO_MUSIQUE'] ?>" alt="">
                    </div>
                    <div class="music_name">
					<a href="musique.php?id_musique=<?php echo $ET['ID_MUSIQUE'] ?>&id_compte_client=<?php echo $ET['ID_COMPTE_CLIENT'] ?>">
					<p class="titre_droit">
					<?php if(strlen($ET['NOM_ARTISTE'])<=10){ ?>
                        <?php echo ucfirst(strtolower($ET['NOM_ARTISTE'])).'_'; ?>
					<?php } else { ?>
						<?php echo substr(ucfirst(strtolower($ET['NOM_ARTISTE'])),0,10).'...'.'_'; ?>
					<?php } ?>
					</p>
					<p class="titre_gauche">
					<?php if(strlen($ET['TITRE_MUSIQUE'])<=10){ ?>
                        <?php echo ucfirst(strtolower($ET['TITRE_MUSIQUE'])); ?>
					<?php } else { ?>
						<?php echo substr(ucfirst(strtolower($ET['TITRE_MUSIQUE'])),0,12).'...'; ?>
					<?php } ?>
					</p>
					</a>
                    <br>
                    
                    <p class="music_icon">   
                            <p> 
							    <?php if($ET['ID_ALBUM'] == 0){ ?>
                                    <?php if($ET['PRIX_MUSIQUE'] > 0){ ?>
					                <h4>Instrumental</h4>
					                <!--<h4><?php echo $ET['PRIX_MUSIQUE']; ?>  Fc</h4>-->
                                    <?php } else { ?>
					                <h4>Single</h4>
                                    <?php } ?>
					            <?php } else { ?>
                                    <h4><?php echo substr(ucfirst(strtolower($ET3['TITRE_ALBUM'])),0,20) ?></h4>
					            <?php } ?>
                                <h4><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET['DATE_MUSIQUE']) ?></h4>
                            </p>
                        <div class="detail_music">
                            <i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET5['nombre']).'</strong>'; ?></sup></i>
							<i class="fa fa-headphones"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET8['NOMBRE_ECOUTER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                            <i class="fa fa-download"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET4['NOMBRE_TELECHARGEMENT_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                            <!--
                            <i class="fa fa-comment"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET6['nombre_commentaire']).'</strong>'; ?></sup></i>
                            
                            <i class="fa fa-share-alt"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET170['NOMBRE_PARTAGER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                            -->
						</div>
                    </p>
                
             </div>
            </div>
			</a>
			<?php } ?>

    </body>
</html>