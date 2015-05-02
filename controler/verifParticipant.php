<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/participant.php';
$participant = new Participant($bdd);
include_once '../modele/notification.php';
$notif = new Notification($bdd);
include_once '../modele/newEvent.php';
$event = new Event($bdd);
include_once '../modele/register.php';
$user = new User($bdd);
$id_user = $_SESSION['user'];
$id_event = $_POST['id_event'];
$id_user2 = $event->selectId_user($id_event);
$status = 0;
$participant->addParticipant($id_user,$id_event,$status);
$type ="public inscrit event";
$description = $user->selectLongname($id_user). '(public) est inscrit à votre événement';
$notif->sendNotif($id_event,$id_user2,$type,$description);
echo 'success';

 ?>