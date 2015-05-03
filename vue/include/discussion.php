<div id="userTchat">
		<div id="fadeOutTchat">
		<div id="refreshAmiTchat">
			echo '<div id="friendTchat">
		<div class="tchatCategories"><h3>Amis</h3></div>';
<?php
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
		 </div>
		 </div>
	<div id="resultSearchUser"></div>
	<div id="searchUser">
	<input type="text" id="searchUserTchat" placeholder="Rechercher un utilisateur">
	</div>
</div>