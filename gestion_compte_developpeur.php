<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$id_client = $_SESSION['ID'];
	
$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));

$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
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
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="sweetalert2.all.js"></script>
	<script src="sweetalert2.js"></script>
	<script src="sweetalert2.min.js"></script>
	<script src="sweetalert2.all.min.js"></script>
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
        <div class="retour-musique">
            <button><a href="compte.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
            <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
        </div>  
        <div class="app__form">
                <div class="detail_chaine-compte">
                    <img src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="" title="" class="photo_chaine">
                    <h5 class="nom_artiste_single"><?php echo substr(ucfirst(strtolower($ET['NOM_COMPTE_CLIENT'])),0,25);?></h5>
                    <h6 class="ajoute_single">Compte développeur</h6>
                </div>
                <div class="buton_ajoute_musique">
                <a href="ajouterapplication.php?id_compte_client=<?php echo $id_compte_client ?>"><button>Cliquez ici pour ajouter une application</button></a>                            </div>
                 
				<div class="musique_album_ajoute">
				    <?php
					    $req="select * from APPLICATION where ID_COMPTE_CLIENT = $id_compte_client order by ID_APPLICATION desc";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
						
					    while($ET1=mysqli_fetch_assoc($rs1)){
						
						$file = 'Medias/application/'.$ET1['APPLICATION']; 

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
                            <a href="administration_application.php?id_application=<?php echo ($ET1['ID_APPLICATION']) ?>&id_compte_client=<?php echo $id_compte_client ?>">
                                <div class="music_info">
                                    <div class="music_img">
                                        <img src="Medias/logo/<?php echo $ET1['LOGO_APPLICATION'] ?>" alt="" title="" >
                                    </div>
                                <div class="music_name">
                                    <p class="titre_droit"><?php echo substr(ucfirst(strtolower($ET1['NOM_APPLICATION'])),0,25);?></p>
                                <br>
                                    
                                    <p class="music_icon">   
										<p>
											<h4><?php echo '<strong><i>'.$taille.' Mo</i></strong>';?> | <?php echo duree($ET1['DATE_APPLICATION']);?></h4>
										</p>
                                        <div class="supprimer_chanson">
                                            <a href="modifier_application.php?id_application=<?php echo ($ET1['ID_APPLICATION']) ?>&id_compte_client=<?php echo $id_compte_client ?>" class="btn_modifier"><button class="Compte_supprimer_musique">Modifier</button></a>
                                            <a href="supprimer_mon_application.php?id_application=<?php echo ($ET1['ID_APPLICATION']) ?>&id_compte_client=<?php echo $id_compte_client ?>" class="btn_supprimer"><button class="Compte_supprimer_musique">Suppr</button></a>
                                        </div>
                                    </p>
                                </a>
                            </div>
                        </div>
				    <?php } ?>

                </div>
        </div>
	<script>
		$('.btn_supprimer').on('click',function(e){
			e.preventDefault();
			const href = $(this).attr('href');
			swal.fire({
				text: 'Vous voulez vraiment supprimer ?',
				icon: "question",
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonColor: '#3885d6',
				cancelButtonColor:'#d33',
				confirmButtonText: 'Oui',
				cancelButtonText: 'Non',
			}).then((result)=>{
				if(result.value){
					document.location.href=href;
				}
			})
		})
		$('.btn_modifier').on('click',function(e){
			e.preventDefault();
			const href = $(this).attr('href');
			swal.fire({
				text: 'Vous voulez modifier ?',
				icon: "question",
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonColor: '#3885d6',
				cancelButtonColor:'#d33',
				confirmButtonText: 'Oui',
				cancelButtonText: 'Non',
			}).then((result)=>{
				if(result.value){
					document.location.href=href;
				}
			})
		})
		
	</script>
    </body>
</html>