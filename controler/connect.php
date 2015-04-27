<?php 
	session_start();
	include_once 'bdd.php';
	include_once '../modele/register.php';
	extract($_POST);

	if(!empty($email) && !empty($password)){
		$user = new User($bdd);
		$email_bdd = $user->verifMail();
		$password_bdd =$user->verifPassword();
		$password = sha1($password);

		if($email != $email_bdd){
			echo 'Ce compte est inexistant !';
			exit();
		}else if($password != $password_bdd){
			echo 'Mauvais mot de passe';
			exit();
		}else{
			echo 'success';
			$_SESSION['user'] = $user->selectId();
		}
	}else{
		echo 'erreur';
	}

 ?>