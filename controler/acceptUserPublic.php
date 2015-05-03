<?php 
include_once 'bdd.php';
include_once '../modele/participant.php';
$participant = new Participant($bdd);
include_once '../modele/notification.php';
$notification = new Notification($bdd);
include_once '../modele/newEvent.php';
$event = new Event($bdd);
$invite = $_POST['inviter'];
$id_event = $_POST['id_event'];
$status = 1;
$type_notif="accpete user public event";
$description = "Vous participez à ".$event->selectNameEvent($id_event);
foreach ($invite as $value) {
	
	$user = $participant->verifParticipation($value,$id_event);
	
		$participant->modifEtatParticipation($value,$id_event,$status);
		$notification->sendNotif($id_event,$value,$type_notif,$description);

	
}
header('Location: ../vue/user/event.php?id='.$id_event.'&rep=accepte');
 ?>