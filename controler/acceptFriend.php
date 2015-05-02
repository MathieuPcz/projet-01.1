<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/friends.php';
$friends = new Friend($bdd);
include_once '../modele/register.php';
$user = new User($bdd);

include_once '../modele/notification.php';
$notif = new Notification($bdd);

$id_user = $_SESSION['user'];
$id_user2 = $_POST['id_friend'];

 if(!empty($id_user) AND !empty($id_user2)){
 	$friends->acceptFriend($id_user2,$id_user);
	$type ="Demande acceptée";
	$description = 'Vous êtes désormais amis avec '.$user->selectLongname($id_user);
	$notif->sendNotif($id_user,$id_user2,$type,$description);
 	echo '1';
 }else{
 	echo 'Une erreure est survenue';
 }

 ?>