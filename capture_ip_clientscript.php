<?php
	
    $ip_client = $_SERVER['REMOTE_ADDR'] ;
	
    $req="select * from CLIENT_NON_INSCRIT where IP = '$id_client' ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

    if(!$u=mysqli_fetch_assoc($rs))
    {
        $req="insert into CLIENT_NON_INSCRIT(ID_CLIENT_NON_INSCRIT,IP) values ('','$id_client')";
        mysqli_query($conn,$req) or die(mysqli_error());
    }
	
?>