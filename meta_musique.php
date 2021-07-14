<?php
    echo '<meta property="og:title" content="'.substr(ucfirst($ET['TITRE_MUSIQUE']),0,35).'" />';
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:url" content="'.$url.'" />';
    echo '<meta property="og:description" content="'.substr(ucfirst($ET['TITRE_MUSIQUE']),0,65).'" />';
    echo '<meta property="og:image" content="Medias/'.$dossier.'/'.$ET['LOGO_MUSIQUE'].'" />';
?>