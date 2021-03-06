<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/newEvent.php';
$newEvent = new Event($bdd);
$id_user = $_SESSION['user'];
include_once '../modele/participant.php';
$participant = new Participant($bdd);
$typeEvent = $_POST['typeEvent'];
$heure_deb_event = $_POST['heure_deb_event'];
$access = $_POST['access'];
$nameEvent = $_POST['nameEvent'];
$dateEvent = $_POST['dateEvent'];
$lieuEvent = $_POST['lieuEvent'];
$place_user = $_POST['place_user'];
$event_description = $_POST['event_description'];

if($typeEvent == "0"){
	echo "<br>Veuillez choisir un type d'événement !" ;
}elseif($heure_deb_event =="erreur"){
	echo "<br>Veuillez choisir l'heure de début !";
}elseif($access =="0"){
	echo "<br>Veuillez choisir un type d'accès !";
}elseif(strlen($nameEvent) < 3){
	if($typeEvent =="Before"){
		echo '<br>Votre Before doit contenir 3 caractères minimum !';
	}else{
		echo '<br> Votre After doit contenir 3 caractères minimum !';
	}
}elseif(!empty($dateEvent)){
	if(preg_match('#^([0-9]{2})([/-])([0-9]{2})\2([0-9]{4})$#', $dateEvent, $m) == 1 && checkdate($m[3], $m[1], $m[4])){
		if(strlen($lieuEvent) < 3){
		echo "<br>Le lieu de votre événement doit contenir 3 caractères minimum !";
		}elseif(is_numeric($place_user) && $place_user>=0){
			$newEvent->countEvent();
			$newEvent->insertEvent($id_user);
			$status = 1;
			$id_event = $participant->selectLastId();
			$participant->addParticipant($id_user,$id_event,$status);
			echo $newEvent->redirection();
		}else{
			echo "Le nombre de place disponnible doit être supérieur ou égale à 0";
		}
	}else{
		echo "<br>Vous devez entrer une date valide de type jj/mm/aaaa !";
	}
}else{
	echo "<br>Vous devez entrer une date";
}

 ?>
