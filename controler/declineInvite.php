<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/participant.php';
$participant = new Participant($bdd);
$id_user = $_SESSION['user'];
$id_event = $_POST['id_event'];
$invite=$_POST['inviter'];
foreach ($invite as $value) {
	$participant->declineParticipation($value,$id_event);
		
}
header('Location: ../vue/user/event.php?id='.$id_event.'&rep=declineInvite');


 ?>