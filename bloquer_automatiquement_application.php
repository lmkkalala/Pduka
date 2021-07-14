<?php 
    $req="select count(*) as nombre_signaler from SIGNALER where ID_APPLICATION = $id_application ";
    $rs1=mysqli_query($conn,$req) or die(mysqli_error());
    $u1=mysqli_fetch_assoc($rs1);
	
	$nombre_signaler = $u1['nombre_signaler'];
	
	$req="select count(*) as nombre_client from CLIENT ";
    $rs2=mysqli_query($conn,$req) or die(mysqli_error());
    $u2=mysqli_fetch_assoc($rs2);
	
	$nombre_client = $u2['nombre_client'];
	
	$vingt_pourcant_de_nombre_client = ( $nombre_client * 20 )/100;
	
	if($nombre_signaler >= $vingt_pourcant_de_nombre_client)
    {
        $req="update APPLICATION set VISIBILITE_APPLICATION = 0  where ID_APPLICATION = $id_application";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
    mysqli_free_result($rs1);
    mysqli_free_result($rs2);	
?>