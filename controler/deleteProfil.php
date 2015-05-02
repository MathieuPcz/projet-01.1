<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);
include_once '../modele/newEvent.php';
$event = new Event($bdd);
include_once '../modele/participant.php';
$participant = new Participant($bdd);
$id_user = $_SESSION['user'];

 $pass = sha1($_POST['passDelete']);

 if(!empty($pass)){
 	$password = $user->selectPassword($id_user);
 	if($pass == $password){
 		$user->deleteProfil($id_user);
		$participant->deleteParticipantProfil($id_user);
		$event->deleteEventProfil($id_user);
 		echo 'success';
 	}else{
 		echo 'Mauvais mot de passe !';
 	}
 }else{
 	echo 'Vous devez entrer votre mot de passe !';
 }

?>