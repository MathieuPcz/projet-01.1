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
	$avatar = $user->selectAvatar($value['id_user2']);
	if(!empty($avatar)){
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
if(!empty($id_event)){

		foreach ($id_event as $value) {
			if(!empty($value['id_event'])){
				echo '<div class="tchatsousCategories"><strong>Evénement : '.$event->selectNameEvent($value['id']).'</strong></div>';
					$status = 0;
					if($participant->countParticipant($value['id'],$status)==0){
						echo '<p style="color:#A9A9A9; font-weight:bold; text-align:center; padding:1%;">Aucun utilisateur(public) inscrit</p>';
					}
			$userEvent = $participant->selectAllParticipant($value['id'],0);
			foreach ($userEvent as $value) {
				$avatar = $user->selectAvatar($value['id_user']);
				if(!empty($avatar)){
				 $avatar = $user->selectAvatar($value['id_user']);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
				}
				$connect = $user->selectConnect($value['id_user']);
				$ami = $friends->verifFriend($_SESSION['user'],$value['id_user']);
				if(empty($ami)){
					if($connect != 1){
						echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="noconnect"></div></div>';
					}elseif($connect==1){
						echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="connect"></div></div>';
					}
				}
			}
		}else{
			
		}
			
			
		}
}
	$id_event = $participant->selectAllIdEventByUser($_SESSION['user'],0);
	foreach ($id_event as $value) {
		echo '<div class="tchatsousCategories"><strong>Evénement : '.$event->selectNameEvent($value['id_event']).'</strong></div>';
	
	$nbParticipant = $participant->selectAllParticipant($value['id_event'],1);
	foreach ($nbParticipant as $value) {
		$avatar = $user->selectAvatar($value['id_user']);
				if(!empty($avatar)){
				 $avatar = $user->selectAvatar($value['id_user']);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
				}
				$connect = $user->selectConnect($value['id_user']);
				$ami = $friends->verifFriend($_SESSION['user'],$value['id_user']);
				if(empty($ami)){
					if($connect != 1){
						echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="noconnect"></div></div>';
					}elseif($connect==1){
						echo '<div class="selectUser" id="'.$value['id_user'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$user->selectLongname($value['id_user']).'</p><div class="connect"></div></div>';
					}
				}
			}
	}


	echo '</div>';
?>