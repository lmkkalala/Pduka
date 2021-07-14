<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$id_client = $_SESSION['ID'];

require_once("client_connecter.php");

 $id_application = htmlspecialchars(trim(addslashes($_GET['id_application'])));
	
 $req="select * from APPLICATION where ID_APPLICATION = $id_application ";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 $ET=mysqli_fetch_assoc($rs);
 
 $req="select * from CAPTURE where ID_APPLICATION = $id_application order by ID_CAPTURE desc limit 0,3";
 $rs2=mysqli_query($conn,$req) or die(mysqli_error());

 /*
 $req="select * from NOMBRE_TELECHARGEMENT where ID_APPLICATION = $id_application ";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
 $ET3=mysqli_fetch_assoc($rs);
 
if($ET3['NOMBRE_TELECHARGEMENT'] == 0)
{
    $nbre_telechargement = 0;
} 
else 
{  
    $nbre_telechargement = $ET3['NOMBRE_TELECHARGEMENT'];
}
*/

if(isset($_SERVER['HTTPS'])&& $_SERVER['HTTPS']=='on')
{
    $url="https";
}
else
{
    $url="http";
}

$url .="://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

include('fonction_terminaison.php');
include('fonction_temps_ecoule.php');
include("nombre_des_vues_application.php");

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
	<meta property="og:title" content="<?php echo substr(ucfirst($ET['NOM_APPLICATION']),0,35) ?>" />
	<meta property="og:url" content="<?php echo $url ?>" />
	<meta property="og:description" content="<?php echo substr(ucfirst($ET['APROPOS_APPLICATION']),0,65) ?>" />
	<meta property="og:image" content="Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>" />
