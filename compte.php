<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$id_client = $_SESSION['ID'];

 $req="select count(*) as nombre from COMPTE_CLIENT where ID_CLIENT = $id_client ";
 $rs2=mysqli_query($conn,$req) or die(mysqli_error());
 $ET2=mysqli_fetch_assoc($rs2);
	
 $req="select * from COMPTE_CLIENT where ID_CLIENT = $id_client order by ID_COMPTE_CLIENT desc ";
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
			if(($_GET['code'])==0){?>
				<script>			
						swal.fire({
						text: "Bien effectué !",
						icon: "success",
						showConfirmButton: false,
						timer: 1500,
						});
				</script>
		<?php } } ?>
        <div class="retour-musique">
            <button><a href="plus.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
			<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
		</div>  
        <div class="app__form">
        <h3>
		    <a href="#!"><i class="fa fa-user-plus"></i></a>
		    <br>
		    <label>Mes Comptes</label>
			<br><br>
			<div class="botton_ajoute_compte">
				<?php if($ET2['nombre'] < 3){ ?>
					<a href="creer_compte.php"> Ajouter vos comptes ici</a>
					<br><br>
				<?php } ?>
			</div>
		</h3>	
	    <?php
			while($ET=mysqli_fetch_assoc($rs)){
						
			$id_categorie_client = $ET['ID_CATEGORIE_CLIENT'];
							
			$req="select * from CATEGORIE_CLIENT where ID_CATEGORIE_CLIENT = $id_categorie_client ";
		    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
			$ET1=mysqli_fetch_assoc($rs1);
							
			$page = '';
							
			if($ET1['ID_CATEGORIE_CLIENT'] == 2)
			{
				$page = 'gestion_compte_developpeur.php';
			}
			else
			if($ET1['ID_CATEGORIE_CLIENT'] == 3)
			{
				$page = 'gestion_compte_musicien.php';
			}
			else
			if($ET1['ID_CATEGORIE_CLIENT'] == 4)
			{
				$page = 'gestion_compte_musicien.php';
			}
		?>		
		
			<div class="image_compte">
                <a href="<?php echo $page ?>?id_compte_client=<?php echo ($ET['ID_COMPTE_CLIENT']) ?>">
				    <img src="Medias/photo_compte_clients/<?php echo $ET['PHOTO_COMPTE_CLIENT'] ?>" alt="" title="">
				</a>
                <a href="<?php echo $page ?>?id_compte_client=<?php echo ($ET['ID_COMPTE_CLIENT']) ?>">
				    <p class="Nom_de_compte"><?php echo substr(ucfirst(strtolower($ET['NOM_COMPTE_CLIENT'])),0,25);?></p>
				</a>
			
                <p class="nature_de_compte"><?php if($ET1['ID_CATEGORIE_CLIENT'] == 2) { echo 'Développeur';} else if($ET1['ID_CATEGORIE_CLIENT'] == 3) { echo $ET1['CATEGORIE_CLIENT'];} else if($ET1['ID_CATEGORIE_CLIENT'] == 4) { echo $ET1['CATEGORIE_CLIENT'];} ?></p>
      
				<button class="Compte_modifier"><a href="modifier_mon_compte_client.php?id_compte_client=<?php echo ($ET['ID_COMPTE_CLIENT']) ?>" class="btn_modifier">Modifier</a></button>
				
                <button class="Compte_modifier"><a href="supprimer_mon_compte_client.php?id_compte_client=<?php echo ($ET['ID_COMPTE_CLIENT']) ?>" class="btn_supprimer">Supprimer</a></button>
            </div>
            <hr>
			
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