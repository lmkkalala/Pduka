<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$id_client = $_SESSION['ID'];
$taille = 0;

require_once("client_connecter.php");

$id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));

$req="select * from MUSIQUE where ID_MUSIQUE = $id_musique ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());
$ET=mysqli_fetch_assoc($rs);

$id_musique = $ET['ID_MUSIQUE'];

$id_musique_en_cours = $ET['ID_MUSIQUE'];
							
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

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')
{
    $url="https";
}
else
{
    $url="http";
}

$url .="://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

include('fonction_terminaison.php');
include("nombre_des_vues_musique.php");
include('fonction_temps_ecoule.php');

?>
<!DOCTYPE html>

<html lang="fr" prefix="og: https://ogp.me/ns#">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:type" content="website" />
        <title>Pduka</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
		<link rel="shortcut icon" href="Medias/photo_site/icone.png">
        
        <meta property="og:title" content="<?php echo substr(ucfirst($ET['TITRE_MUSIQUE']),0,35) ?>" id="meta_titre"/>
        <meta property="og:url" content="<?php echo $url ?>" id="meta_url"/>
        <meta property="og:description" content="Ecouter, télécharger et liker les bonnes musiques sur Pduka." id="meta_description"/>
        <meta property="og:image" content="<?php echo 'Medias/'.$dossier.'/'.$ET['LOGO_MUSIQUE'] ?>" id="meta_logo"/>
    </head>

<body>
    <div class="retour-musique">
	    <button><a href="accueil_musique.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
        <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	</div>
    
    <div class="choose-music">
        <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
            <a href="#!" title="Télécharger" class="telecharger"><label for="apk"><i class="fa fa-download"></i></label></a>
        <?php }else{ ?>
            <a href="#!" title="Télécharger" class="afficher_message"><label for="apk"><i class="fa fa-download"></i></label></a>
        <?php } ?>
    </div>
    <div id="id_client" style="display:none;">
        <?php echo $_SESSION['ID'] ?> 
    </div>
    <div id="id_categorie_client" style="display:none;">
        <?php echo $ET20['ID_CATEGORIE_CLIENT'] ?> 
    </div>
    <div id="musique" style="display:none;">
        <?php echo $ET['MUSIQUE'] ?> 
    </div>

    <div class="main__container">
        <div class="app__Container"><br>
            <div class="musique_page">
              <div class="musique_contenu">
                    <div class="contenu_profil">
                        <img src="Medias/<?php echo $dossier ?>/<?php echo $ET['LOGO_MUSIQUE'] ?>" id="LOGO_MUSIQUE">
    				</div>
                    <div class="contenu_name">
                        <?php $file_en_cours = 'Medias/musique/'.$ET['MUSIQUE']; 
                            if(!empty($file_en_cours) && file_exists($file_en_cours) && is_file($file_en_cours))
                            {
                                $taille = round((filesize($file_en_cours)/(1024*1024)),2);
                            }
                            else
                            {
                                $taille = 0;
                            }
                            if($ET['ID_ALBUM'] == 0){ if($ET['PRIX_MUSIQUE'] > 0){ $album = ' - Instrumental';}else{ $album = ' - Single';}}else{ $album = ' - '.substr(ucfirst(strtolower($ET3['TITRE_ALBUM'])),0,7);}
                            $titre = substr(ucfirst(strtolower($ET['TITRE_MUSIQUE'])),0,19);
                            $artiste_et_album = substr(ucfirst(strtolower($ET['NOM_ARTISTE'])),0,16).''.$album;
                            $nombre_next = '_1';
                        ?>
                        
                        <h5 class="taille" id='TAILLE'><i class="fa fa-play"></i> <?php echo '<strong><i><span id="TAILLE_MUSIQUE">'.$taille.' Mo | '.pathinfo($ET['MUSIQUE'],PATHINFO_EXTENSION).'</span></i></strong>';?></h5> 
                        <h5 class="taille" id='JOUR'><i class="fa fa-clock"></i> <?php echo '<span id="rafraichir_duree_musique"></span>'; ?></h5> 
                        <h5 class="taille" id='JOUR'><?php echo '<span id="rafraichir_prix_musique"></span>'; ?></h5>
                        
                    </div>
                    <div id="lien" style="display:none;">
                        <?php echo $url ?>     
                    </div>
                    <div id="image" style="display:none;">
                        Medias/<?php echo $dossier ?>/<?php echo $ET['LOGO_MUSIQUE'] ?>      
                    </div>
                    <div id="id_musique" style="display:none;">
                        <?php echo $ET['ID_MUSIQUE'] ?> 
                    </div>

