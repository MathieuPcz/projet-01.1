<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
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
				<div id="imgProfil"><?php echo $user->selectAvatar($id_user); ?><p>Inscrit depuis le Date</p></div>
				<div id="infoUser">
				<h2><?php echo $user->selectFirstname($id_user).' '.$user->selectName($id_user); ?></h2>
				<div id="button">
					<button>Ajouter</button>
					<select  id="modifierProfil">
						<option value="0">Modifier</option>
						<option value="1">Modifier l'image de profil</option>
						<option value="2">Supprimer Compte</option>
					</select>
				</div>
				<h3>Informations personnelles :</h3>
				<p>Situations amoureuse : non-renseigné</p>
				<p>Habite : non-rensigné</p>
				<p>Age : non-renseigné</p>

				</div>
		</div>
		<?php include '../include/formEvent.php'; ?>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/newEvent.js"></script>
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
		});
		</script>
	</body>
</html>