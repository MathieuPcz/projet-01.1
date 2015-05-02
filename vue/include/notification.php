<section id="allnotif">
<img src="../images/logo-header.png" alt="création" style="width:50%;">
	<div id="sectionNotif">

	<?php 
	$count = $notification->countAllNotif($_SESSION['user']);
	$notif = $notification->selectAllNotif($_SESSION['user']);
	if($count>0){
		foreach ($notif as $value) {
		echo '<a href="../../controler/verifNotif.php?id='.$value['id'].'"><div class="allnotif"><strong>'.$value['description'].'</strong>
				<p>Le '.$value['notifDate'].'</p></div></a>';

		}
	}else{
		echo 'Aucune notification';
	}

	 ?>
	 <br>
	 <button id="fermerNotif">Fermer</button>

	</div>
</section>