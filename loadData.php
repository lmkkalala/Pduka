<?php
session_start();
require_once("protection_pages.php");
require_once("connexion.php");

    $id_client = $_SESSION['ID'];

    if (isset($_GET['id_musique']) and !empty($_GET['id_musique'])) {
        $id_musique = $_GET['id_musique'];
        $select_musique = mysqli_query($conn,"SELECT * FROM MUSIQUE INNER JOIN COMPTE_CLIENT ON COMPTE_CLIENT.ID_COMPTE_CLIENT=MUSIQUE.ID_COMPTE_CLIENT WHERE ID_MUSIQUE='$id_musique'");
        $select_commentaire = mysqli_query($conn,"SELECT * FROM COMMENTAIRE_MUSIQUE INNER JOIN CLIENT ON CLIENT.ID_CLIENT = COMMENTAIRE_MUSIQUE.ID_CLIENT WHERE ID_MUSIQUE='$id_musique'");
        $count_rows = mysqli_num_rows($select_commentaire);
        if ($count_rows == 0) {
           $COMMENTAIRE_MUSIQUE = array('COMMENTAIRE_MUSIQUE'=>'');
           $NOM_CLIENT =  array('NOM_CLIENT'=>'');         
           $PHOTO_CLIENT =  array('PHOTO_CLIENT'=>'');  
        }
        

        $select_nombre_ecouter = mysqli_query($conn,"SELECT * FROM nombre_ecouter_musique WHERE ID_MUSIQUE='$id_musique'");
        $nombre_value_ecouter = mysqli_fetch_assoc($select_nombre_ecouter);
        $select_nombre_partager = mysqli_query($conn,"SELECT * FROM nombre_partager_musique WHERE ID_MUSIQUE='$id_musique'");
        $nombre_value_partager = mysqli_fetch_assoc($select_nombre_partager);
        $select_nombre_telecharger = mysqli_query($conn,"SELECT * FROM nombre_telechargement_musique WHERE ID_MUSIQUE='$id_musique'");
        $nombre_value_telecharger = mysqli_fetch_assoc($select_nombre_telecharger);
        $select_nombre_vue = mysqli_query($conn,"SELECT * FROM nombre_vues_musique WHERE ID_MUSIQUE='$id_musique'");
        $nombre_value_vue = mysqli_fetch_assoc($select_nombre_vue);
        $select_nombre_like = mysqli_query($conn,"SELECT count(*) as nombre FROM AIMER_MUSIQUE WHERE ID_MUSIQUE = '$id_musique'");
        $nombre_value_like = mysqli_fetch_assoc($select_nombre_like);

        $musique_value = mysqli_fetch_assoc($select_musique);

        $count = 0;

        while ($commentarie_value = mysqli_fetch_assoc($select_commentaire)) {
                $COMMENTAIRE_MUSIQUE[$count] = array('COMMENTAIRE_MUSIQUE'=>$commentarie_value['COMMENTAIRE_MUSIQUE']);
                $NOM_CLIENT[$count] = array('NOM_CLIENT'=>$commentarie_value['NOM_CLIENT']);
            if ($commentarie_value['PHOTO_CLIENT'] == null) {
                $PHOTO_CLIENT = array('PHOTO_CLIENT'=>'');
            }else{
            $PHOTO_CLIENT[$count] = array('PHOTO_CLIENT'=>'Medias/photo_clients/'.$commentarie_value['PHOTO_CLIENT']);
            }
        $count ++;
        }

        $taille_musique = 'Medias/musique/'.$musique_value['MUSIQUE'];
        $ID_COMPTE_CLIENT = $musique_value['ID_COMPTE_CLIENT'];

        if ($ID_COMPTE_CLIENT == 0 or $ID_COMPTE_CLIENT == null) {
          $nombre_abonner = '';
          $ID_COMPTE_CLIENT = 0;
        }else{
            $rs20=mysqli_query($conn,"SELECT count(*) as nombre FROM ABONNER_COMPTE WHERE ID_COMPTE_CLIENT = $ID_COMPTE_CLIENT") or die(mysqli_error());
            $ET20=mysqli_fetch_assoc($rs20);
            $abonne = ' Abonné';
            $nombre = $ET20['nombre'] + 0;
            $nombre_abonner = $nombre.$abonne;
            if($ET20['nombre'] + 0 > 1) $nombre_abonner = $nombre.$abonne.'s';
        }

        $id_album = $musique_value['ID_ALBUM'];

        if($id_album == 0){
           $ET3 = ''; 
        }else{
            $rs3=mysqli_query($conn,"SELECT * from ALBUM where ID_ALBUM = $id_album") or die(mysqli_error());
            $ET3=mysqli_fetch_assoc($rs3); 
        }

        $dossier = '';
				
        if($musique_value['ID_ALBUM'] == 0)
        {
            $dossier = 'logo_musique';
        }
        else
        {
        	$dossier = 'logo_album';
        }

        $req="select * from COMPTE_CLIENT where ID_COMPTE_CLIENT = $ID_COMPTE_CLIENT ";
        $rs=mysqli_query($conn,$req) or die(mysqli_error());
        $ET=mysqli_fetch_assoc($rs);

        $req="select * from ACTIVER_TELECHARGEMENT where ID_MUSIQUE = $id_musique ";
        $rs1=mysqli_query($conn,$req) or die(mysqli_error());
        $ET1=mysqli_fetch_assoc($rs1);

        $prix = '';

        if ($musique_value['PRIX_MUSIQUE'] > 0) 
        {
            $prix = '<i class="fa fa-money-bill"></i> <span style=" color: #f4e195; font-size: 15px;">'.$musique_value['PRIX_MUSIQUE'].' Fc</span>';
        }
        else
        {
            $prix = '';
        }

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')
        {
            $url="https";
        }
        else
        {
            $url="http";
        }

        $url .="://".$_SERVER['HTTP_HOST'].'/musique.php?id_musique='.$musique_value['ID_MUSIQUE'];

        $table = array(
            'ID_MUSIQUE' => $musique_value['ID_MUSIQUE'],
            'TITRE_MUSIQUE' => $musique_value['TITRE_MUSIQUE'],
            'PRIX_MUSIQUE' => $prix,
            'LIEN' => $url,
            'LOGO_MUSIQUE' => 'Medias/'.$dossier.'/'.$musique_value['LOGO_MUSIQUE'],
            'MUSIQUE' => $musique_value['MUSIQUE'],
            'ACTIVER_TELECHARGEMENT' => $ET1['ACTIVER_TELECHARGEMENT'],
            'ID_COMPTE_CLIENT' => $musique_value['ID_COMPTE_CLIENT'],
            'NIVEAU_COMPTE_CLIENT' => $ET['NIVEAU_COMPTE_CLIENT'],
            'ID_CATEGORIE_CLIENT' => $ET['ID_CATEGORIE_CLIENT'],
            'PHOTO_COMPTE_CLIENT' => 'Medias/photo_compte_clients/'.$musique_value['PHOTO_COMPTE_CLIENT'],
            'NOM_COMPTE_CLIENT' => substr(ucfirst(strtolower($musique_value['NOM_COMPTE_CLIENT'])),0,18),
            'NOM_ARTISTE' => $musique_value['NOM_ARTISTE'],
            'COMMENTAIRE_MUSIQUE' => $COMMENTAIRE_MUSIQUE,
            'NOM_CLIENT' => $NOM_CLIENT,
            'PHOTO_CLIENT' => $PHOTO_CLIENT,
            'TAILLE_MUSIQUE' => '<strong><i>'.round((filesize($taille_musique)/(1024*1024)),2).' Mo | '.pathinfo($musique_value['MUSIQUE'],PATHINFO_EXTENSION).'</span></i></strong>',
            'NOMBRE_ECOUTER_MUSIQUE' => $nombre_value_ecouter['NOMBRE_ECOUTER_MUSIQUE'],
            'NOMBRE_PARTAGER_MUSIQUE' => $nombre_value_partager['NOMBRE_PARTAGER_MUSIQUE'],
            'NOMBRE_TELECHAGER_MUSIQUE' => $nombre_value_telecharger['NOMBRE_TELECHARGEMENT_MUSIQUE'],
            'NOMBRE_VUES_MUSIQUE' => $nombre_value_vue['NOMBRE_VUES_MUSIQUE'],
            'NOMBRE_LIKES' => $nombre_value_like['nombre'],
            'nombre_commentaire'=>$count_rows,
            'ABONNER_COMPTE' => $nombre_abonner,
        );
        echo json_encode($table);

    }else{
        $table = array('status' => 'No Data');
        echo json_encode($table);
    }
?>