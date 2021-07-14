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
	
 $req="select * from APPLICATION where CATEGORIE_APPLICATION like '%$mc%' or NOM_APPLICATION like '%$mc%' order by ID_APPLICATION desc limit 0,50";
 $rs=mysqli_query($conn,$req) or die(mysqli_error());
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
	
        <?php include('message_de_confirmation.php'); ?>
		
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
						
						<li><a href="accueil_application.php"><i class="fa fa-gamepad" style="color: #4a97e6;"></i></a></li>
                        <hr>
                        
                        <li><a href="accueil_musique.php"><i class="fa fa-music"></i></a></li>
                        <hr>
						
                        <li><a href="plus.php?retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&condition=1"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
                <div class="app__content">
                    <div class="choose">

                        <a href="accueil_application.php?categorie=JEU" title="GAMES" class="separe"><label for="games"><i class="fa fa-gamepad"></i></label></a>
                        <a href="accueil_application.php?categorie=APK" title="APK"><label for="apk"><i class=" fa fa-puzzle-piece arra_icon"></i></label></a>
                        
                    </div>
                    <div class="app">
                        <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
						
						<?php 
							$id_compte_client = $ET['ID_COMPTE_CLIENT'];
							$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
                            $rs2=mysqli_query($conn,$req) or die(mysqli_error());
							$ET2=mysqli_fetch_assoc($rs2);
					    ?>
						
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
                        
						<a href="application.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>" title="<?php echo " Nom: ".($ET['NOM_APPLICATION'])."\n Taille: ".$taille." Mo \n Categorie : ".($ET['CATEGORIE_APPLICATION'])."\n Version : ".($ET['VERSION_APPLICATION'])."\n De : ".($ET2['NOM_COMPTE_CLIENT']) ?>">

                            <div class="content">
                            <div class="app__logo">
                                <img src="Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>" alt="">
                            </div>
                            <div class="app__info">
							    <?php if(strlen($ET['NOM_APPLICATION'])<=12){ ?>
                                <h3><?php echo ucfirst(strtolower($ET['NOM_APPLICATION'])); ?></h3>
								<?php } else { ?>
								<h3><?php echo substr(ucfirst(strtolower($ET['NOM_APPLICATION'])),0,13).'...'; ?></h3>
								<?php } ?>
                                <p>
                                    <?php echo '<strong><i>'.$taille.' Mo</i></strong>';?>
                                </p>
                            </div>
                            </div>
                        </a>
						<?php } ?>
						
                    </div>
                </div>
            </div>
           
        </div>

    </body>

</html>