<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
	include_once '../../modele/newEvent.php';
	$event = new Event($bdd);
	include_once '../../modele/participant.php';
	$participant = new Participant($bdd);
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
			<nav>
				<ul>
					<li class="menu"><?php echo '<a href="user.php?id='.$_SESSION['user'].'">';  ?><?php echo $user->selectFirstname($user_id);  ?></a></li>
					<li class="menu"><a href="#">Evénements</a>
						<ul class="menu_ul">
							<li class="sousMenu"><a href="#" id="newEvent">Créer</a></li>
							<li class="sousMenu"><a href="#">Before-After</a></li>
						</ul>
					</li>
					<li class="menu"><a href="../../controler/disconnect.php">Déconnexion</a></li>
				</ul>
			</nav>
		</div>
		<div id="couverture">

		</div>
	</header>
	<div class="tchat">
		<ul>
				<!-- <li class="menuTchat"><a href="#" class="TchatCategories">Amis</a>
					<ul>
						<li class="tchatPeople"><a href="#" class="people">Mathieu</a></li>
						<li class="tchatPeople"><a href="#" class="people">Florian</a></li>
						<li class="tchatPeople"><a href="#" class="people">Cassandra</a></li>
					</ul>
				</li>
				
				<li class="menuTchat"><a href="#" class="TchatCategories">Public</a></li>
			</ul> -->
		</div>
		<div class="container">
			<div id="baniere">
				<div id="imageBaniere"><?php echo $event->verifIMG($id_event) ?></div>
				<div id="infoCreateur">
					<p>Créé le : <?php echo $event->selectRegister_date($id_event); ?></p>
					<strong>Par : <?php 
						$user_id = $event->selectId_user($id_event);
						echo $user->selectFirstname($user_id); ?> <?php echo $user->selectName($user_id); ?></strong>
					</div>
				</div>
				<div id="info_event">
					<h2><?php echo $event->selectNameEvent($id_event); ?></h2>
					<?php 
					$id_user = $_SESSION['user'];
					$id_event = $_GET['id'];
					if($event->selectId_user($id_event)==$_SESSION['user']){
						echo '<select name="choix" id="choix">
						<option value="1">Modifier</option>
						<option value="2">Modifier l\'image</option>
						<option value="3">Supprimer</option>
					</select><button id="validModif">Valider</button>';
				}elseif($id_user != $participant->verifParticipation($id_user,$id_event)){
					echo '<button id="participe">Participer</button>';
				}else{
					echo '<span id="statusParticipation">Vous êtes en file d\'attente</span><button type="button" id="declineEvent">Décliner</button>';
				}
				?>
				<div id="infoModif"></div>
				<div id="infoParticipation"></div>
				<div class="info">
					<p>Type : <strong><?php echo $event->selectTypeEvent($id_event); ?></strong></p>
					<p>Se déroulera le <strong><?php echo $event->selectDateEvent($id_event); ?> à <?php echo $event->selectHeure_deb_event($id_event); ?></strong></p>
					<p>Acceptation :<strong> <?php echo $event->selectAccess($id_event); ?></strong></p>
					<p><?php echo $event->selectTypeEvent($id_event); ?> de l'événement <strong><?php echo $event->selectEvent($id_event); ?></strong></p>
					<p>Plade disponnible au public : <strong><?php echo $event->selectPlaceUser($id_event); ?></strong></p><br>
				</div>
				<p><strong>Personnes dans la file d'attente : </strong></p>
				<p> 
					<div id="fileAttente"><?php 
						$id_event = $_GET['id'];
						$status = 0;
						$nbParticipant = $participant -> countParticipant($id_event,$status);
						echo $nbParticipant;
						?>
					</div>
					<?php 
						$id_event = $_GET['id'];
							$status=0;
							$select = $bdd -> prepare('SELECT id_user FROM participant WHERE id_event=:id_event AND status=:status');
							$select -> execute(array('id_event'=>$id_event,
													'status'=>$status));
							$i=0;
							while($result = $select->fetch()){
								if($i>10){
									exit();
								}else{
								$user_id = $result['id_user'];
								echo '<div class="avatar"><a target="_blank" href="user.php?id='.$user_id.'">'.$user->selectAvatar($user_id).'</a></div>';
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
				<p><strong>Participants actuels :</strong></p>
				<p>
					<div id="nbParticipant">
						<?php 
						$id_event = $_GET['id'];
						$status = 1;
						$nbParticipant = $participant -> countParticipant($id_event,$status);
						echo $nbParticipant;
						?>
					</div>
					<?php 
					$id_event = $_GET['id'];
					$status=1;
					$select = $bdd -> prepare('SELECT id_user FROM participant WHERE id_event=:id_event AND status=:status');
					$select -> execute(array('id_event'=>$id_event,
											'status'=>$status));
					$i=0;
					while($result = $select->fetch()){
						if($i>10){
							exit();
						}else{
						$user_id = $result['id_user'];
						echo '<div class="avatar"><a target="_blank" href="user.php?id='.$user_id.'">'.$user->selectAvatar($user_id).'</a></div>';
						}
						$i++;
					}	
					?>
				</p>
			</div>
		</div>
		<div id="delete">
			<strong>Votre événement va être supprimé, voulez vous continuer ?</strong>
			<button id="supprNon">Annuler</button>
			<button id="supprOui">Confirmer</button>
			<div id="infoDelete"></div>
		</div>
		<input type="file" id="affiche">
		<?php include '../include/formEvent.php'; ?>
		<?php include '../include/modifEvent.php'; ?>
		
		<!-- <footer>
			<a href="#">À propos</a> <a href="#">Aide</a><a href="#">État du service</a> <a href="#">Offres d'emploi</a> <a href="#">Conditions</a> <a href="#">Confidentialité</a> <a href="#">Informations sur la publicité</a> <a href="#">Médias</a> <a href="#"> Développeurs</a> © 2015 Before-After
		</footer> -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/newEvent.js"></script>
		<script type="text/javascript" src="../js/event.js"></script>
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