<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once 'bdd.php';
	include_once '../modele/register.php';
	$user = new User($bdd);
	include_once '../modele/friends.php';
	$friends = new Friend($bdd);
	include_once '../modele/newEvent.php';
	$event = new Event($bdd);
	include_once '../modele/participant.php';
	$participant = new Participant($bdd);
}else{
	header('Location: ../../index.php'); 
}
echo '<div id="friendTchat">
		<div class="tchatCategories"><h3>Amis</h3></div>';
$variable = $friends->selectFriends($_SESSION['user'],1);
foreach ($variable as $value) {
	if(!empty($user->selectAvatar($value['id_user2']))){
	 $avatar = $user->selectAvatar($value['id_user2']);
	}else{
		$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
	}
	$connect = $user->selectConnect($value['id_user2']);
	if($connect != 1){
		echo '<div class="selectUser" id="'.$value['id_user2'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user2']).'</p><div class="noconnect"></div></div>';
	}elseif($connect==1){
		echo '<div class="selectUser" id="'.$value['id_user2'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user2']).'</p><div class="connect"></div></div>';
	}
}

echo '</div>';
echo '<div id="tchatEvent">';
		

		$id_event = $event->selectAllEventByUser($_SESSION['user']);
		foreach ($id_event as $value) {
			echo '<div class="tchatsousCategories"><strong>Evénement : '.$event->selectNameEvent($value['id']).'</strong></div>';
			$userEvent = $participant->selectAllParticipant($value['id'],0);
			foreach ($userEvent as $value) {
				if(!empty($user->selectAvatar($value['id_user']))){
				 $avatar = $user->selectAvatar($value['id_user']);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
				}
				$connect = $user->selectConnect($value['id_user']);
				if($connect != 1){
					echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="noconnect"></div></div>';
				}elseif($connect==1){
					echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="connect"></div></div>';
				}
			}
			$userEventParticipant = $participant->selectAllParticipant($value['id'],1);
			foreach ($userEventParticipant as $value) {
				if(!empty($user->selectAvatar($value['id_user']))){
				 $avatar = $user->selectAvatar($value['id_user']);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
				}
				$connect = $user->selectConnect($value['id_user']);
				if($connect != 1){
					echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="noconnect"></div></div>';
				}elseif($connect==1){
					echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="connect"></div></div>';
				}
			}
		}
	echo '</div>';
?>