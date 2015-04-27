<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/newEvent.php';
$event = new Event($bdd);
$id_event = $_POST['id_event'];
$event->deleteEvent($id_event);
echo 'success';
