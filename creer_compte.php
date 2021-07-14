<?php

    session_start();
	
    require_once("connexion.php");
	
	$id_client = $_SESSION['ID'];
	
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
.select_info {
    width: 290px;
    position: relative;
    margin-top: 3px;
}
</style>

<body>
   
   <?php if(isset ($_GET['code'])){ 
	   if(($_GET['code'])==1){?>
		   <script>			
				swal.fire({
				text: "Ce compte existe déjà !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
		   </script>
   <?php } else if(($_GET['code'])==2){ ?>
		   <script>			
				swal.fire({
				text: "Type de fichier non supporté !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
		   </script>
   <?php } } ?>
	<div class="retour-musique">
	<?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	    $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	?>
	    <button><a href="plus.php?condition=<?php echo $condition ?>&retour=<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php }else{ ?>
	    <button><a href="compte.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
	<?php } ?>
	<a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
    <div class="app__form">
        <h3><a href="#!"><i class="fa fa-user"><sup>+</sup></i></a><br>Créer un compte</h3>
        <div class="form__content">
            <form action="creer_comptescript.php" method="post" enctype="multipart/form-data" >
			
			    <?php if(isset($_GET['condition']) && isset($_GET['retour'])){ 
	                $condition=htmlspecialchars(trim(addslashes($_GET['condition'])));
		            $retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	            ?>
				    <input type="hidden" name="condition" id="" value="<?php echo $condition ?>">
					<input type="hidden" name="retour" id="" value="<?php echo $retour ?>">
					
				<?php } ?>
			
                <div class="add">
                    <div class="info__add"><i class="fa fa-pencil-alt"></i><input type="text" name="nom" id="" placeholder="Nom du compte" required/></div>
                </div>
				<div class="add">
                    <div class="info__add"><i class="fa fa-pencil-alt"></i><input type="text" name="apropos" id="" placeholder="A propos du compte" required/></div>
                </div>
				<!--
				<div class="add_compte_amail">
					<div class="info__add"><i class="fa fa-envelope"></i><input type="email" name="contact" id="" placeholder="E-mail" required/></div>
				</div>
				-->
				<br>
				<div class="add_musique">
					<div class="info_add_music">
					    <!--
					    <label for="pic1"><i class="fa fa-camera"></i>Photo du compte</label>
						-->
                        <i for="pic1" class="fa fa-camera" style="color:#0077f0;"></i><input id="pic1" class="Input_musique" type="file" name="photo" required/>
		            </div>
                </div>
				<div class="add">
				    
				    <div class="select_info">
					<span class="add_compte">Catégorie du compte</span>
					<select name="id_categorie_client" id="categorie_client" class="input-field" required>
		            <?php
					    $req="select * from COMPTE_CLIENT where ID_CLIENT = $id_client ";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
						
       					if($ET1=mysqli_fetch_assoc($rs1))
						{
						
						    $id_categorie = $ET1['ID_CATEGORIE_CLIENT'];
						}
						else
						{
						    $id_categorie = 0;
						}
						
						if($id_categorie == 2)
						{
						    $selection = 3;
						}
						else if($id_categorie == 3)
						{
						    $selection = 2;
						}
					    
					    $region = '';
					
					    $req="select * from CATEGORIE_CLIENT where ID_CATEGORIE_CLIENT != $id_categorie order by CATEGORIE_CLIENT ";
                        $rs=mysqli_query($conn,$req) or die(mysqli_error());
						
       					while($ET=mysqli_fetch_assoc($rs)){
						
						if($ET['ID_CATEGORIE_CLIENT'] == $selection)
						{
						    $region = 'selected';
						}
						else
						{
						    $region = '';
						}
						
						if($ET['ID_CATEGORIE_CLIENT'] != 1){
					?>
                        <option value=<?php echo ($ET['ID_CATEGORIE_CLIENT']) ?> <?php echo $region ?> ><?php echo ($ET['CATEGORIE_CLIENT']) ?></option>
		            <?php } } ?>
                    </select>
					</div>
                </div>
				<!-- Politique d'activation de la boutton téléchargement ou non
				<br>
				<div class="add">
				    
				    <div class="select_info">
					<span class="add_compte">Niveau du compte</span>
					<select name="niveau" class="input-field" required>
                        <option value="1" selected >Simple</option>
                        <option value="2" >Premium</option>
                    </select>
					</div>
                </div>
				-->
				<br>
				<p class="ajoute_champ">Veillez remplir tous les champs svp !</p>
                <button type="submit">Ajouter</button>

            </form>
        </div>

    </div>
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="sweetalert2.all.js"></script>
	<script src="sweetalert2.js"></script>
	<script src="sweetalert2.min.js"></script>
	<script src="sweetalert2.all.min.js"></script>
	<script src="Arlets.js"></script>
</body>
</html>