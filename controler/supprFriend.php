<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/friends.php';
$friends = new Friend($bdd);
$id_user = $_SESSION['user'];
$id_friend = $_POST['id_friend'];
$friends->supprFriend($id_user,$id_friend);

echo '1';


 ?>