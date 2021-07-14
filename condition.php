<?php
    session_start();
	
    require_once("protection_pages.php");
    require_once("connexion.php");
	
    $id_client = $_SESSION['ID'];

    require_once("client_connecter.php");
	
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
        <button><a href="plus.php"><i class="fa fa-long-arrow-alt-left"></i></a></button>
        <a href="accueil.php"><i class="home-return fa fa-home"></i></a>
    </div>
    <div class="app__form">
		<div class="form__content">
			<strong><h3>CONDITIONS</h3></strong>

            <div class="condition">
                <p style="padding: 10px;font-family: 'Montserrat';font-size: 12px;">
                    PDUKA c'est une plate-forme de téléchargement des musiques et applications 
                    envue de promouvoir les artistes et les codeurs 
                    en les rapprochant de leur public.
                    La plate-forme DIOBASS, PFD en sigle se située au numéro 317 de 
                    l’avenue Patrice Emery LUMUMBA à BUKAVU, elle est un espace pour 
                    la recherche paysanne et le renforcement des dynamique locales. 
                    Le vocable « Diobass », est l’appellation d’un site représentant 
                    un bassin agricole, dans la région entre les villes de Dakar et de 
                    Thiès au Sénégal. Cette appellation fut appréciée et adoptée par 
                    l’agronome belge H. DUPRIEZ qui fut émerveillé par les méthodes 
                    et techniques de travail des habitants de Diobass dans la manière 
                    de chercher de solution au problème de leur vie. Par souci 
                    d’approfondir cette approche de travail, il créa 
                    l’organisation DES située à Nivelles en Belgique. 
                    La PFD est donc un réseau d’organisations paysannes, 
                    des groupes de recherche paysanne, d’ONG, d’institutions 
                    d’enseignement, des centres de recherche et des personnes ressources, 
                    désireux de développer ensemble une démarche d’action a fortement inspirée 
                    des nombreuses organisations paysannes, désireux de développer 
                    ensemble une démarche d’action : la démarche DIOBASS. Depuis 1994, 
                    cette démarche d’action a fortement inspirée des nombreuses 
                    organisations paysannes et d’organisations d’appui pour l’analyse, 
                    l’élaboration des programmes d’activités, 
                    les démarches d’autoévaluation et de suivi des programmes, etc. 
                    La PFD est donc un réseau d’organisations paysannes, 
                    des groupes de recherche paysanne, d’ONG, d’institutions 
                    d’enseignement, des centres de recherche et des personnes ressources, 
                    désireux de développer ensemble une démarche d’action a fortement inspirée 
                    des nombreuses organisations paysannes, désireux de développer 
                    ensemble une démarche d’action : la démarche DIOBASS. Depuis 1994, 
                    cette démarche d’action a fortement inspirée des nombreuses 
                    organisations paysannes et d’organisations d’appui pour l’analyse, 
                    l’élaboration des programmes d’activités, 
                    les démarches d’autoévaluation et de suivi des programmes, etc. 
                </p>
            </div>
            			
	    </div>    
    </div>
</body>
</html>