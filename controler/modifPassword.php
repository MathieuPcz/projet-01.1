<?php 
include_once 'bdd.php';
include_once '../modele/register.php';
$id_user = $_POST['id_user'];
$newPass = sha1($_POST['newpass']);
$pass = sha1($_POST['pass']);
$repass = sha1($_POST['repass']);
$user = new User($bdd);
if(!empty($newPass) && !empty($pass) && !empty($repass)){
	if(strlen($_POST['newpass'])<4){
			echo 'Votre mot de passe doit contenir 4 caractères au minimum ! ';
			exit();
	}else if($pass != $user->verifAncienPass($id_user)){
		echo 'Votre ancien mot de passe ne corespond pas !';
		exit();
	}elseif($newPass != $repass){
		echo 'Vos mots de passe ne corespond pas !';
		exit();
		
	}else{
		$user = new User($bdd);
		$user->modifPassword($id_user,$newPass);
			echo 1;
	}
}else{
	echo 'Veuillez remplir tous les champs !';
}


 ?>