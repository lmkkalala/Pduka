<?php

    session_start();
	
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $req="select * from CLIENT_CONNECTER order by TEMPS desc";
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
</head>
<body>
    <div class="detail__container">
	
		<a href="administration.php"><i class="fa fa-long-arrow-alt-left">Retour</i></a>
		
        <div class="app__form">
		    <h3><a href="#!"><i class="fa fa-download"></i></a><br>En ligne</h3>
		    <div class="form__content">
			    
			    <ul>
				    <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
					    <?php
						    $id_client = $ET['ID_CLIENT'];
					        $req="select * from CLIENT where ID_CLIENT = $id_client ";
                            $rs=mysqli_query($conn,$req) or die(mysqli_error());
	                        $ET1=mysqli_fetch_assoc($rs);
						?>
						<h4>
							<img src="Medias/photo_clients/<?php echo $ET1['PHOTO_CLIENT'] ?>" alt="Profil" title="" class="photo_commentaire">
							<?php echo $ET1['NOM_CLIENT'] ?>
						</h4>
                        <hr>
					<?php } ?>
                </ul>
			
			</div>    
        </div>
    </div>
</body>
</html>