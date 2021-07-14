<?php
    session_start();
    require_once("connexion.php");
	
	$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
	$id_album = htmlspecialchars(trim(addslashes($_GET['id_album'])));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <title>Pduka</title>
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
    <script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
    <script src="sweetalert2.all.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<style>
    .app__form form input[type=file] {
    display: block;
}
</style>

<body>
   
	<?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==1){?>
	        <script>			
				swal.fire({
				text: " Ce nom existe déjà , veillez saisir un autre nom !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
	<?php } else if(($_GET['code'])==0){ ?>
	        <script>			
				swal.fire({
				text: " Vérifier le type de votre fichier musique !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
	<?php } } ?>
	
	<div class="retour-musique">
	<?php if(isset($_GET['condition']) && isset($_GET['retour']) && isset($_GET['id_musique'])){ 
	    $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	?>
	    <button><a href="mon_album.php?id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>&condition=<?php echo $condition ?>&id_musique=<?php echo $id_musique ?>&retour=<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php }else{ ?>
	    <button><a href="mon_album.php?id_album=<?php echo $id_album ?>&id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php } ?>
	<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	
        <div class="app__form">
			<div class="detail_box">
			<h3><a href="#!"><i class="fa fa-music">+</i></a><br>Ajouter une chanson</h3>
			</div>
        <form action="ajoutermusique_albumscript.php" method="post" enctype="multipart/form-data" >
			
			    <?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	                $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		            $retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	            ?>
				    <input type="hidden" name="condition" id="" value="<?php echo $condition ?>">
					<input type="hidden" name="retour" id="" value="<?php echo $retour ?>">
					
				<?php } ?>
			        <input type="hidden" name="id_compte_client" id="" value="<?php echo $id_compte_client ?>">
					<input type="hidden" name="id_album" id="" value="<?php echo $id_album ?>">
            <div class="add_musique">
                <div class="info_add_music"><i class="fa fa-pencil-alt"></i><input type="text" name="titre" id="" placeholder="Titre de la Chanson" required/></div>
            </div>
            <div class="add_musique">
                <div class="select_info">
                    <select name="id_categorie_musique" id="ville" class="input-field" required>
                    <option value="1" selected>Catégorie</option>
		            <?php
					    $req="select * from CATEGORIE_MUSIQUE ";
                        $rs=mysqli_query($conn,$req) or die(mysqli_error());
						
       					while($ET=mysqli_fetch_assoc($rs)){ 
					?>
                        <option value="<?php echo ($ET['ID_CATEGORIE_MUSIQUE']) ?>"><?php echo ($ET['CATEGORIE_MUSIQUE']) ?></option>
		            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="add_musique">
                <div class="info_add_music"><i class="fa fa-music"></i><input class="Input_musique" type="file" name="musique" id="apk" required/></div>
            </div>
			<p class="ajoute_champ">Veillez remplir tous les champs svp !</p>
			
			<button type="submit" class="ajoute_box">Ajouter</button>
           
        </form>
 
    </body>

</html>