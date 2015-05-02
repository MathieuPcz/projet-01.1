<?php 
$id_user = $_SESSION['user'];
$id_event = $_GET['id'];
$result = $friends->selectFriends($id_user);
 ?>
<section id="inviteFriends">
<img src="../images/logo-header.png" alt="création" style="width:50%;">
<form action="../../controler/inviteFriends.php" method="post">
<h3>Liste des amis pas encore invité à votre événement</h3>
	<?php 
	foreach ($result as $value) {
		$id_user = $participant->verifParticipation($value['id_user2'],$id_event);
		if($id_user!=$value['id_user2']){
		echo '<div class="listInviteFriend"><input type="checkbox" name="inviter[]" id="'.$value['id_user2'].'" value="'.$value['id_user2'].'"><strong>'.$user->selectLongname($value['id_user2']).'</strong></div>';

		}
		
	}
	echo '<input type="hidden" name="id_event" value="'.$_GET["id"].'">';
	 ?>
	 <button id="annulerInvite" type="button">Annuler</button> <button id="inviterFriends" type="submit">Inviter</button>
</form>
</section> 
