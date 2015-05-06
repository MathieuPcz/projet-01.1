<?php 
session_start();
if(!empty($_SESSION['user'])){
	$user_id=$_SESSION['user'];
	include_once '../../controler/bdd.php';
	include_once '../../modele/register.php';
	$user = new User($bdd);
	include_once '../../modele/friends.php';
	$friends = new Friend($bdd);
	include_once '../../modele/newEvent.php';
	$event = new Event($bdd);
	include_once '../../modele/participant.php';
	$participant = new Participant($bdd);
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
		<link rel="stylesheet" href="../css/tchat.css">
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
				<?php include_once '../include/menuHeader.php'; ?>
			</nav>
			</div>
		</header>
		<div class="tchat">
			<?php include_once '../include/discussion.php' ?>
		</div>
		<div class="container">
				<div id="cadre">
					<div id="contentEvent">
					<select  id="trier">
						<option value="0">Trier par</option>
						<option value="1">Evénement</option>
						<option value="2">Before</option>
						<option value="3">After</option>
					</select><input type="text" placeholder="Recherche par ville..." id="searchVilleEvent">
					<div id="resultSearchVilleEvent"></div><button id="validerTrie">Valider</button>

					<button id="newEvent">Créer</button>
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
	
		</div>
		<div class="discut">
				<div class="refreshTchat"></div>
				<input type="text" placeholder="Votre message ..." class="newMessageTchat" autofocus>
		</div>
		<?php include '../include/notification.php'; ?>
		<?php include '../include/formEvent.php'; ?>
		
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/allPage.js"></script>
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



	/*recherche ville avec trie*/
	$('#searchVilleEvent').keyup(function(){
		if($(this).val().length > 2){

				$.ajax({
				type: "post",
				url: "../../controler/verifVille.php",
				data: {
					'search' : $('#searchVilleEvent').val()
					},
					success: function(data){
						$('#resultSearchVilleEvent').html('<ul>'+data+'</ul>').fadeIn();
						
						
					}
				});	
		}else{
			$('#resultSearchVilleEvent').fadeOut();
		}
	});

	$('.resultSearch').live('click', function(){

		var id = $(this).attr('id');
		$('#searchVilleEvent').val(id);
		$('#resultSearchVilleEvent').fadeOut();
	})

	$('.container').live('click',function(){
		$('#resultSearchVilleEvent').fadeOut();
	})
	$('.tchat').live('click',function(){
		$('#resultSearchVilleEvent').fadeOut();
	})
	$('header').live('click',function(){
		$('#resultSearchVilleEvent').fadeOut();
	})

	$('#validerTrie').live('click',function(){


		$.ajax({
				type: "post",
				url: "../../controler/trieEvent.php",
				data: {
					'search' : $('#searchVilleEvent').val(),
					'trier' : $('#trier').val(),
					},
					success: function(data){
						$('#before').html(data);						
					}
				});	

	})


					$.urlParam = function(name){
		    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
		    return results[1] || 0;
		}
	var url = $.urlParam('discut');
	if(url){
		var id_user2 = url;

		
		$('.discut').fadeIn();
				$.ajax({
				type: "post",
				url: "../../controler/tchatPrivee.php",
				data: {
					'id_user2' : id_user2
					},
					success: function(data){
						$('.discut').html(data);
						
						
					}
				});	
		
			clearInterval(refreshMessage);
	}
});
		</script>
	</body>
</html>