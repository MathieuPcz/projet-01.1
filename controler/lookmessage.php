<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);
include_once '../modele/tchat.php';
$tchat = new Tchat($bdd);
include_once '../modele/notification.php';
$notif = new Notification($bdd);
$id_user = $_SESSION['user'];
$id_user2 = $_POST['id_user2'];
$look = "1";
$tchat->modifLook($id_user2,$id_user,$look);
$notif->modifNotif($_SESSION['user']);