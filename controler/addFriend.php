<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/friends.php';
$friend = new Friend($bdd);
include_once '../modele/register.php';
$user = new User($bdd);
include_once '../modele/notification.php';
$notif = new Notification($bdd);

$id_user = $_SESSION['user'];
$id_user2 = $_POST['id_friend'];


if(!empty($id_user) AND !empty($id_user2)){

	$ami = $friend->verifFriend($id_user,$id_user2);
	if($ami != $id_user2){
		$friend->insertFriend($id_user,$id_user2,$user->selectLongname($id_user2));
		$type ="Demande d'ami(e)";
		$description = $user->selectLongname($id_user)." vous demande en ami(e)";
		$notif->sendNotif($id_user,$id_user2,$type,$description);
		echo '1';
	}else{
		echo  "demande d'amis déjà envoyé !";
	}
}else{
	echo 'Une erreur est survenue';
}

?>