<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
	include_once '../../modele/newEvent.php';
	$event= new Event($bdd);
	include_once '../../modele/notification.php';
	$notification = new Notification($bdd);
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
				<div id="recherche">
					<input type="text" id="search" placeholder="Rechercher un utilisateur, un événement ...">
					<div id="resultSearch"></div>
				</div>
				<nav>
					<ul>
						<li class="menu"><?php echo '<a href="user.php?id='.$_SESSION['user'].'">';  ?><?php echo $user->selectAvatar($user_id); ?><?php echo $user->selectFirstname($user_id);  ?></a></li>
						<li class="menu"><a href="#">Evénements</a>
							<ul class="menu_ul">
								<li class="sousMenu"><a href="#" id="newEvent">Créer</a></li>
								<li class="sousMenu"><a href="#">Before-After</a></li>
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
					<h2>Les befores-After</h2>
					
				</div>
				<div id="before">
					<?php 
					$variable = $event->selectAllEvent();
					foreach ($variable as $value) {
						$date = new DateTime($value['dateEvent']);
						$newdate =$date->format('d/m/Y');
						if(!empty($value['imgEvent'])){
							$image = '<img src="../images/event/'.$value['imgEvent'].'" alt="imgEvent">';
						}else{
							$image = '<img src="../images/logo-header.png" alt="imgEvent" style="width:130%; margin-left:-6%; margin-top:20%;">';
						}
						echo '<a href="event.php?id='.$value['id'].'"><div class="before">
								<div class="imageBefore">'.$image.'</div>
								<h3>'.$value['typeEvent'].' - '.$value['nameEvent'].'</h3>
								<strong>Le '.$newdate.' à '.$value['heure_deb_event'].'</strong>
							</div></a>';
					}

					?>
					<strong></strong>
				</div>
	
		</div>
		<?php include '../include/notification.php'; ?>
		<?php include '../include/formEvent.php'; ?>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/search.js"></script>
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