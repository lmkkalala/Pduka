<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$somme = 0;
$id_client = $_SESSION['ID'];

require_once("client_connecter.php");

 $id_album=htmlspecialchars(trim(addslashes($_GET['id_album'])));
 $id_compte_client=htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
 $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
 
 $req="select count(*) as nombre from MUSIQUE where ID_ALBUM = $id_album ";
 $rs2=mysqli_query($conn,$req) or die(mysqli_error());
 $ET2=mysqli_fetch_assoc($rs2);
 
 $req="select * from MUSIQUE where ID_ALBUM = $id_album ";
 $rs3=mysqli_query($conn,$req) or die(mysqli_error());
 
 while($ET3=mysqli_fetch_assoc($rs3))
 {
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
 }
	
 $req="select * from ALBUM where ID_ALBUM = $id_album ";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 $ET=mysqli_fetch_assoc($rs);
 
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
            <button><a href="albums.php?id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>&id_musique=<?php echo $id_musique ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
        </div>  
        <div class="album_contenu"> 
        <div class="corp-chaine">
            

            <div class="detail_chaine">
                <a href="photo.php?lien=Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>&id_album=<?php echo $id_album ?>&id_musique=<?php echo $id_musique ?>&id_compte_client=<?php echo $id_compte_client ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['COVER_ALBUM']) ?>">
                    <img class="photo_album_detail" src="Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>" alt="">
                </a>
                <div class="music_name_album">
                    <h5 class="nom_chaine"><?php echo substr(ucfirst(strtolower($ET['TITRE_ALBUM'])),0,28); ?></h5>
                    <h6 class="abonne_chaine"><?php echo ($ET2['nombre']) ?> chanson<?php if($ET2['nombre']>1) echo 's' ?></h6>
                </div>
            
            </div>

                <div class="single_album">
                
                    <?php
                    $req="select * from MUSIQUE where ID_ALBUM = $id_album order by ID_MUSIQUE desc";
                    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
                    
                    while($ET1=mysqli_fetch_assoc($rs1)){
                        $somme = 0;						
                                                
                        $file = 'Medias/musique/'.$ET1['MUSIQUE'];
                        
                            if(!empty($file) && file_exists($file) && is_file($file))
                            {
                                $taille = round((filesize($file)/(1024*1024)),2);
                            }
                            else
                            {
                                $taille = 0;
                            }
                        $somme += $taille; 

						$id_compte_client = $ET1['ID_COMPTE_CLIENT'];
			
						$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
						$rs20=mysqli_query($conn,$req) or die(mysqli_error());
						$ET20=mysqli_fetch_assoc($rs20);

						$id_musique = $ET1['ID_MUSIQUE'];  
			
						$req="select * from ACTIVER_TELECHARGEMENT where ID_MUSIQUE = $id_musique ";
						$rs200=mysqli_query($conn,$req) or die(mysqli_error());
						$ET200=mysqli_fetch_assoc($rs200);    
                    ?>
                    <div class="musique_box">
                        <div class="music_info">
                            <a href="musique.php?id_musique=<?php echo $ET1['ID_MUSIQUE'] ?>">
                                <div class="music_img">
                                    <img src="Medias/logo_album/<?php echo $ET1['LOGO_MUSIQUE'] ?>" alt="">
                                </div>
                            </a>
                        <div class="music_name">
                            <p class="titre_droit"><a href="musique.php?id_musique=<?php echo $ET1['ID_MUSIQUE'] ?>"><?php echo substr(ucfirst(strtolower($ET1['TITRE_MUSIQUE'])),0,25);?></a></p>
                            <br><br>
                            <p class="music_icon">   
                                <p>
                                    <h4><?php echo $somme.' Mo';?> | <?php echo duree($ET1['DATE_MUSIQUE']);?></h4>
                                </p>
                                <?php if($ET200['ACTIVER_TELECHARGEMENT'] == 1){ ?>
                                <div class="detail_music_icon">
                                    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                                        <a href="telechargement.php?file=Medias/musique/<?php echo $ET1['MUSIQUE'] ?>&id_musique=<?php echo $ET1['ID_MUSIQUE'] ?>" title="Télécharger"><i class="fa fa-download"></i></a>
                                    <?php } else { ?>
                                        <a href="#!" title="Télécharger" class="afficher_message"><i class="fa fa-download"></i></a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </p>
                            
                        </div>
                    </div>
                            
                    <?php } ?>
                </div>

            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="sweetalert2.all.js"></script>
        <script src="sweetalert2.js"></script>
        <script src="sweetalert2.min.js"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="plugin-frameworks/afficher_se_connecter.js"></script>
    </body>

</html>