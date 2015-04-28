<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/participant.php';
$participant = new Participant($bdd);
$id_user = $_SESSION['user'];
$id_event = $_POST['id_event'];
$participant->declineParticipation($id_user,$id_event);

echo 'success';

 ?>