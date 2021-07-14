<?php

function duree($time_bd)
{
	date_default_timezone_set('Europe/Paris');

    $duree = time() - strtotime($time_bd);
	
	$heure = floor($duree / 3600);
	$min = floor(($duree % 3600) / 60);
	$sec = floor($duree % 60);
	
	if($heure==0 && $min == 0)if($sec>1){echo 'il y a '.$sec.' secs';}else{echo 'il y a '.$sec.' sec';}
	
	if($heure==0 && $min > 0)if($min>1){echo 'il y a '.$min.' mins';}else{echo 'il y a '.$min.' min';}
	
	if($heure > 0 && $heure < 24)if($heure>1){echo 'il y a '.$heure.' heures';}else{echo 'il y a '.$heure.' heure';}
	
	if($heure >= 24)
	{
	    $jour = floor($heure / 24);
		if($jour <=30)
		{
		    if($jour>1){echo 'il y a '.$jour.' jours';}else{echo 'il y a '.$jour.' jour';}
		}
		else
		{
		    $mois = floor($jour / 30);
			if($mois <=12)
			{
		        echo 'il y a '.$mois.' mois';
			}
		    else
		    {
		        $annee = floor($mois / 12);
		        if($annee>1){echo 'il y a '.$annee.' annees';}else{echo 'il y a '.$annee.' annee';}
		    }
		}
	}

}

?>