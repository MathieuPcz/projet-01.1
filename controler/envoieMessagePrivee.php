<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/tchat.php';
include_once '../modele/register.php';
$user = new User($bdd);
$tchat = new Tchat($bdd);
include_once '../modele/notification.php';
$notif = new Notification($bdd);
$id_user = $_SESSION['user'];
$message = htmlspecialchars(trim(ucfirst($_POST['message'])));
$id_user2 = $_POST['id_user2'];
$longname = $user->selectLongname($id_user2);
$tchat->insertMessage($id_user,$id_user2,$longname,$message);
$tchat->insertMessage($id_user2,$id_user,$longname,$message);
$look = "1";
$tchat->modifLook($id_user2,$id_user,$look);
$type ="tchat";
$description = $user->selectLongname($id_user)." vous a envoyé un message";
$notif->sendNotif($id_user,$id_user2,$type,$description);
 ?>
