<?php
session_start();
require_once("protection_pages.php");
require_once("connexion.php");

$id_client = $_SESSION['ID'];

$mc = "";
if(isset($_GET['categorie']))
{
    $mc = htmlspecialchars(trim(addslashes($_GET['categorie'])));
}

require_once("client_connecter.php");
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
        <link rel="stylesheet" href="plugin-frameworks/owl.carousel.min.css">
        <link rel="stylesheet" href="plugin-frameworks/owl.theme.default.min.css">
        <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
		<link rel="shortcut icon" href="Medias/photo_site/icone.png">
    </head>

    <body>
        <?php include('message_de_confirmation.php'); ?>
        <div class="main__container">
            <div class="app__Container">
			    <form>
                    <div class="top__bar">
                        <img src="Medias/photo_site/icone.png" id="logo">
                        
                        <div class="search">
                            <input type="text" name="categorie" id="" placeholder="Rechercher ici...">
                            <button type="submit" ><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
				</form>
                <div class="menu__content">
                    <ul>
                        <li><a href="accueil.php"><i class="fa fa-home" style="color: #4a97e6;"></i></a></li>
                        <hr>
						
						<li><a href="accueil_application.php"><i class="fa fa-gamepad"></i></a></li>
                        <hr>
                        
                        <li><a href="accueil_musique.php"><i class="fa fa-music"></i></a></li>
                        <hr>
						
                        <li><a href="plus.php?retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&condition=2"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
                <div class="app__content">
                    
                <h3 class="application">Game</h3> 
                         
                <div class="story owl-carousel owl-theme">
				<?php 
					$req="select * from APPLICATION where NOM_APPLICATION like '%$mc%' and CATEGORIE_APPLICATION = 'JEU' order by ID_APPLICATION desc limit 0,10";
                    $rs=mysqli_query($conn,$req) or die(mysqli_error());
					while($ET=mysqli_fetch_assoc($rs)){
				
				    $file = 'Medias/application/'.$ET['APPLICATION']; 
						    if(!empty($file) && file_exists($file) && is_file($file))
							{
						        $taille = round((filesize($file)/(1024*1024)),2);
							}
							else
							{
							    $taille = 0;
							}
				?>
                    <div class="app_logo_acceuil"> 
                        <a href="application.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>"><img src="Medias/logo/<?php echo ($ET['LOGO_APPLICATION']); ?>" alt="">
                        <div class="detail_application_acceuil">
                            <?php if(strlen($ET['NOM_APPLICATION'])<=12){ ?>
                            <h5><?php echo ucfirst(strtolower($ET['NOM_APPLICATION'])); ?></h5>
                            <?php } else { ?>
                            <h5><?php echo substr(ucfirst(strtolower($ET['NOM_APPLICATION'])),0,13).'...'; ?></h5>
                            <?php } ?>
                            <h6><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?></h6>
                        </div>
                        </a>
                    </div>
				<?php } ?>
                </div>
                <h3 class="application">  Musique </h3>   
                <div class="musique owl-carousel owl-theme">
                <?php 
					$req="select * from MUSIQUE where TITRE_MUSIQUE like '%$mc%' or NOM_ARTISTE like '%$mc%' order by ID_MUSIQUE desc limit 0,10";
                    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
				    while($ET1=mysqli_fetch_assoc($rs1)){
						
				    $file = 'Medias/musique/'.$ET1['MUSIQUE']; 

                    if(!empty($file) && file_exists($file) && is_file($file))
                    {
                        $taille = round((filesize($file)/(1024*1024)),2);
                        $type = pathinfo($file);
                    }
                    else
                    {
                        $taille = 0;
                    }
                                
                    $id_musique = $ET1['ID_MUSIQUE'];
                                
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
                                
                    $id_album = $ET1['ID_ALBUM'];
                    
                    $req="select * from ALBUM where ID_ALBUM = $id_album ";
                    $rs3=mysqli_query($conn,$req) or die(mysqli_error());
                    $ET3=mysqli_fetch_assoc($rs3);
                    $dossier = '';
                    
                    if($ET1['ID_ALBUM'] == 0)
                    {
                        $dossier = 'logo_musique';
                    }
                    else
                    {
                        $dossier = 'logo_album';
                    }

                    $id_compte_client = $ET1['ID_COMPTE_CLIENT'];

                    $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
                    $rs20=mysqli_query($conn,$req) or die(mysqli_error());
                    $ET20=mysqli_fetch_assoc($rs20);
				?>				
                <div class="musique_box">
                    <a href="musique.php?id_musique=<?php echo $ET1['ID_MUSIQUE'] ?>">
                        <div class="music_info">
                            <div class="music_img">
                                <img src="Medias/<?php echo $dossier ?>/<?php echo $ET1['LOGO_MUSIQUE'] ?>" alt="">
                            </div>
                            <div class="music_name">
                                <p class="titre_droit">
								<?php if(strlen($ET1['NOM_ARTISTE'])<=7){ ?>
                                <?php echo ucfirst(strtolower($ET1['NOM_ARTISTE'])).'_'; ?>
					            <?php } else { ?>
						        <?php echo substr(ucfirst(strtolower($ET1['NOM_ARTISTE'])),0,8).'...'.'_'; ?>
					            <?php } ?> 
								</p>
                                <p class="titre_gauche">
								<?php if(strlen($ET1['TITRE_MUSIQUE'])<=7){ ?>
                                <?php echo ucfirst(strtolower($ET1['TITRE_MUSIQUE'])); ?>
					            <?php } else { ?>
						        <?php echo substr(ucfirst(strtolower($ET1['TITRE_MUSIQUE'])),0,8).'...'; ?>
					            <?php } ?>
								</p>
                                <br>
                                <p class="music_icon">   
                                    <p>
										<?php if($ET1['ID_ALBUM'] == 0){ ?>
                                            <?php if($ET1['PRIX_MUSIQUE'] > 0){ ?>
                                                <h4>Instrumental</h4>
                                                <!--<h4><?php echo $ET1['PRIX_MUSIQUE']; ?>  Fc</h4>-->
                                            <?php } else { ?>
                                                <h4>Single</h4>
                                            <?php } ?>
					                    <?php } else { ?>
                                            <h4><?php echo substr(ucfirst(strtolower($ET3['TITRE_ALBUM'])),0,15) ?></h4>
					                    <?php } ?>
                                        <h4><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET1['DATE_MUSIQUE']) ?></h4>
                                    </p>
                                    <div class="detail_music_acceuil">
                                        <i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET5['nombre']).'</strong>'; ?></sup></i>
										<i class="fa fa-headphones"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET8['NOMBRE_ECOUTER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                                        <i class="fa fa-download"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET4['NOMBRE_TELECHARGEMENT_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                                        <!--<i class="fa fa-comment"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET6['nombre_commentaire'] + 0).'</strong>'; ?></sup></i>-->
                                    </div>
                                </p>
                                </a>
                            </div>
                        </div>
								
                </div>
			    <?php } ?>
           
                </div>
		        <h3 class="application">Apk</h3> 
                         
                <div class="story owl-carousel owl-theme">
				<?php 
					$req="select * from APPLICATION where NOM_APPLICATION like '%$mc%' and CATEGORIE_APPLICATION = 'APK' order by ID_APPLICATION desc limit 0,10";
                    $rs=mysqli_query($conn,$req) or die(mysqli_error());
                    
					while($ET=mysqli_fetch_assoc($rs)){
				
				    $file = 'Medias/application/'.$ET['APPLICATION']; 
					if(!empty($file) && file_exists($file) && is_file($file))
					{
						$taille = round((filesize($file)/(1024*1024)),2);
					}
					else
					{
						$taille = 0;
					}
				?>
                    <div class="app_logo_acceuil"> 
                        <a href="application.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>"><img src="Medias/logo/<?php echo ($ET['LOGO_APPLICATION']); ?>" alt="">
                        <div class="detail_application_acceuil">
                            <a href="#!"><h5><?php echo ucfirst($ET['NOM_APPLICATION']); ?></h5></a>
                            <a href="#!"><h6><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?></h6></a>
                        </div>
                    </div>
				<?php } ?>
                </div>
            </div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
    <script src="plugin-frameworks/owl.carousel.min.js"></script>

    <script src="sweetalert2.all.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
        $('.story').owlCarousel({
            center: false,
            items:2.8,
            loop:true,
            margin:5,
            stagePadding: 15,
        
        });
        });
        $(document).ready(function(){
        $('.musique').owlCarousel({
            center: false,
            items:1.03,
            loop:true,
            margin:5,
            stagePadding: 15,
        
        });
        });

    </script>
    </body>
</html>
<?php
include('message_de_confirmation.php');
?>