<?php
    session_start();
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client = $_SESSION['ID'];
	
	$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
	$retour=htmlspecialchars(trim(addslashes($_GET['retour'])));
	
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
</head>
<body>
    <div class="retour-musique">
	    <button><a href="application.php?id_application=<?php echo $id_application ?>&retour=<?php echo $retour ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
        <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
	
    <div class="app__form">
		<h3><a href="#!"><i class="fa fa-exclamation-triangle"></i></a><br>Signaler</h3>
		<div class="form__content">
			<form action="signalerscript.php?id_application=<?php echo $id_application ?>" method="post" enctype="multipart/form-data" >
                
				    <center><span class="form_lab"><i class="fa fa-choice">Contenu</i></span></center>
				    <br/><br/>
					<center>
				        <input type="radio" name="signaler" value="Contenu choquant" id="a1" selected /><span class="f-15" for="a1"> choquant</span>
					
                        <input type="radio" name="signaler" value="Contenu non approprie" id="a2" /><span class="f-15" for="a2"> non approprié</span>
				    </center>
					<br><br>
					
                <button type="submit">Valider</button>
				
            </form>    
        </div>
    </div>
</body>
</html>