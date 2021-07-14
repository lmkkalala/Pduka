<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$i=0;
$id_client = $_SESSION['ID'];
	
$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
$id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));

$req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $id_compte_client ";
$rs3=mysqli_query($conn,$req) or die(mysqli_error());
$ET3=mysqli_fetch_assoc($rs3);

$req="select * from ALBUM where ID_ALBUM = $id_album ";
$rs1=mysqli_query($conn,$req) or die(mysqli_error());
						
$ET1=mysqli_fetch_assoc($rs1);

$req="select count(*) as nombre from MUSIQUE where ID_ALBUM = $id_album ";
$rs2=mysqli_query($conn,$req) or die(mysqli_error());

$ET2=mysqli_fetch_assoc($rs2);

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
	    <?php if(isset ($_GET['code'])){ 
		    if(($_GET['code'])==0){ ?>
	        <script>			
				swal.fire({
				text: " Bien effctué !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	    <?php } } ?>
        <div class="retour-musique">
            <button><a href="gestion_compte_musique1.php?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
        </div>   
        <div class="app__form">
                <div class="detail_chaine">
				    <img src="Medias/logo_album/<?php echo $ET1['COVER_ALBUM'] ?>" alt="" title="" class="photo_album">
                    <h5 class="nom_artiste_album"><?php echo substr(ucfirst(strtolower($ET1['TITRE_ALBUM'])),0,15); ?></h5>
                    <h6 class="ajoute_singles_album">Avec <?php if($ET2['nombre'] > 1){ echo $ET2['nombre'].' chansons'; } else { echo $ET2['nombre'].' chanson'; } ?></h6>
         
                </div>
                <div class="buton_ajoute_musique">
                    <a href="ajoutermusique_album.php?id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>"><button>Cliquez ici pour ajouter une chanson</button></a>
                </div>
                <div class="musique_album_ajoute">
				    <?php
					    $req="select * from MUSIQUE where ID_COMPTE_CLIENT = $id_compte_client && ID_ALBUM = $id_album order by ID_MUSIQUE desc ";
                        $rs=mysqli_query($conn,$req) or die(mysqli_error());
						
					    while($ET=mysqli_fetch_assoc($rs)){
						
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

                        $req="select * from ACTIVER_TELECHARGEMENT where ID_MUSIQUE = $id_musique ";
                        $rs2=mysqli_query($conn,$req) or die(mysqli_error());
						
					    $ET2=mysqli_fetch_assoc($rs2);
					?>
                        <div class="musique_box">
                                <a href="administration_musique.php?id_musique=<?php echo ($ET['ID_MUSIQUE']) ?>&id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>">
                                <div class="music_info">
                                    <div class="music_img">
                                        <img src="Medias/logo_album/<?php echo $ET['LOGO_MUSIQUE'] ?>" alt="" title="" >
                                    </div>
                                <div class="music_name">
                                    <p class="titre_droit"><?php echo substr(ucfirst(strtolower($ET['TITRE_MUSIQUE'])),0,26);?></p>
                                <br>
                                    
                                    <p class="music_icon">   
                                        <p>
                                            <h4><?php echo $taille .' Mo';?> | <?php echo duree($ET['DATE_MUSIQUE']);?></h4>
                                        </p>
                                        <div class="supprimer_chanson">
										<!-- Politique d'activation de la boutton téléchargement ou non -->
                                            <?php if($ET3['NIVEAU_COMPTE_CLIENT'] == 2){ ?>
                                            <a href="activer_ma_musique.php?id_album=<?php echo $id_album ?>&id_musique=<?php echo ($ET['ID_MUSIQUE']) ?>&id_compte_client=<?php echo $id_compte_client ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>" data="Vous voulez rendre cette chanson <?php if($ET2['ACTIVER_TELECHARGEMENT'] == 1) echo 'non'; ?> téléchargeable ?" class="btn_modifier"><button class="Compte_supprimer_musique"><?php if($ET2['ACTIVER_TELECHARGEMENT'] == 1){ echo 'Activé';}else{ echo 'Activer';} ?></button></a>
                                            <?php } ?>
										<!-- -->
                                            <a href="supprimer_ma_musique.php?id_album=<?php echo $id_album ?>&id_musique=<?php echo ($ET['ID_MUSIQUE']) ?>&id_compte_client=<?php echo $id_compte_client ?>" class="btn_supprimer"><button class="Compte_supprimer_musique">Supprimer</button></a>
                                        </div>
                                    </p>
                                </a>
                            </div>
                        </div>
					<?php } ?>   

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
			const data = $(this).attr('data');
			swal.fire({
				text: data,
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