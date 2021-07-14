<?php

  date_default_timezone_set('Europe/Paris');

  $temps = time();

  $req="select COUNT(*) AS nbre_entrees from CLIENT_CONNECTER where ID_CLIENT = $id_client ";
  $rs=mysqli_query($conn,$req) or die(mysqli_error());
  $ET=mysqli_fetch_assoc($rs);

  if ($ET['nbre_entrees'] == 0)
  {
    $req="insert into CLIENT_CONNECTER(TEMPS,ID_CLIENT) values ($temps,$id_client)";
    mysqli_query($conn,$req) or die(mysqli_error());
  }
  else
  {
    $req="update CLIENT_CONNECTER set TEMPS = $temps where ID_CLIENT = $id_client";
    mysqli_query($conn,$req) or die(mysqli_error());
  }

    $timestamp_5min = $temps - (60 * 5);

    $req="delete from CLIENT_CONNECTER where TEMPS < '$timestamp_5min' ";
    $rs=mysqli_query($conn,$req) or die(mysqli_error());

?>