<!-- start here -->

            <div class="musique_player">
			    <div id="actualiser1">
				<?php
							
                    $req="select count(*) as nombre_commentaire from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique ";
                    $rs6=mysqli_query($conn,$req) or die(mysqli_error());
                    $ET6=mysqli_fetch_assoc($rs6);
                                
                    $req="select * from NOMBRE_VUES_MUSIQUE where ID_MUSIQUE = $id_musique ";
                    $rs7=mysqli_query($conn,$req) or die(mysqli_error());
                    $ET7=mysqli_fetch_assoc($rs7);
				?>
				    
                    <div class="icon_music">
					    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                            <span id="aime"><i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<span id="rafraichir_aimer_musique">0</span>'; ?><h5 class="icon_telecharger"><?php echo '<span id="rafraichir_afficher_aimer_musique">J\'aime</span>'; ?></h5></sup></i></span>
                        <?php }else{ ?>
			                <span class="afficher_message"><i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<span id="rafraichir_aimer_musique">0</span>'; ?><h5 class="icon_telecharger">J'aime</h5></sup></i></span>
			            <?php } ?>
						<i class="fa fa-headphones"> <sup class="nombre_aime"><?php echo '<span id="rafraichir_ecouter_musique">0</span>'; ?><h5 class="icon_telecharger">Ecoute</h5></sup></i>
                        <i class="fa fa-download"> <sup class="nombre_aime"><?php echo '<span id="rafraichir_telecharger_musique">0</span>'; ?><h5 class="icon_telecharger">Téléch...</h5></sup></i>
						<a id="lien_text" href="https://wa.me/?text=<?php echo $url ?>" target="_blank" style="color: #dbd4d4;">
                            <i class="fa fa-share-alt"> <sup class="nombre_aime"><?php echo '<span id="rafraichir_partager_musique" style="display:none;">0</span>'; ?><h5 class="icon_telecharger">Partager</h5></sup></i>
                        </a>
                    </div>                        
                    <div class="chaine">
                        <?php
				    
			                $id_compte_client = $ET['ID_COMPTE_CLIENT'];
							
			                $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
			                $rs10=mysqli_query($conn,$req) or die(mysqli_error());
			                if($ET10=mysqli_fetch_assoc($rs10)){
		                ?>
			            <a id='current_id_musique' href="#!">
		                    <img src="Medias/photo_compte_clients/<?php echo $ET10['PHOTO_COMPTE_CLIENT'] ?>" alt="" title="" id="PHOTO_COMPTE_CLIENT">
                            <h4 class="Nom_chaine" id="NOM_COMPTE_CLIENT"><?php echo substr(ucfirst(strtolower($ET10['NOM_COMPTE_CLIENT'])),0,18) ?></h4>
                            <h6 class="nombre_abonne">
				                <?php echo '<span id="rafraichir_sabonner_musique">0 Abonné</span>'; ?>
				            </h6>
		                </a>
                        <?php } ?>
                        <div class="follow">
						    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                            <div id="id_client" style="display:none;"><?php echo $_SESSION['ID'] ?></div>
                            <span id="sabonner" ><a href="#!"><?php echo '<span id="rafraichir_afficher_sabonner_musique"><i class="fa fa-play"></i> S\'abonner</span>'; ?></a></span>
                            <?php }else{ ?>
			                <span id="" class="afficher_message"><a href="#!"><i class="fa fa-play"></i> S'abonner</a></span>
			                <?php } ?>
                        </div>
                    </div>
				</div>

                <div id="id_compte_client" style="display:none;">
                    <?php echo $ET['ID_COMPTE_CLIENT'] ?>       
                </div>

                <!-- the change happened here-->
    <div id="app-cover">
                <!-- the change happened here-->

        <div id="bg-artwork"></div>
        <div id="bg-layer"></div>
          <div id="player">
            <div id="player-track">
                <div id="album-name"></div>
                <div id="track-name"></div>
                <div id="track-time">
                    <div id="current-time"></div>
                    <div id="track-length"></div>
                </div>
                <div id="s-area">
                    <div id="ins-time"></div>
                    <div id="s-hover"></div>
                    <div id="seek-bar"></div>
                </div>
            </div>
            <div id="player-content">
                <div id="album-art">
                    <img src="Medias/<?php echo $dossier ?>/<?php echo $ET['LOGO_MUSIQUE'] ?>" class="active" id="_1">
					<?php
					    $next = 1;
					    $id_categorie_musique = $ET['ID_CATEGORIE_MUSIQUE'];
					    
                        $req="select * from MUSIQUE order by ID_MUSIQUE desc limit 0,6";
                        $rs800=mysqli_query($conn,$req) or die(mysqli_error());
			
                        while($ET800=mysqli_fetch_assoc($rs800)){
			
			            if($ET800['ID_MUSIQUE'] != $ET['ID_MUSIQUE']){
						
						$dossier = '';
				
                        if($ET800['ID_ALBUM'] == 0)
                        {
                            $dossier = 'logo_musique';
                        }
                        else
                        {
	                        $dossier = 'logo_album';
                        }
					?>
					<img src="Medias/<?php echo $dossier ?>/<?php echo $ET800['LOGO_MUSIQUE'] ?>" id="_<?php echo ++$next; ?>">
					<?php }} ?>
                    <div id="buffer-box">Chargement ...</div>
                </div>
                <div id="player-controls">
                    <div class="control">
                        <div class="button" id="play-previous">
                            <i class="fas fa-backward"></i>
                        </div>
                    </div>
                    <div class="control">
                        <div class="button" id="play-pause-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="control">
                        <div class="button" id="play-next">
                            <i class="fas fa-forward"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="musique_favory">
		    <?php
            $id_musique1 = '';
			$file1 = '';
			$titre1 = '';
			$artiste_et_album1 = '';
			$nombre_next1 = '';
			$i = 1;
			
			$id_categorie_musique = $ET['ID_CATEGORIE_MUSIQUE'];
					    
            $req="select * from MUSIQUE order by ID_MUSIQUE desc limit 0,6";
            $rs80=mysqli_query($conn,$req) or die(mysqli_error());
			
            while($ET80=mysqli_fetch_assoc($rs80)){
			
			if($ET80['ID_MUSIQUE'] != $ET['ID_MUSIQUE']){
			
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
							
            $id_album = $ET80['ID_ALBUM'];

            $req="select * from ALBUM where ID_ALBUM = $id_album ";
            $rs30=mysqli_query($conn,$req) or die(mysqli_error());
            $ET30=mysqli_fetch_assoc($rs30);
			
			$req="select * from NOMBRE_ECOUTER_MUSIQUE where ID_MUSIQUE = $id_musique ";
            $rs700=mysqli_query($conn,$req) or die(mysqli_error());
            $ET700=mysqli_fetch_assoc($rs700);
			
			$req="select * from NOMBRE_PARTAGER_MUSIQUE where ID_MUSIQUE = $id_musique ";
            $rs1700=mysqli_query($conn,$req) or die(mysqli_error());
            $ET1700=mysqli_fetch_assoc($rs1700);

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
					    <?php if(strlen($ET80['NOM_ARTISTE'])<=10){ ?>
                            <?php echo ucfirst(strtolower($ET80['NOM_ARTISTE'])).'_'; ?>
					    <?php } else { ?>
						    <?php echo substr(ucfirst(strtolower($ET80['NOM_ARTISTE'])),0,10).'...'.'_'; ?>
					    <?php } ?> 
					</p>
                    <p class="titre_gauche">
					    <?php if(strlen($ET80['TITRE_MUSIQUE'])<=10){ ?>
                            <?php echo ucfirst(strtolower($ET80['TITRE_MUSIQUE'])); ?>
					    <?php } else { ?>
						    <?php echo substr(ucfirst(strtolower($ET80['TITRE_MUSIQUE'])),0,10).'...'; ?>
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
                                    <?php echo ' '.substr(ucfirst(strtolower($ET30['TITRE_ALBUM'])),0,30) ?>
                                <?php } ?>
                            </h4>
                            <h4><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET80['DATE_MUSIQUE']) ?> </h4>
                        </p>
						<div class="detail_music">
                            <i class="fa fa-heart"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET50['nombre']).'</strong>'; ?></sup></i>
                            <i class="fa fa-headphones"> <sup class="nombre_aime"><?php echo '<strong>'.Term($ET700['NOMBRE_ECOUTER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
						    <i class="fa fa-download"> <sup class="nombre_aime" id="NOMBRE_TELECHARGEMENT_MUSIQUE"><?php echo '<strong>'.Term($ET40['NOMBRE_TELECHARGEMENT_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                            <!--
                            <i class="fa fa-comment"> <sup class="nombre_aime"><?php echo '<strong id="nombre_commentaire">'.Term($ET60['nombre_commentaire']).'</strong>'; ?></sup></i>
							
                            <i class="fa fa-share-alt"> <sup class="nombre_aime"><?php echo '<strong id="NOMBRE_PARTAGER_MUSIQUE">'.Term($ET1700['NOMBRE_PARTAGER_MUSIQUE'] + 0).'</strong>'; ?></sup></i>
                            -->
                        </div>
                    </p>
                </a>
            </div>
        </div>

		    <?php 
			    if($ET80['ID_ALBUM'] == 0){ if($ET80['PRIX_MUSIQUE'] > 0){ $album = ' - Instrumental';}else{ $album = ' - Single';}}else{ $album = ' - '.substr(ucfirst(strtolower($ET30['TITRE_ALBUM'])),0,7);}
				
			    $file1 .= '%%'.$file;
				$titre1 .= '%%'.substr(ucfirst(strtolower($ET80['TITRE_MUSIQUE'])),0,19);
				$artiste_et_album1 .= '%%'.substr(ucfirst(strtolower($ET80['NOM_ARTISTE'])),0,16).''.$album;
                $nombre_next1 .= '%%_'.++$i;
                $id_musique1 .= '%%'.$ET80['ID_MUSIQUE'];
			}} ?>
			<div id="musique_de_plus" style="display:none;"><?php echo $file_en_cours.''.$file1 ?></div>
			<div id="titre_musique_de_plus" style="display:none;"><?php echo $titre.''.$titre1 ?></div>
			<div id="artiste_et_titre_album_de_plus" style="display:none;"><?php echo $artiste_et_album.''.$artiste_et_album1 ?></div>
            <div id="nombre_next" style="display:none;"><?php echo $nombre_next.''.$nombre_next1 ?></div>
            <div id="id_musiques" style="display:none;"><?php echo $id_musique_en_cours.''.$id_musique1 ?></div>
	</div>
	<!-- End here -->
    	
    <h4 class="commentaire_titre" style="display:none;"> Commentaires - <i class="fa fa-comment"><sup class="nombre_aime"> <?php echo '<strong id="nombre_commentaire_header">'.Term($ET6['nombre_commentaire']).'</strong>'; ?></sup></i></h4>
    
    <div class="musique_comments" style="display:none;">

            <div class="commentaire_musique">
			
			    <?php 
			        if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0)
			        {
                        $lien_envoie = 'commentaire_musiquescript.php';
                    }
					else
					{
					    $lien_envoie ='index1.php?deconnexion=0&code=100';
			        } 
			    ?>
                
			
                <form method="POST" action="<?php echo $lien_envoie ?>?id_musique=<?php echo ($ET['ID_MUSIQUE']) ?>">
                    <input type="text" name="commentaire" id="" placeholder="laisser votre commentaire">
					
                    <button type="submit" id="submit" class="Envoyer" >Envoyer</button>
				</form>
<!-- le changement se passe ici -->
                    <div class="client_comments" id="client_comment_id"><br><br>
                    <?php
                        $id_musique = $ET['ID_MUSIQUE'];
                        $count_data = 0;						
					    $req="select * from COMMENTAIRE_MUSIQUE where ID_MUSIQUE = $id_musique order by DATE_COMMENTAIRE_MUSIQUE desc";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
						if ($rs1 == true and mysqli_num_rows($rs1) > 0) {
    						while($ET1['comments'][$count_data]=mysqli_fetch_assoc($rs1)){
        						$id_client = $ET1['comments'][$count_data]['ID_CLIENT'];

        					    $req="select * from CLIENT where ID_CLIENT = $id_client ";
                                $rs2=mysqli_query($conn,$req) or die(mysqli_error());
        					    $ET2['comments'][$count_data]=mysqli_fetch_assoc($rs2);
                               
                                $id_commentaire_musique = $ET1['comments'][$count_data]['ID_COMMENTAIRE_MUSIQUE'];

                                $req_count_like="select count(*) as nombre from AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = ".$id_commentaire_musique." ";
                                $rs2_like=mysqli_query($conn,$req_count_like) or die(mysqli_error());
                                $ET4['comments'][$count_data]=mysqli_fetch_assoc($rs2_like);
                                
                                $req_count_unlike="select count(*) as nombre from PAS_AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = ".$id_commentaire_musique." ";
                                $rs2_unlike=mysqli_query($conn,$req_count_unlike) or die(mysqli_error());
                                $ET5['comments'][$count_data]=mysqli_fetch_assoc($rs2_unlike);
                                $count_data++;
    						}
                        }else{
                            $id_commentaire_musique = 0;
                            $ET2['comments'][$count_data] = array('PHOTO_CLIENT'=>'','NOM_CLIENT'=>'');
                            $ET1['comments'][$count_data] = array('ID_CLIENT'=>'','DATE_COMMENTAIRE_MUSIQUE'=>'','ID_COMMENTAIRE_MUSIQUE'=>'','COMMENTAIRE_MUSIQUE'=>'');
                             $req_count_like="select count(*) as nombre from AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = ".$id_commentaire_musique." ";
                                $rs2_like=mysqli_query($conn,$req_count_like) or die(mysqli_error());
                                $ET4['comments'][$count_data]=mysqli_fetch_assoc($rs2_like);
                                
                                $req_count_unlike="select count(*) as nombre from PAS_AIMER_COMMENTAIRE_MUSIQUE where ID_COMMENTAIRE_MUSIQUE = ".$id_commentaire_musique." ";
                                $rs2_unlike=mysqli_query($conn,$req_count_unlike) or die(mysqli_error());
                                $ET5['comments'][$count_data]=mysqli_fetch_assoc($rs2_unlike);
                                $count_data++;
                        }

$count = 0;
while ($count < mysqli_num_rows($rs1) or $count == 0) {
					?>
                        <div class="contenu_clients">
                            <img src="Medias/photo_clients/<?php echo $ET2['comments'][$count]['PHOTO_CLIENT']; ?>" alt="" title="" class="image_client" id="PHOTO_CLIENT" />
                        <?php 
						    $id_compte_client = $ET['ID_COMPTE_CLIENT'];
							
							$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
                            $rs11=mysqli_query($conn,$req) or die(mysqli_error());
							$ET11=mysqli_fetch_assoc($rs11);

     					    $id_client_compte_client = $ET11['ID_CLIENT'];
                        ?>
                            <h4 class="detail_client" id="NOM_CLIENT">
                        						
                                <?php
                                    if($id_client_compte_client == $ET1['comments'][$count]['ID_CLIENT']){
                                ?>
                                    <span class="dev_discussion">
                                        <?php echo $ET2['comments'][$count]['NOM_CLIENT']; ?>
                                    </span>
                                        <?php } else { echo $ET2['comments'][$count]['NOM_CLIENT']; } ?>
                            
                                <i class="fa fa-clock"> <?php if ($id_commentaire_musique != 0) {
                                     echo duree($ET1['comments'][$count]['DATE_COMMENTAIRE_MUSIQUE']); }?></i>
                        							
						    </h4>
                        
                        <br>

                            <h5 class="commentaire_client">
    						    <span id="COMMENTAIRE_MUSIQUE"><?php echo $ET1['comments'][$count]['COMMENTAIRE_MUSIQUE'] ?></span> <br><br>
    							<?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                                    <span  id="aimer_commentaire_musique"><a href="#!"><i class="fa fa-thumbs-up"> 
                                        <sup style="color:black;"><?php if($ET4['comments'][$count]['nombre']!=0) echo '<strong>'.Term($ET4['comments'][$count]['nombre'] + 0).'</strong>'; ?></sup></i></a>
                                    </span>
                                    <span  id="pas_aimer_commentaire_musique"><a href="#!"><i class="fa fa-thumbs-down"> 
                                        <sup style="color:black;"><?php if($ET5['comments'][$count]['nombre']!=0) echo '<strong>'.Term($ET5['comments'][$count]['nombre'] + 0).'</strong>'; ?></sup></i></a>
                                    </span>
                                <?php }else{ ?>
                                    <span  id=""><a href="#!" class="afficher_message"><i class="fa fa-thumbs-up"> 
                                        <sup style="color:black;"><?php if($ET4['comments'][$count]['nombre']!=0) echo '<strong>'.Term($ET4['comments'][$count]['nombre'] + 0).'</strong>'; ?></sup></i></a>
                                    </span>
                                    <span  id=""><a href="#!" class="afficher_message"><i class="fa fa-thumbs-down"> 
                                        <sup style="color:black;"><?php if($ET5['comments'][$count]['nombre']!=0) echo '<strong>'.Term($ET5['comments'][$count]['nombre'] + 0).'</strong>'; ?></sup></i></a>
                                    </span>
                                <?php } ?>
                                
                                <i class="fa fa-share"> <sup>Répondre</sup></i>
                                <div id="id_commentaire_musique" style="display:none;"><?php echo $ET1['comments'][$count]['ID_COMMENTAIRE_MUSIQUE'] ?></div>							
                            </h5>

                        </div><br>
						
                        <?php $count ++;} ?>
                    </div>
<!-- le changement se passe ici fin -->
                </div>
           </div>

            </div>
        </div>
    </div>
</div>

	
</body>

    <!-- <script src="dist/js/bootstrap.min.js"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
    <script src="plugin-frameworks/manupilation_musique.js"></script>
    <!--
    <script src="plugin-frameworks/partager.js"></script>
    <script src="plugin-frameworks/rafraichir_partager_musique.js"></script>
    -->
    <script src="sweetalert2.all.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="plugin-frameworks/afficher_se_connecter.js"></script>
</html>