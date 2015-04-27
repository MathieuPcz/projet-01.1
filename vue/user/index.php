<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);

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
		<link rel="stylesheet" href="../css/index-user.css">
		<link rel="stylesheet" href="../css/newEvent.css">
	</head>
	<body>
		<header>
			<div id="mainMenu">
				<a href="index.php"><img src="../images/logo-header.png" alt="logo"></a>
				<nav>
					<ul>
						<li class="menu"><a href="#"><?php echo $user->selectFirstname($user_id);  ?></a></li>
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
				<div class="content-titre">
					<h2>Les befores</h2>
				</div>
				<div id="before">
					<?php  for ($i=0; $i < 5 ; $i++) { 
						echo '<div class="before">
								<img src="../images/bunker.jpg" alt="before">
								<h3>Nom du before</h3>
								<strong>Date et heure</strong>
							</div>';
					} ?>
					<strong></strong>
				</div>
			
				<div class="content-titre">
					<h2>Les Afters</h2>
				</div>
				<div id="after">
					<?php  for ($i=0; $i < 5 ; $i++) { 
						echo '<div class="after">
								<img src="../images/bunker.jpg" alt="after">
								<h3>Nom du after</h3>
								<strong>Date et heure</strong>
							</div>';
					} ?>
				</div>
		</div>
		<?php include '../include/formEvent.php'; ?>
		<footer>
			<a href="#">À propos</a> <a href="#">Aide</a><!--  <a href="#">État du service</a> <a href="#">Offres d'emploi</a> --> <a href="#">Conditions</a> <!-- <a href="#">Confidentialité</a> <a href="#">Informations sur la publicité</a>  --> <!-- <a href="#">Médias</a> --> <a href="#"> Développeurs</a> © 2015 Before-After
		</footer>
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