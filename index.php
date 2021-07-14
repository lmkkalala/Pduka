<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Refresh" content="5;URL=index1.php">
    <meta property="og:description" content="Pduka c'est une plate-forme de téléchargement des musiques et applications envue de promouvoir les artistes et les codeurs en les rapprochant de leur public." />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <title>Pduka</title>
	<link rel="shortcut icon" href="Medias/photo_site/icone.png">
</head>

<body>
    <div class="index">
	
        <div class="form__content">
            <img src="Medias/photo_site/icone.png" class="index_logo"> 
        </div>
		
    </div>
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
<script>

$(document).ready(function(){
	
	$('img').animate({
        border: '10px solid red',
        boxShadow: '2px 10px -10px #75757586'
    }, {
        duration : 2000,
        easing : 'linear'
    });
});	
	
    function charge() 
    {
        document.location.href="index1.php";
    }
    setTimeout('charge()',3000);
</script>
</body>
</html>