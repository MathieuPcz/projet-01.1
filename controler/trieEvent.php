<?php 
include_once 'bdd.php';
include_once '../modele/newEvent.php';
$event = new Event($bdd);
$typeEvent = $_POST['trier'];
$city = $_POST['search'];
if($typeEvent==1){
	$typeEvent="Evenement";
}elseif ($typeEvent ==2) {
	$typeEvent="Before";
}elseif ($typeEvent==3) {
	$typeEvent="After";
}else{
	$typeEvent ='';
}
$variable = $event->selectAllEventByTrie($city,$typeEvent);
foreach ($variable as $value) {
$date = new DateTime($value['dateEvent']);
$newdate =$date->format('d/m/Y');
if(!empty($value['imgEvent'])){
	$image = '<img src="../images/event/'.$value['imgEvent'].'" alt="imgEvent">';
}else{
	$image = '<img src="../images/logo-header.png" alt="imgEvent" style="width:130%; margin-left:-6%; margin-top:20%;">';
}
echo '<a href="event.php?id='.$value['id'].'"><div class="before">
		<div class="imageBefore">'.$image.'</div>
		<h3>'.$value['typeEvent'].' - '.$value['nameEvent'].'</h3>
		<strong>Le '.$newdate.' à '.$value['heure_deb_event'].'</strong>
	</div></a>';
}


?>