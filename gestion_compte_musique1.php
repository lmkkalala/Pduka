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
            <button><a href="compte.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
            
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
        </div>  
        <div class="app__form">
                <div class="detail_chaine">
                    <img src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="" title="" class="photo_chaine">
                    <h5 class="nom_artiste_single"><?php echo substr(ucfirst(strtolower($ET['NOM_COMPTE_CLIENT'])),0,25);?></h5>
                    <h6 class="ajoute_single">Compte musicien</h6>
                 
                    <div class="album_ajoute">
                        <a href="gestion_compte_musicien.php?id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_single">Single</h5></a>
                        <a href="gestion_compte_musique1.php?id_compte_client=<?php echo $id_compte_client ?>"><h5 class="ajoute_single_album" style="color: #d888f0;">Album</h5></a>
                    </div>
                </div>
                <div class="buton_ajoute_musique">
                    <a href="ajouteralbum.php?id_compte_client=<?php echo $id_compte_client ?>"><button>Cliquez ici pour ajouter un album</button></a>
                </div>
                 
				<div class="musique_album_ajoute">
				    <?php
					
					    $req="select * from ALBUM where ID_COMPTE_CLIENT = $id_compte_client order by ID_ALBUM desc";
                        $rs=mysqli_query($conn,$req) or die(mysqli_error());
						
					    while($ET=mysqli_fetch_assoc($rs)){
						
						$id_album = $ET['ID_ALBUM'];
						
						$req="select count(*) as nombre from MUSIQUE where ID_ALBUM = $id_album ";
                        $rs4=mysqli_query($conn,$req) or die(mysqli_error());
                        $ET4=mysqli_fetch_assoc($rs4);
						
					?>
                        <div class="musique_box">
                            <a href="mon_album.php?id_album=<?php echo $ET['ID_ALBUM'] ?>&id_compte_client=<?php echo $id_compte_client ?>">
                                <div class="music_info">
                                    <div class="music_img">
                                        <img src="Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>" alt="" title="" >
                                        <a href="#!"><h4 class="nbr_chanson"><?php echo $ET4['nombre'] ?></h4></a>
                                    </div>
                                <div class="music_name">
                                    <p class="titre_droit"><?php echo substr(ucfirst(strtolower($ET['TITRE_ALBUM'])),0,28);?></p>
                                <br>
                                    
                                    <p class="music_icon">   
                                            <p>
                                                <h4><?php echo duree($ET['DATE_ALBUM']);?></h4>
                                            </p>
                                        <div class="supprimer_chanson">
                                            <a href="modifier_album.php?id_album=<?php echo $ET['ID_ALBUM'] ?>&id_compte_client=<?php echo $id_compte_client ?>" class="btn_modifier"><button class="Compte_supprimer_musique">Modifier</button></a>
                                            <a href="supprimer_mon_album.php?id_album=<?php echo $ET['ID_ALBUM'] ?>&id_compte_client=<?php echo $id_compte_client ?>" class="btn_supprimer"><button class="Compte_supprimer_musique">Suppr</button></a>
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
				text: 'Vous voulez vraiment modifier ?',
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