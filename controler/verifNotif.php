<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/notification.php';
$notif = new Notification($bdd);
$id_notif = $_GET['id'];
$id_user = $notif->selectUser($id_notif);
$type = $notif->selectType($id_notif);

if($type == "Demande d'ami(e)"){
	$notif->modifNotif($_SESSION['user']);
	header('Location: ../vue/user/user.php?id='.$id_user);
}elseif ($type == "Demande acceptée"){
	$notif->modifNotif($_SESSION['user']);
	header('Location: ../vue/user/user.php?id='.$id_user);
}elseif($type=="event invite"){
	$notif->modifNotif($_SESSION['user']);
	header('Location: ../vue/user/event.php?id='.$id_user);
}elseif($type=="invite event accepter"){
	$notif->modifNotif($_SESSION['user']);
	header('Location: ../vue/user/event.php?id='.$id_user);
}elseif($type=="public inscrit event"){
	$notif->modifNotif($_SESSION['user']);
	header('Location: ../vue/user/event.php?id='.$id_user);
}

 ?>