</head>
<body onload="refresh_div(); refresh_div1(); refresh_div2();">
    <div class="retour-musique">
	    <button><a href="accueil_application.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	</div>
	<?php // include("meta_application.php"); ?>
    <div class="detail__container">
        <div class="details">
		    <div class="choose">
				<a href="https://wa.me/?text=<?php echo $url ?>" target="_blank" class="separe" >
			    	<label><i class="fa fa-share-alt" style="padding: 0px 4.5px"></i></label>
				</a>
				<?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                    <a href="signaler.php?id_application=<?php echo $id_application ?>&retour=<?php echo $id_application ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>" title="Signaler"><label for="apk"><i class="fa fa-exclamation-triangle" style="padding: 0px 2.3px"></i></label></a>
		        <?php }else{ ?>
			        <a href="#!" title="Signaler" class="afficher_message"><label for="apk"><i class="fa fa-exclamation-triangle" style="padding: 0px 2.3px"></i></label></a>
			    <?php } ?>
			</div>
			<div id="id_application" style="display:none;"><?php echo $id_application ?></div>
            <div class="app__profile">
                <div class="logo__cont">
				    <a href="photo.php?lien=Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&id_application=<?php echo $id_application ?>&file=<?php echo ($ET['LOGO_APPLICATION']) ?>">
                    	<img src="Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>" alt="">
					</a>
                </div>
                <div class="det__down">
                    <div class="name">
					    <?php if(strlen($ET['NOM_APPLICATION'])<=15){ ?>
                            <h3 style="font-size: 16px;"><?php echo ucfirst(strtolower($ET['NOM_APPLICATION'])); ?></h3>
						<?php } else { ?>
							<h3 style="font-size: 16px;"><?php echo substr(ucfirst(strtolower($ET['NOM_APPLICATION'])),0,16).'...'; ?></h3>
						<?php } ?>
                        
						<?php $file = 'Medias/application/'.$ET['APPLICATION']; 
						    if(!empty($file) && file_exists($file) && is_file($file))
							{
						        $taille = round((filesize($file)/(1024*1024)),2);
							}
							else
							{
							    $taille = 0;
							}
						?>
                        <p style="font-size: 11px;"><i class="fa fa-play"></i> <?php echo '<strong><i>'.$taille.' Mo | '.pathinfo($ET['APPLICATION'],PATHINFO_EXTENSION).'</span></i></strong>';?></p>
						<p style="font-size: 11px;"><i class="fa fa-download"></i> <strong><i><span id="rafraichir_telechargement_application"></span></i></strong></p>
                    </div>
                    <div class="download">
					<?php if($ET['VISIBILITE_APPLICATION'] == 1){ ?>
					    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                            <a href="telechargement.php?file=Medias/application/<?php echo $ET['APPLICATION'] ?>&id_application=<?php echo $id_application ?>" style="color: #0077f0;"><i class="fa fa-download"></i></a>
		                <?php }else{ ?>
			                <span class="afficher_message" style="color: #0077f0;"><i class="fa fa-download"></i></span>
			            <?php } ?>
                    <?php } else { ?>
					    <h3><i class="fa fa-lock"></i></h3>
					<?php } ?>
                    </div>
                </div>
            </div>
            <hr class="w-100 mt-10">
            <div class="about__app">
                <h2><i class="fa fa-newspaper"> A propos de l'application</i></h2>
                <p>
				    <?php echo ($ET['APROPOS_APPLICATION']) ?>
				</p>
                <div class="screen">
                    <div class="screen__title">
                        <h2><i class="fa fa-images"> Captures d'écran</i></h2>
                    </div>
                    <div class="screen__img">
					    <?php while($ET4=mysqli_fetch_assoc($rs2)){ ?>
							<?php $i++;	?>
						
							<a href="photo.php?lien=Medias/capture/<?php echo $ET4['CAPTURE'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&id_application=<?php echo $id_application ?>&file=<?php echo ($ET4['CAPTURE']) ?>&id_capture=<?php echo ($ET4['ID_CAPTURE']) ?>">
								<img src="Medias/capture/<?php echo $ET4['CAPTURE'] ?>" alt="" >
							</a>
							
						<?php } ?>
                    </div>
					<?php
						$id_compte_client = $ET['ID_COMPTE_CLIENT'];
						
						$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
						$rs5=mysqli_query($conn,$req) or die(mysqli_error());
						$ET5=mysqli_fetch_assoc($rs5);

						$id_client_compte_client = $ET5['ID_CLIENT'];	
					?>
					<?php if($id_client_compte_client == $id_client){ if($i<3){	?>
					<div class="capture_ecras"> 
                        <a href="ajouter_capture_application.php?id_application=<?php echo $id_application ?>">Ajouter <?php echo 3-$i;	?> capture<?php if(3-$i > 1){ ?>s<?php } ?></a>
					</div>
					<?php }}?>
                </div>
				<div class="comments">
                    
                    <h2><i class="fa fa-comments"> Commentaires</i></h2>
                    <div class="comments__content">
					
					<?php
                        						
					    $req="select * from COMMENTAIRE where ID_APPLICATION = $id_application order by DATE_COMMENTAIRE desc";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
					?>
					
                    <?php while($ET1=mysqli_fetch_assoc($rs1)){ ?>
					    <?php 
							$id_client = $ET1['ID_CLIENT'];
							$req="select * from CLIENT where ID_CLIENT = $id_client ";
                            $rs2=mysqli_query($conn,$req) or die(mysqli_error());
							$ET2=mysqli_fetch_assoc($rs2);
					    ?>
					
                        <div class="comment__details">
                            <h4>
							    <img src="Medias/photo_clients/<?php echo $ET2['PHOTO_CLIENT'] ?>" alt="Profil" title="" class="photo_commentaire">
							    <?php if($id_client_compte_client == $ET1['ID_CLIENT']){ ?>
                              	<span class="dev_discussion"><?php echo $ET2['NOM_CLIENT'] ?></span>
								<?php } else { ?>
								<?php echo $ET2['NOM_CLIENT'];} ?>
							</h4>
                            
                            <p>
							    <?php echo wordwrap($ET1['COMMENTAIRE'],80,'<br/>'); ?>
							</p>
						    <?php
								$id_commentaire = $ET1['ID_COMMENTAIRE'];
								
								$req="select count(*) as nombre from AIMER where ID_COMMENTAIRE = $id_commentaire ";
                                $rs2=mysqli_query($conn,$req) or die(mysqli_error());
								$ET4=mysqli_fetch_assoc($rs2);
						    ?>
                            <!--<div class="acts">
							    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0){ ?>
                                    <span  id="aimer_commentaire_application"><a href="#!"><button class="like" value="0" type="submit"><i class="fa fa-heart"><sup style="color:black;"><?php echo $ET4['nombre'] .'<span id="rafraichir_aimer_commentaire_application"></span>'; ?></sup></i></button></a></span>
		                        <?php }else{ ?>
			                        <span  id=""><a href="#!" class="afficher_message"><button class="like" value="0" type="submit"><i class="fa fa-heart"><sup style="color:black;"><?php echo $ET4['nombre'] .'<span id="rafraichir_aimer_commentaire_application"></span>'; ?></sup></i></button></a></span>
			                    <?php } ?>
                            </div>-->
							<div id="id_commentaire_application" style="display:none;"><?php echo $ET1['ID_COMMENTAIRE'] ?></div>
							Commenté <?php echo duree($ET1['DATE_COMMENTAIRE']) ?>
                        </div>
						<hr class="w-100">
					<?php } ?>

                    </div>
					
					<?php 
			            if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0)
			            {
                            $lien_envoie = 'commentairescript.php';
                        }
					    else
					    {
					        $lien_envoie ='index1.php?deconnexion=0&code=100';
			            } 
			        ?>
				
                    <form method="POST" action="<?php echo $lien_envoie ?>?id_application=<?php echo $id_application ?>">
                    <div class="react">
                        <textarea name="commentaire" id="" cols="30" rows="10" placeholder="Laisser un commentaire !"></textarea>
						
                        <button type="submit"><i class="fa fa-paper-plane"></i></button>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="plugin-frameworks/jquery-3.2.1.min.js"><\/script>')</script>
	<script src="plugin-frameworks/traitement_application.js"></script>
	<script src="plugin-frameworks/rafraichir_telechargement_application.js"></script>
	<!--
	<script src="plugin-frameworks/rafraichir_aimer_commentaire_application.js"></script>
	<script src="plugin-frameworks/rafraichir_commentaire_application.js"></script>
	<script src="plugin-frameworks/partager.js"></script>
	-->
    <script src="sweetalert2.all.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
	<script src="plugin-frameworks/afficher_se_connecter.js"></script>
</body>
</html>