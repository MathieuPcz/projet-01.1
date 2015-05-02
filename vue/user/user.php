<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
	include_once '../../modele/friends.php';
	$friends = new Friend($bdd);
	include_once '../../modele/notification.php';
	$notification = new Notification($bdd);
	$id_user = $_GET['id'];
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
		<link rel="stylesheet" href="../css/user.css">
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
					<ul>
						<li class="menu"><?php echo '<a href="user.php?id='.$_SESSION['user'].'">';  ?><div class="avatar"><?php echo $user->selectAvatar($user_id); ?></div><?php echo $user->selectFirstname($user_id);  ?></a></li>
						<li class="menu"><a href="#">Evénements</a>
							<ul class="menu_ul">
								<li class="sousMenu"><a href="#" id="newEvent">Créer</a></li>
								<li class="sousMenu"><a href="../user/">Before-After</a></li>
							</ul>
						</li>
						<li class="menu"><a href="#">Notification	<?php 
								$nbNotif = $notification->countNotif($_SESSION['user'],0);
								if($nbNotif>0){
									$nbNotif = '<strong class="notification">'.$nbNotif.'</strong>';
								}
								echo '<div id="numberNotif">'.$nbNotif.'</div>'; ?></a>
							<ul class="menu_ul">
								<?php 
								$result = $notification->selectAllNotif($_SESSION['user']);
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
									
								 ?>
								 <li class="sousMenu"><a href="#" id="allNotification">Voir toutes les notifications</a></li>
							</ul>
			
						</li>
						<li class="menu"><a href="../../controler/disconnect.php">Déconnexion</a></li>
					</ul>
				</nav>
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
				<div id="imgProfil">
					<div id="profilImg"><?php  if(!empty($user->selectAvatar($id_user))){
						echo $user->selectAvatar($id_user); 
						}else{
							echo '<img src="../images/logo-header.png" alt="no-avatar" id="no-avatar">';
							}?></div>
					<p>Inscrit depuis le <?php echo $user->selectRegister_date($id_user); ?></p>
				</div>
				<div id="infoUser">
					<h2><?php echo $user->selectLongname($id_user); ?></h2>
					<div id="button">
						<?php 

						$etatFriend = $friends->verifStatut($_GET['id'],$_SESSION['user']);
						
						if($_SESSION['user']!=$_GET['id']){
								if($etatFriend == "0"){
								echo'<button id="refusFriend">Refuser</button><button id="acceptFriend">Accepter</button>';
							}elseif($etatFriend == "1"){
								echo "<select  id='gestionFriend'>
										<option value='erreur'>Amis</option>
										<option value='Retirer'>Retirer de la liste d'amis</option>
									</select><button id='validerModifFriend'>Valider</button>";
							}else{
								echo'<button id="addFriend">Ajouter</button>';
							}
						}
							?>
						<?php if($_SESSION['user']==$_GET['id']){
							echo "<select  id='modifierProfil'>
									<option value='0'>Modifier</option>
									<option value='1'>Modifier l'image de profil</option>
									<option value='2'>Modifier mot de passe</option>
									<option value='3'>Supprimer Compte</option>
								</select>
								<button id='valider'>Valider</button>";
							} ?>
					</div>
					<div id="modifProfilInfo">
						<div id="newPass">
							<input type="password" id="pass" placeholder="Mot de passe actuel">
							<input type="password" id="newpass" placeholder="Nouveau mot de passe">
							<input type="password" id="repass" placeholder="Retaper mot de passe">
							<button type="button" id="stopModifPass">Annuler</button><button type="button" id="modifPassword">Modifier</button>
							<div id="infoPass"></div>
						</div>
					</div>
					<div id="textInfo">
						<h3>Informations personnelles :</h3>
						<p>Situations amoureuse : <strong><?php if(!empty($user->selectLove($id_user))){echo $user->selectLove($id_user);}else{echo 'non-renseigné';} ?></strong></p>
						<p>Habite : <strong><?php echo $user->selectLieu($id_user); ?></strong></p>
						<p>Age : <strong><?php if(!empty($user->selectAge($id_user))){echo $user->selectAge($id_user).' ans';}else{echo 'non-renseigné';} ?></strong></p>
					</div>
				</div>
				<div id="autre">
					<nav>
						<ul>
							<li><a href="#" id="moreInfo">Plus d'informations</a></li>
							<li><a href="#" id="friend">Amis</a></li>
							<li><a href="#" id="avis">Avis</a></li>
						</ul>
					</nav>
					<div id="moreInformation">
						<p>Citation favorite : <strong><?php if(!empty($user->selectCitation($id_user))){echo $user->selectCitation($id_user);}else{echo 'non-renseigné';} ?></strong></p>
						<p>Profession : <strong><?php if(!empty($user->selectProfession($id_user))){echo $user->selectProfession($id_user);}else{echo 'non-renseigné';} ?></strong></p>
						<p>Lieu de naissance : <strong><?php if(!empty($user->selectNaissance($id_user))){echo $user->selectNaissance($id_user);}else{echo 'non-renseigné';} ?></strong></p>
						<p>Niveau d'étude : <strong><?php if(!empty($user->selectEtude($id_user))){echo $user->selectEtude($id_user);}else{echo 'non-renseigné';} ?></strong></p>
						<p><strong><?php if(!empty($user->selectDescription($id_user))){echo $user->selectDescription($id_user);}else{} ?></strong></p>
					</div>
					<div id="myFriends">
						<div class="friend">
								<?php 

								$allFriends = $friends->selectFriends($_GET['id']);
								foreach($allFriends as $value){

									if(empty($value['id'])){
										echo'Aucun amis pour le moment !';
									}else{
										$avatar = $user->selectAvatar($value['id_user2']);
										if(!empty($avatar)){
											$avatar=$user->selectAvatar($value['id_user2']);
										}else{
											$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="no-avatar">';
										}
										$i=0;
										if($i>1){
											echo '<div class="listFriend"><a href="user.php?id='.$value['id_user2'].'">
										<div class="afficheFriend">'.$avatar.'</div><p>
										'.$user->selectLongname($value['id_user2']).' Ami(e) depuis le '.$value['friendDate'].'</p></a></div><br><hr>';
										$i=0;

										}else{
											echo '<div class="listFriend"><a href="user.php?id='.$value['id_user2'].'">
										<div class="afficheFriend">'.$avatar.'</div><p>
										'.$user->selectLongname($value['id_user2']).' Ami(e) depuis le '.$value['friendDate'].'</p></a></div>';
										$i++;
										}
									}		
								}

							 ?>
							
						</div>
					</div>
					<div id="note">Mes avis</div>
				</div>
		</div>
		<input type="file" id="affiche">
		<div id="delete">
			<strong>Votre Compte va être supprimé, voulez vous continuer ?</strong>
			<input type="password" placeholder="Mot de passe" id="passDelete">
			<button id="supprNon">Annuler</button>
			<button id="supprOui">Confirmer</button>
			<div id="infoDelete"></div>
		</div>
		<?php include '../include/notification.php'; ?>
		<?php include '../include/formEvent.php'; ?>
		<?php include '../include/modifProfil.php'; ?>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/newEvent.js"></script>
		<script type="text/javascript" src="../js/user.js"></script>
		<script type="text/javascript" src="../js/search.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var widthWindow = $(window).width();
				var heightWindow = $(window).height();

				/*reglage taille ecran*/
				$('body').css('width',widthWindow);
				
				$('#newEvent').click(function(){
					$('.container').fadeOut();
					$('#creatEvent').fadeIn(800);
				});
				$('#annulEvent').click(function(){
					$('#creatEvent').fadeOut();
					$('.container').fadeIn(800);
				});

				$('#moreInfo').addClass('souligner');
				$("#autre li a").click(function(e) {
				    e.preventDefault();
				    $("#autre li a").removeClass("souligner");
				    $(this).addClass("souligner");
				});

				$('#moreInfo').click(function(){
					$('#myFriends').fadeOut();
					$('#note').fadeOut();
					$('#moreInformation').fadeIn(800);
				})
				$('#friend').click(function(){
					$('#note').fadeOut();
					$('#moreInformation').fadeOut();
					$('#myFriends').fadeIn(800);
				})
				$('#avis').click(function(){
					$('#myFriends').fadeOut();
					$('#moreInformation').fadeOut();
					$('#note').fadeIn(800);
				})
		});
		</script>
	</body>
</html>