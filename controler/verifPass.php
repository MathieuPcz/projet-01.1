<?php 
include_once 'bdd.php';
extract($_POST);
$password = htmlspecialchars(trim($password));
$repass = htmlspecialchars(trim($repass));

if($password == $repass){

	echo 'success';
}else{
	echo 'Les mots de passe sont différents !';
}
 ?>