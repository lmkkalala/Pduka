<?php
function Term($nbre_telechargement)
{

$resultat = 0;

if(strlen($nbre_telechargement)%3 == 0)
{
$resultat = substr($nbre_telechargement, 0 , 3);
}
else
{
$resultat = substr($nbre_telechargement, 0 , strlen($nbre_telechargement)%3);
}

if(strlen($nbre_telechargement) <= 3)
{
    echo $resultat.'';
}
else
if(strlen($nbre_telechargement) > 3 && strlen($nbre_telechargement) <= 6)
{
    echo $resultat.' K';
}
else
if(strlen($nbre_telechargement) > 6 && strlen($nbre_telechargement) <= 9)
{
    echo $resultat.' M';
}

}

?>