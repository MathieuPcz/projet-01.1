<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
	include_once '../../modele/newEvent.php';
	$event = new Event($bdd);
	include_once '../../modele/friends.php';
	$friends = new Friend($bdd);
	include_once '../../modele/participant.php';
	$participant = new Participant($bdd);
	include_once '../../modele/notification.php';
	$notification = new Notification($bdd);
	$id_event = $_GET['id'];

}else{
	header('Location: ../../index.php'); 
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Before | After</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/event.css">
	<link rel="stylesheet" href="../css/newEvent.css">
</head>
<body>
	<header>
		<div id="mainMenu">
			<a href="index.php"><img src="../images/logo-header.png" alt="logo"></a>
			<div id="recherche">
					<input type="text" id="search" placeholder="Rechercher un utilisateur, un événement ...">
					<div id="resultSearch"></div>
				</div>
			<nav>
				<?php include_once '../include/menuHeader.php'; ?>
			</nav>
		</div>
		<div id="couverture">

		</div>
	</header>
	<div class="tchat">
		<?php include_once '../include/discussion.php' ?>
		</div>
		<div class="container">
			<div id="baniere">
				<div id="imageBaniere"><?php $id_event = $_GET['id'];
				echo $event->verifIMG($id_event) ?></div>
				<div id="infoCreateur">
					<p>Créé le : <?php echo $event->selectRegister_date($id_event); ?></p>
					<strong>Par : <?php 
						$user_id = $event->selectId_user($id_event);
						echo $user->selectLongname($user_id); ?></strong>
					</div>
				</div>
				<div id="info_event">
					<h2><?php echo $event->selectNameEvent($id_event); ?></h2>
					<?php 
					$id_user = $_SESSION['user'];
					$id_event = $_GET['id'];
					if($event->selectId_user($id_event)==$_SESSION['user']){
						echo '<select name="choix" id="choix">
						<option value="0">Inviter des amis</option>
						<option value="4">Accepter Public</option>
						<option value="1">Modifier</option>
						<option value="2">Modifier l\'image</option>
						<option value="3">Supprimer</option>
					</select><button id="validModif">Valider</button>';
				}elseif($id_user != $participant->verifParticipation($id_user,$id_event)){
					echo '<button id="participe">Participer</button>';
				}elseif($id_user == $participant->verifEtatParticipation($id_user,$id_event,2)) {
					echo '<button id="declineInviteEvent">Décliner</button> <button id="participeInviteEvent">Participer</button>';
				}elseif($id_user == $participant->verifEtatParticipation($id_user,$id_event,1)) {
					echo '<span id="statusParticipation">Vous participez à cet événement</span><button type="button" id="declineEvent">Décliner</button>';
				}else{
					echo '<span id="statusParticipation">Vous êtes en file d\'attente</span><button type="button" id="declineEvent">Décliner</button>';
				}
				?>
				<div id="infoModif"></div>
				<div id="infoParticipation"><?php if(!empty($_GET['rep']) AND $_GET['rep']=="invite"){
					echo 'Vos amis ont bien été invités et sont dans la file : "invités".';
				}elseif(!empty($_GET['rep']) AND $_GET['rep']=="declineInvite"){echo 'Utilisateurs retirés de la liste';
				} ?></div>
				<div class="info">
					<p>Type : <strong><?php echo $event->selectTypeEvent($id_event); ?></strong></p>
					<p>Se déroulera le <strong><?php echo $event->selectDateEvent($id_event); ?> à <?php echo $event->selectHeure_deb_event($id_event); ?></strong></p>
					<p>Acceptation :<strong> <?php echo $event->selectAccess($id_event); ?></strong></p>
					<p>Plade disponnible au public : <strong><?php echo $event->selectPlaceUser($id_event); ?></strong></p>
					<p>Nombre de personnes invitées : <strong><?php echo $participant->countAllParticipant($id_event); ?></strong></p><br>
				</div>
				<p><strong>Personnes dans la file d'attente : </strong></p>
				<p> 
					<div class="nbParticipant"><?php 
						$id_event = $_GET['id'];
						$status = 0;
						$nbParticipant = $participant -> countParticipant($id_event,$status);
						echo $nbParticipant;
						?>
					</div>
					<?php 
						$public = $participant->selectAllParticipant($id_event,$status);
						$i=0;
						foreach ($public as $value) {
							if($i>10){
									exit();
								}else{
								$user_id = $value['id_user'];
								if(!empty($user->selectAvatar($user_id))){
									echo '<div class="avatar"><a target="_blank" href="user.php?id='.$user_id.'">'.$user->selectAvatar($user_id).'</a></div>';
								}else{
									echo '<div class="no-avatar"><a target="_blank" href="user.php?id='.$user_id.'"><p>'.$user->selectLongname($user_id).'</p></a></div>';
								}
								
								}
								$i++;
						}
					
					?>
					</p>
				<br>	
			</div>
			<div id="description">
				<p><strong>Description : </strong><?php echo $event->selectDescription($id_event); ?></p>
				<br>
				<p><strong>Amis en attente :</strong></p>
				<p>
					<div class="nbParticipant">
						<?php 
						$id_event = $_GET['id'];
						$status = 2;
						$nbParticipant = $participant -> countParticipant($id_event,$status);
						echo $nbParticipant;
						?>
					</div>
					<?php 
						$public = $participant->selectAllParticipant($id_event,$status);
						foreach ($public as $value) {
							if($i>10){
									exit();
								}else{
								$user_id = $value['id_user'];
								if(!empty($user->selectAvatar($user_id))){
									echo '<div class="avatar"><a target="_blank" href="user.php?id='.$user_id.'">'.$user->selectAvatar($user_id).'</a></div>';
								}else{
									echo '<div class="no-avatar"><a target="_blank" href="user.php?id='.$user_id.'"><p>'.$user->selectLongname($user_id).'</p></a></div>';
								}
								
								}
								$i++;
						}
					
					?>
				</p><br>
				<div id="participantActuel"><p><strong>Participants actuels :</strong></p>
				<p>
					<div class="nbParticipant">
						<?php 
						$id_event = $_GET['id'];
						$status = 1;
						$nbParticipant = $participant -> countParticipant($id_event,$status);
						echo $nbParticipant;
						?>
					</div>
					<?php 
						$public = $participant->selectAllParticipant($id_event,$status);
						foreach ($public as $value) {
							if($i>10){
									exit();
								}else{
								$user_id = $value['id_user'];
								if(!empty($user->selectAvatar($user_id))){
									echo '<div class="avatar"><a target="_blank" href="user.php?id='.$user_id.'">'.$user->selectAvatar($user_id).'</a></div>';
								}else{
									echo '<div class="no-avatar"><a target="_blank" href="user.php?id='.$user_id.'"><p>'.$user->selectLongname($user_id).'</p></a></div>';
								}
								
								}
								$i++;
						}
					
					?>
				</p>
				</div>
			</div>
		</div>
		<div id="delete">
			<strong>Votre événement va être supprimé, voulez vous continuer ?</strong>
			<button id="supprNon">Annuler</button>
			<button id="supprOui">Confirmer</button>
			<div id="infoDelete"></div>
		</div>
		<div class="discut">
				<div class="refreshTchat"></div>
				<input type="text" placeholder="Votre message ..." class="newMessageTchat" autofocus>
		</div>
		<input type="file" id="affiche">
		<?php include '../include/notification.php'; ?>
		<?php include '../include/inviteFriend.php'; ?>
		<?php include '../include/formEvent.php'; ?>
		<?php include '../include/modifEvent.php'; ?>
		<?php include '../include/gestionInvite.php'; ?>
		<?php include '../include/acceptUserPublic.php'; ?>
		
		<!-- <footer>
			<a href="#">À propos</a> <a href="#">Aide</a><a href="#">État du service</a> <a href="#">Offres d'emploi</a> <a href="#">Conditions</a> <a href="#">Confidentialité</a> <a href="#">Informations sur la publicité</a> <a href="#">Médias</a> <a href="#"> Développeurs</a> © 2015 Before-After
		</footer> -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/newEvent.js"></script>
		<script type="text/javascript" src="../js/event.js"></script>
		<script type="text/javascript" src="../js/allPage.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var widthWindow = $(window).width();
				var heightWindow = $(window).height();

				/*reglage taille ecran*/
				$('body').css('width',widthWindow);
				$('.container').css('height',heightWindow);
				
				$('#newEvent').click(function(){
					$('.container').fadeOut();
					$('#creatEvent').fadeIn(800);
				});
				$('#annulEvent').click(function(){
					$('#creatEvent').fadeOut();
					$('.container').fadeIn(800);
				});

				$('#annulModifEvent').click(function(){
					$('#modifierEvent').fadeOut();
					$('.container').fadeIn(800);
				});

			});
		</script>
	</body>
	</html>