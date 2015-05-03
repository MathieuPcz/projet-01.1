<?php 
$id_user = $_SESSION['user'];
$id_event = $_GET['id'];
$result = $participant->selectAllParticipant($id_event,0);
 ?>
<section id="acceptUserPublic">
<img src="../images/logo-header.png" alt="création" style="width:50%;">
<form action="../../controler/acceptUserPublic.php" method="post">
<h3>Liste des utilisateurs(pulic) en attente</h3>
	<?php 
	foreach ($result as $value) {
		echo '<div class="listAttenteUser"><input type="checkbox" name="inviter[]" id="'.$value['id_user'].'" value="'.$value['id_user'].'"><strong>'.$user->selectLongname($value['id_user']).'</strong></div>';

		
		
	}
	echo '<input type="hidden" name="id_event" value="'.$_GET["id"].'">';
	 ?>
	 <button id="annulerAcceptUserPublic" type="button">Annuler</button> <button id="acceptPublic" type="submit">Accpeter</button>
</form>
</section> 