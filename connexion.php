<?php

//$conn = mysqli_connect("localhost","root","") or die(mysqli_error());
//mysqli_select_db($conn ,"bd_pstore") or die(mysqli_error());

$conn = new mysqli('localhost','root','','bd_pstore') or die("Pas de connexion !!!".mysqli_error($conn));

?>