<?php

session_start();

require_once("protection_pages.php");
require_once("connexion.php");

$id_client = $_SESSION['ID'];
	
$id_compte_client = htmlspecialchars(trim(addslashes($_GET['id_compte_client'])));
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
</head>
<body>
    <div class="retour">
	    <button><a href="compte.php"><i class="fa fa-long-arrow-alt-left"> Retour</i></a></button>
	</div>
    <div class="detail__container">
            <div class="about__app">
                <div class="comments">
					<a href="ajouterboutique.php?id_compte_client=<?php echo $id_compte_client ?>"><i class="fa fa-music"><sup>+</sup></i> Ajouter une application</a>
                    <h2><i class="fa fa-comments"> Mes boutiques</i></h2>
                    <div class="comments__content">
					
					<?php
					    $req="select * from BOUTIQUE where ID_COMPTE_CLIENT = $id_compte_client ";
                        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
						
					    while($ET1=mysqli_fetch_assoc($rs1)){
					?>
					    <div class="comment__details">
                            <h4>
							<a href="#!">
							
							    <img src="Medias/logo/<?php echo $ET1['LOGO_BOUTIQUE'] ?>" alt="" title="" class="photo_commentaire">
								<?php echo $ET1['NOM_BOUTIQUE'];?>
								<br/>
								<a href="supprimer_ma_boutique.php?id_boutique=<?php echo ($ET1['ID_BOUTIQUE']) ?>&id_compte_client=<?php echo $id_compte_client ?>" onclick="return confirm('Vous voulez supprimer ?');"> Supprimer</a>
								
							</a>
							</h4>
                        </div>
					<?php } ?>
					</div>
                </div>
            </div>
</body>
</html>