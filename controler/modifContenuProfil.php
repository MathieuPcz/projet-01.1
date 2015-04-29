<?php 
include_once 'bdd.php';
include_once '../modele/register.php';
$name = htmlspecialchars(trim(ucfirst($_POST['name'])));
$firstname = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
$city = htmlspecialchars(trim(ucfirst($_POST['city'])));

if(!empty($name) && !empty($firstname) && !empty($city)){
		if(strlen($name)<3){
			echo 'Votre nom doit contenir 3 caractères au minimum ! ';
			exit();
	}else if(strlen($firstname)<3){
		echo 'Votre prénom doit contenir 3 caractères au minimum ! ';
		exit();
	}elseif (strlen($city)<3) {
		echo 'Votre ville doit contenir 3 caractères au minimum ! ';
		exit();
	}else{
		$user = new User($bdd);
		$user->modifUser();
			echo 1;
		
	}
}else{
	echo 'Veuillez remplir tous les champs !';
}
 


 ?>

