<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
	$id_client=$_SESSION['ID'];
	
	$req="select * from ALBUM order by ID_ALBUM desc";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	
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
<body>
    <?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==4){?>
	        <script>			
				swal.fire({
				text: " Bien effectué !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php }} ?>
	
	<div class="retour-musique">
	    <button><a href="administration.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
        <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	
    <div class="app__form">
	        <h3><a href="#!"><i class="fa fa-music"></i></a><br>Albums</h3>
		    <div class="form__content">
			    <div class="comments__content1">
				
					<?php while($ET=mysqli_fetch_assoc($rs)){ ?>
						
					<div class="app__profile">
						<div class="logo__cont">
							<a href="photo.php?lien=Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['COVER_ALBUM']) ?>">
								<img src="Medias/logo_album/<?php echo $ET['COVER_ALBUM'] ?>" alt="">
							</a>
						</div>
					<div class="det__down">
						<div class="name">
						
							<strong class="name_strong_botton_nom"><?php echo substr(ucfirst(strtolower($ET['TITRE_ALBUM'])),0,35);?></strong>
							<br/><br/>
							<strong class="name_strong_botton_nom"><?php echo duree($ET['DATE_ALBUM']) ?></strong>
							<br/><br/><br/>
							<strong class="name_strong_botton"><a href="supprimer_album.php?id_album=<?php echo $ET['ID_ALBUM'] ?>" class="btn_supprimer">Supprimer</a></strong>
						</div>
					</div>
					</div>
					<hr/>
					
					<?php } ?>
						
				</div>
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
		
	</script>
</body>
</html>