<?php
session_start();
require_once("connexion.php");

$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));

 $req="select count(*) as nombre from CAPTURE where ID_APPLICATION = $id_application ";
 $rs2=mysqli_query($conn,$req) or die(mysqli_error());
 $ET2=mysqli_fetch_assoc($rs2);

 if($ET2['nombre'] >= 3)
 {
    header("location:application.php?id_application=$id_application");
	exit;
 }
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
    <div class="retour-musique">
    <a href="application.php?id_application=<?php echo $id_application ?>">
    <button><i class="fa fa-long-arrow-alt-left"></i></button>
	</a>
	<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	<?php if(isset ($_GET['code'])){ 
		if(($_GET['code'])==0){ ?>
	        <script>			
				swal.fire({
				text: " Bien enregistré !",
				icon: "success",
				showConfirmButton: false,
				timer: 1500,
				});
	        </script>
	<?php } else if(($_GET['code'])==1){ ?>
	        <script>			
				swal.fire({
				text: " Type de fichier non supporté !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
	<?php } } ?>
    
    <div class="app__form">
        <h3><a href="#!"><i class="fa fa-image"></i></a><br>Ajouter une capture</h3>
        <br/>
        <div class="form__content">
		    
            <form action="ajouter_capture_applicationscript.php?id_application=<?php echo $id_application ?>" method="post" enctype="multipart/form-data" >
			    <div class="add">
                    <div class="info__add"><label for="captures"> <?php echo 'Vous avez déjà ajouté '. $ET2['nombre']; ?> capture<?php if($ET2['nombre'] > 1){ ?>s<?php } ?></label></div>
                </div>
                <br/>
				<div class="add">
                    <div class="info__add"><i class="fa fa-camera"></i><input type="file" name="capture" id="captures" placeholder="" required/></div>
                </div>
                <button type="submit">Ajouter</button>

            </form>
        </div>

    </div>

</body>
</html>