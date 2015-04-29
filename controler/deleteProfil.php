<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);
$id_user = $_POST['id_user'];
$user->deleteProfil($id_user);
echo 'success';
?>