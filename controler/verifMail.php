<?php 
include_once 'bdd.php';
extract($_POST);
$email = htmlspecialchars(trim($email));
$search = $bdd->prepare('SELECT email FROM user WHERE email=:email');
$search->execute(array('email'=>$email));
$result = $search->fetch();
$userEmail = $result['email'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "Ceci n'est pas une adresse mail<br />";
		exit();
	}elseif($email == $userEmail){
		echo 'Cet email est déjà utilisé !';
	}else{
		echo 'success';
	}
 ?>