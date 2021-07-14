<?php

session_start();
session_unset();
session_destroy();

setcookie('mail', NULL , -1, null, null, false, true);
setcookie('pass', NULL , -1, null, null, false, true);
	
header("location:index1.php?deconnexion=0");

?>