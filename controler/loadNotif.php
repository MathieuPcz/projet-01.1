<?php 
session_start();
include_once 'bdd.php';
include_once '../modele/notification.php';
$notification = new Notification($bdd);
echo '<a href="#">Notification';
$nbNotif = $notification->countNotif($_SESSION['user'],0);
if($nbNotif>0){
	$nbNotif = '<strong class="notification">'.$nbNotif.'</strong>';
}
echo '<div id="numberNotif">'.$nbNotif.'</div></a>
<ul class="menu_ul">';
$result = $notification->selectAllNotifByStatut($_SESSION['user'],0);
$i=0;
foreach($result as $value){

	if(empty($value['id'])){
		echo'Aucune notification';
	}elseif($i>2){
		break;
	}else{
		echo '<li class="sousMenu"><a href="../../controler/verifNotif.php?id='.$value['id'].'">'.$value['description'].'</a></li>';

	}
	$i++;		
	}
	
 echo '
 <li class="sousMenu"><a href="#" id="allNotification">Voir toutes les notifications</a></li>
</ul>'; 