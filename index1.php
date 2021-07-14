<?php
  require_once("connexion.php");

  $mail = null;
	$pass = null;
  
  if((isset($_COOKIE['mail']) and isset($_COOKIE['pass'])) and !isset($_GET['deconnexion']))
  {
  
    $mail = htmlspecialchars(trim(addslashes($_COOKIE['mail'])));
    $pass = htmlspecialchars(trim(addslashes($_COOKIE['pass'])));

    include("seconnecter_directescript.php");
    exit;
	
  }
  else if((!isset($_COOKIE['mail']) and !isset($_COOKIE['pass'])) and isset($_GET['deconnexion']))
  {
  
    $mail = null;
	  $pass = null;
	
  }
  else if((!isset($_COOKIE['mail']) and !isset($_COOKIE['pass'])) and !isset($_GET['deconnexion']))
  {
    session_start();
	
    $_SESSION['ID'] = 0;
	
    include("capture_ip_clientscript.php");

    header("location:accueil.php");
    exit;
	
  }
  
	
  $req="select * from REGION ";
  $rs=mysqli_query($conn,$req) or die(mysqli_error());
  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pduka</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
	  <link rel="shortcut icon" href="Medias/photo_site/icone.png">

</head>

<style>
.hero input[type=file] {
    display: block;
}
.form-box {
    top: 157px;
}
</style>

<body>
	
  <div class="hero">
    
    <div class="form-box">
        
    <a href="index1.php"><i class="fa fa-home"> </i>Accueil</a>

      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">Login</button>
        <button type="button" class="toggle-btn" onclick="register()">S'inscrire</button>
      </div>
	  
      <form method="post" action="seconnecterscript.php" id="login" class="input-group">
	  
        <input type="text" name="mail" value="<?php echo $mail ?>" id="" class="input-field" placeholder="E-mail" required/>
        <input type="password" name="pass" value="<?php echo $pass ?>" id="" class="input-field" placeholder="Mot de Passe" required/>
        <button type="submit" name="connex" class="btn_valides submit-btn">Se connecter</button>
        
      </form>

      <form action="inscriptionscript.php" method="post" id="register" enctype="multipart/form-data" class="input-group">
	  
        <input type="text" name="nom" id="nom" class="input-field" placeholder="Nom et Post-nom" required/>
        
        <input type="email" name="mail" id="mail" class="input-field" placeholder="E-mail" required/>
        
        <input type="password" name="pass" id="pass" class="input-field" placeholder="Mot de passe" required/>
		    
        <div id="erreur" style="font-size: 12px; color: blue; display: none;"><i class="fa fa-exclamation-triangle"></i> Mettez au moins 4 caractères</div>
        
		    <select name="id_region" id="ville" class="input-field" required>
          <option value="16" selected>Pays</option>
          <?php while($ET=mysqli_fetch_assoc($rs)){ ?>
            <option value="<?php echo ($ET['ID_REGION']) ?>"><?php echo ($ET['REGION']) ?></option>
          <?php } ?>
        </select>
        
        <!--
		    <label for="pic1" style="font-size: 12px;"><strong>Photo de profil <i class="fa fa-camera"></i></strong></label>
        -->
        <input id="pic1" type="file" name="photo" class="input-field" />

        
			<p class="ajoute_champ_index ajoute_champ">Veillez remplir tous les champs svp !</p>
		
        <button type="submit" id="registeradd" class="btn_valides submit-btn" id="register">Envoyer</button>
        
      </form>

    </div>
    
  </div>
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
<script src="tester_input.js"></script>

<script src="sweetalert2.all.js"></script>
<script src="sweetalert2.js"></script>
<script src="sweetalert2.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script>

var x =document.getElementById("login");
var y =document.getElementById("register");
var z =document.getElementById("btn");

function register(){
  x.style.left="-450px";
  y.style.left="50px";
  z.style.left="100px";  
}
function login(){
  x.style.left="50px";
  y.style.left="450px";
  z.style.left="0px";  
}

</script>
</body>
</html>
<?php
include('message_de_confirmation.php');
?>