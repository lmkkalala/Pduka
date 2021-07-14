<?php

require_once("connexion.php");

$mail = htmlspecialchars(trim(addslashes($_POST['mail'])));
$pass = htmlspecialchars(trim(addslashes($_POST['pass'])));

$pass = md5($pass);

$req="select * from CLIENT where MAIL_CLIENT = '$mail'";
$rs=mysqli_query($conn,$req) or die(mysqli_error());

if($u=mysqli_fetch_assoc($rs))
{
  if ($u['PASSE_CLIENT'] != $pass) {
      header("location:index1.php?code=2&deconnexion=0"); 
  }else{
      header("location:accueil.php");
      
      session_start();
      
      $_SESSION['NIV'] = $u['NIVEAU_CLIENT'];
      $_SESSION['NOM'] = $u['NOM_CLIENT'];
      $_SESSION['ID_REGION'] = $u['ID_REGION'];
      $_SESSION['ID'] = $u['ID_CLIENT'];
    
      setcookie('mail', $mail , time() + 365*24*3600, null, null, false, true);
      setcookie('pass', $pass , time() + 365*24*3600, null, null, false, true); 
  }
  
}else{
  header("location:index1.php?code=1&deconnexion=0");  
}

mysqli_free_result($rs);
mysqli_close($conn);
?>