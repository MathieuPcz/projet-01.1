<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/participant.php';
$participant = new Participant($bdd);
include_once '../modele/notification.php';
$notification = new Notification($bdd);
include_once '../modele/register.php';
$user = new User($bdd);
include_once '../modele/newEvent.php';
$event = new Event($bdd);
$id_user = $_SESSION['user'];
$id_event = $_POST['id_event'];
$id_user2 = $event->selectId_user($id_event);
$status = 1;
$type_notif = "invite event accepter";
$description = $user->selectLongname($id_user).' participe à votre événement';
$participant->modifEtatParticipation($id_user,$id_event,$status);
$notification->sendNotif($id_event,$id_user2,$type_notif,$description);

echo 'success';

 ?>