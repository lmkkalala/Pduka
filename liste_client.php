<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
	$nombre_apk = 0;
	$nombre_game = 0;
	$nombre_client_simple = 0;
	$nombre_developpeur = 0;
	
	$nombre_signaler = 0;
	
	$req="select * from CLIENT order by ID_CLIENT desc";
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
	        <h3><a href="#!"><i class="fa fa-user"></i></a><br>Clients</h3>
		    <div class="form__content">
			    <div class="comments__content1">
				
			            <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
							
						<div class="app__profile">
                            <div class="logo__cont">
							    <a href="photo.php?lien=Medias/photo_clients/<?php echo $ET['PHOTO_CLIENT'] ?>&retour=<?php echo substr(strrchr($_SERVER['PHP_SELF'],'/'), 1); ?>&file=<?php echo ($ET['PHOTO_CLIENT']) ?>">
				                    <img src="Medias/photo_clients/<?php echo $ET['PHOTO_CLIENT'] ?>" alt="">
								</a>
                            </div>
                        <div class="det__down">
                            <div class="name">
							
					            <strong class="name_strong_botton_nom"><?php echo substr(ucfirst(strtolower($ET['NOM_CLIENT'])),0,25);?></strong>
							    <br/>
							    <strong class="name_strong_botton_nom"><?php echo substr(ucfirst(strtolower($ET['MAIL_CLIENT'])),0,25);?></strong>
							    <br/>
								<?php
								    $id_region = $ET['ID_REGION'];
									
									$req="select * from REGION where ID_REGION = $id_region ";
                                    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
									$ET1=mysqli_fetch_assoc($rs1);
								?>
								<?php if(strlen($ET1['REGION'])<=23){ ?>
                                    <strong class="name_strong_botton_nom"><?php echo ucfirst(strtolower($ET1['REGION'])); ?></strong>
					            <?php } else { ?>
						            <strong class="name_strong_botton_nom"><?php echo substr(ucfirst(strtolower($ET1['REGION'])),0,24).'...'; ?></strong>
					            <?php } ?>
								<br/><br/>
								<?php if($ET['ID_CLIENT'] == 3){ ?>
								    <strong class="name_strong_botton_nom name_strong_botton"><a href="#!" data="Impossible de supprimer l'administrateur" class="btn_message">Supprimer</a></strong>
							    <?php } else { ?>
								    <strong class="name_strong_botton_nom name_strong_botton"><a href="supprimer_client.php?id_client=<?php echo $ET['ID_CLIENT'] ?>" class="btn_supprimer">Supprimer</a></strong>
								<?php } ?>
								<?php if(!($ET['ID_CLIENT'] == 3)){ ?>
								<?php if(isset($_SESSION['NIV']) && $_SESSION['NIV'] == 0){ ?>
								    <strong class="name_strong_botton_nom name_strong_botton"><a href="rendre_admin_client.php?id_client=<?php echo $ET['ID_CLIENT'] ?>" data="<?php if($ET['NIVEAU_CLIENT'] == 0 || $ET['NIVEAU_CLIENT'] == 1){echo 'Vous voulez rétirer un admin ?'; }else{echo 'Vous voulez vraiment rendre un admin ?';}?>" class="btn_modifier"><?php if($ET['NIVEAU_CLIENT'] == 0 || $ET['NIVEAU_CLIENT'] == 1){echo 'Rétirer'; }else{echo 'Rendre';}?></a></strong>
								<?php } ?>
								<?php } ?>
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
		$('.btn_message').on('click',function(e){
			e.preventDefault();
			const data = $(this).attr('data');
			swal.fire({
				text: data,
				icon: "warning",
			})
		})
		
	</script>
</body>
</html>