<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
	$req="select * from APPLICATION order by ID_APPLICATION desc";
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
		<a href="accueil.php"><i class="color-profil home-return fa fa-home"></i></a>
	</div>
	
    <div class="app__form">
	        <h3><a href="#!"><i class="fa fa-gamepad"></i></a><br>Applications</h3>
		    <div class="form__content">
			    <div class="comments__content1">
				
			        <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
				        <div class="app__profile">
                            <div class="logo__cont">
							    <a href="photo.php?lien=Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['LOGO_APPLICATION']) ?>">
				                    <img src="Medias/logo/<?php echo $ET['LOGO_APPLICATION'] ?>" alt="">
								</a>
                            </div>
                        <div class="det__down">
                            <div class="name">
							
					            <strong class="name_strong"><?php echo substr(ucfirst(strtolower($ET['NOM_APPLICATION'])),0,25);?></strong>
							    <br/><br/>
							    <strong class="name_strong_appli"><?php echo $ET['CATEGORIE_APPLICATION'] ?></strong>
							    <br/><br/>
								<strong class="name_strong_botton"><a href="administration_application.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>">Statistique</a></strong>
								<br/><br/>
								<?php if($ET['VISIBILITE_APPLICATION'] == 1){ ?>
							    <strong class="name_strong_botton"><a href="bloquer.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>&valeur=0" data="Vous voulez vraiment bloquer ?" class="btn_modifier">Bloquer</a></strong>
								<?php } else { ?>
								<strong class="name_strong_botton"><a href="bloquer.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>&valeur=1" data="Vous voulez vraiment debloquer ?" class="btn_modifier">Debloquer</a></strong>
								<?php } ?>
								<strong class="name_strong_botton"><a href="supprimer_application.php?id_application=<?php echo $ET['ID_APPLICATION'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>" class="btn_supprimer">Supprimer</a></strong>
							    
                            </div>
                        </div>
                        </div>
						<br/>
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