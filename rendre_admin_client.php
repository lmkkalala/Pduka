<?php
session_start();
require_once("connexion.php");

$id_client=htmlspecialchars(trim(addslashes($_GET['id_client'])));

$req="select * from CLIENT where ID_CLIENT = $id_client ";
$rs=mysqli_query($conn,$req) or die(mysqli_error());
$ET=mysqli_fetch_assoc($rs);

if($ET['NIVEAU_CLIENT'] == 1)
{
   $req="update CLIENT set NIVEAU_CLIENT = 2 where ID_CLIENT = $id_client";
   mysqli_query($conn,$req) or die(mysqli_error());
}
else
{
   $req="update CLIENT set NIVEAU_CLIENT = 1 where ID_CLIENT = $id_client";
   mysqli_query($conn,$req) or die(mysqli_error());
}
   
header("location:liste_client.php");
   
mysqli_close($conn);
?>