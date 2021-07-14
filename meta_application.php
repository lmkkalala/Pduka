<?php
    echo '<meta property="og:title" content="'.substr(ucfirst($ET['NOM_APPLICATION']),0,35).'" />';
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:url" content="'.$url.'" />';
    echo '<meta property="og:description" content="'.substr(ucfirst($ET['APROPOS_APPLICATION']),0,65).'" />';
    echo '<meta property="og:image" content="Medias/logo/'.$ET['LOGO_APPLICATION'].'" />';
?>