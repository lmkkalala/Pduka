<?php
    session_start();
	
    require_once("protection_pages.php");
    require_once("connexion.php");

    $id_musique = htmlspecialchars(trim(addslashes($_GET['id_musique'])));
    $file = htmlspecialchars(trim(addslashes($_GET['file'])));
	
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
	<script src="sweetalert2.all.min.js"></script>
</head>
<style>
.app__form form input[type=file] {
    display: block;
}
.form__content a {
    font-size: 16px;
    color: #f7f6f4;
    margin: 15px 25px;
}
.whatsapp_boutton {
    background: linear-gradient(901deg,#00e1f0,#0077f0);
    font-family: 'Montserrat';
    padding: 10px 80px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
}
</style>
<body>
    <div class="retour-musique">
        <button><a href="musique.php?id_musique=<?php echo $id_musique ?>"><i class="fa fa-long-arrow-alt-left"></i></a></button>
        <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
    <div class="app__form">
        <h3><a href="#!"><i class="fa fa-book"></i></a><br>Achéter</h3>
        <div class="form__content">
        <!--
            <div class="add">
                <div class="info__add"><i class="fa fa-envelope"></i><input type="text" name="nom" id="" placeholder="Votre E-mail" required/></div>
            </div>
            <div class="add">
                <div class="info__add"><i class="fa fa-pencil-alt"></i><input type="text" name="apropos" id="" placeholder="Votre numéro de phone" required/></div>
            </div>
            <div class="add">
                <div class="select_info">
                <span class="add_compte">Méthodes de paiement</span>
                <select name="niveau" class="input-field" required>
                    <optgroup label="Mobile money">
                        <option value="1">Airtel money</option>
                        <option value="2">M-Pesa</option>
                    </optgroup>
                    <optgroup label="Carte banquaire">
                        <option value="3">Paypal</option>
                    </optgroup>
                </select>
                </div>
            </div>
            <br>
        -->
            <p class="ajoute_champ">Pour achéter cet instumental , veillez nous contacter en cliquant sur ce boutton ci-dessous.</p>
            <br><br>
            <a href="https://wa.me/0973458095" target="_blank" class="whatsapp_boutton"><i class="fab fa-whatsapp">Whatsapp</i></a>
        </div>
    </div>
</body>
</html>