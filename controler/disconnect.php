<?php
session_start();
include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);
$user->modifConnect($_SESSION['user'],0);
session_unset();
session_destroy();
header('Location: ../index.php');
exit();
?>