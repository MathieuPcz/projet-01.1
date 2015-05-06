<?php 

include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);
extract($_POST);

$name = htmlspecialchars(trim($name));
$firstname = htmlspecialchars(trim($firstname));
$city = htmlspecialchars(lcfirst($city));
$email = htmlspecialchars(trim($email));

if(!empty($name) && !empty($firstname) && !empty($city) && !empty($email) && !empty($password)){
		if(strlen($name)<3){
			echo 'Votre nom doit contenir 3 caractères au minimum ! ';
			exit();
	}else if(strlen($firstname)<3){
		echo 'Votre prénom doit contenir 3 caractères au minimum ! ';
		exit();
	}elseif (strlen($city)<3) {
		echo 'Votre ville doit contenir 3 caractères au minimum ! ';
		exit();
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Ceci n\'est pas une adresse email valide !';
		exit();
	}elseif (strlen($password)<4) {
		echo 'Votre mot de passe doit être composé de 4 caractères !';
		exit();
	}else{
		
		$email_bdd = $user->verifMail();

		if($email == $email_bdd){
			echo 'Cet email est déjà utilisé';
		}else{
				$ville = $user->verifCity($city);
			if($ville ==$city){
					$user->countUser();
				$user->insertUser();
					echo 'success';
				}else{
					echo 'Cette ville n\'est pas répertorié dans notre base de données, choissisez plutôt "'.$user->verifCity($city).'"';
			}
		}
	}
}else{
	echo 'Veuillez remplir tous les champs !';
}


 ?>