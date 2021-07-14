<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client = $_SESSION['ID'];
	
	require_once("client_connecter.php");
	
    $req="select * from CLIENT where ID_CLIENT = $id_client ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());
	$ET1=mysqli_fetch_assoc($rs);
	
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
	<div class="retour-musique">
		<?php if(isset($_GET['retour'])){ 
			$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));  
		?>
			<button><a href="<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php } else { ?>
			<button><a href="accueil.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
		<?php }	?>
		<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
	</div>
    <div class="detail__container">
	    <div class="musique_page">
		<br>
            <div class="app__form">
		        <h3><a href="#!"><i class="fa fa-cog"></i></a><br>Paramètre</h3>
		        <div class="form__content">
			    <ul>
				
				    <li><h4><a href="apropos.php"><i class="fa fa-file"></i> A propos</a></h4></li>
                    <hr>

					<li><h4><a href="condition.php"><i class="fa fa-file"></i> Conditions de confidentialité</a></h4></li>
                    <hr>
					
			    <?php if($id_client == 0){?>
				
				    <li><h4><a href="index1.php?deconnexion=0"><i class="fa fa-power-off"></i> Se connecter/s'inscrire</a></h4></li>
                    <hr>
				
			    <?php }else {?>
					
					<li><h4><a href="compte.php"><i class="fa fa-users"></i> Gestion compte</a></h4></li>
                    <hr>
					
					<li><h4><a href="profil.php"><i class="fa fa-user"></i> Mon profil</a></h4></li>
                    <hr>
					
					<?php if(!($ET1['ID_CLIENT'] == 3)){ ?>
                    <li><h4><a href="supprimer_mon_compte.php" class="btn_supprimer"><i class="fa fa-trash"></i> Supprimer mon profil</a></h4></li>
                    <hr>
					<?php } ?>

					<?php if(isset($_SESSION['NIV']) && ( $_SESSION['NIV'] == 0 || $ET1['NIVEAU_CLIENT'] == 1) ){ ?>
					
					<li><h4><a href="administration.php"><i class="fa fa-cogs"></i> Administration</a></h4></li>
                    <hr>
					
					<?php } ?>
					
                    <li><h4><a href="deconnexion.php" class="alert_quitter"><i class="fa fa-power-off"></i> Déconnexion<br/>(<strong><?php echo $ET1['NOM_CLIENT'] ?></strong>)</a></h4></li>
                
				<?php } ?>
				</ul>
						
			</div>
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