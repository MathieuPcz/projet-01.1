<?php 
$id_user = $_SESSION['user'];
$id_event=$_GET['id'];
$status = 0;
$result = $participant->selectAllParticipant($id_event,$status);
 ?>
<section id="gestionInvite">
<img src="../images/logo-header.png" alt="création" style="width:50%;">
<form action="../../controler/declineInvite.php" method="post">
<div id="enattente">
	<h3>Utilisateur(public) en attentes</h3>
	<?php 
	echo '<input type="hidden" name="id_event" value="'.$_GET["id"].'">';
	foreach ($result as $value) {
		$id_user = $participant->verifParticipation($value['id_user'],$id_event);
		if($id_user ==$value['id_user']){
			$avatar = $user->selectAvatar($value['id_user']);
			if(!empty($avatar)){
				$avatar = $user->selectAvatar($value['id_user']);
			}else{
				$avatar = '<img src="../images/logo-header.png" alt="no-avatar" style="margin-top:10px; width:40px;">';
			}
		echo '<div class="listUserInvite"><input type="checkbox" name="inviter[]" id="'.$value['id_user'].'" value="'.$value['id_user'].'"><div class="avatarInvite">'.$avatar.'</div><a target="_blank" href="user.php?id='.$value['id_user'].'"><strong>'.$user->selectLongname($value['id_user']).'</strong></a></div>';

		}
		
	}
	 ?>
</div>
<div id="userInvite">
	<h3>Utilisateur(amis) invités</h3>
	 <?php 
	 $status = 1;
	$result = $participant->selectAllParticipant($id_event,$status);
	foreach ($result as $value) {
		$id_user = $participant->verifParticipation($value['id_user'],$id_event);
		if($id_user ==$value['id_user']){
			$avatar = $user->selectAvatar($value['id_user']);
			if(!empty($avatar)){
				$avatar = $user->selectAvatar($value['id_user']);
			}else{
				$avatar = '<img src="../images/logo-header.png" alt="no-avatar" style="margin-top:10px; width:40px;">';
			}
		echo '<div class="listUserInvite"><input type="checkbox" name="inviter[]" id="'.$value['id_user'].'" value="'.$value['id_user'].'"><div class="avatarInvite">'.$avatar.'</div><a target="_blank" href="user.php?id='.$value['id_user'].'"><strong>'.$user->selectLongname($value['id_user']).'</strong></a></div>';

		}
		
	}
	$status = 2;
	$result = $participant->selectAllParticipant($id_event,$status);
	foreach ($result as $value) {
		$id_user = $participant->verifParticipation($value['id_user'],$id_event);
		if($id_user ==$value['id_user']){
			$avatar = $user->selectAvatar($value['id_user']);
			if(!empty($avatar)){
				$avatar = $user->selectAvatar($value['id_user']);
			}else{
				$avatar = '<img src="../images/logo-header.png" alt="no-avatar" style="margin-top:10px; width:40px;">';
			}
		echo '<div class="listUserInvite"><input type="checkbox" name="inviter[]" id="'.$value['id_user'].'" value="'.$value['id_user'].'"><div class="avatarInvite">'.$avatar.'</div><a target="_blank" href="user.php?id='.$value['id_user'].'"><strong>'.$user->selectLongname($value['id_user']).'</strong></a></div>';

		}
		
	}
	 ?>
</div><br>
<button id="annulInvite" type="button">Annuler</button> <button id="modifInvite" type="submit">Supprimer</button>
</form>
</section> 
