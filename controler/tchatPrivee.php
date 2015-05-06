<?php 
session_start();
	include_once 'bdd.php';
	include_once '../modele/register.php';
	$user = new User($bdd);
	include_once '../modele/tchat.php';
	$tchat = new Tchat($bdd);
	$id_user = $_SESSION['user'];
	$id_user2 = $_POST['id_user2'];
	$name = $user->selectLongname($id_user2);
	 
	if($user->selectConnect($id_user2) == 0){
		$connect = '<div class="noconnect" style="margin-top:5px;"></div>';
	}else{
		$connect = '<div class="connect" style="margin-top:5px;"></div>';
	}

	echo '<div class="titleUser">'.$connect.'<a href="user.php?id='.$id_user2.'"><strong>'.$name.'</strong></a><img src="../images/croix.png" class="croix" alt="close"></div>
			<div class="messageUser" id="scroll">';
			
	
		echo '</div>
			<input type="text" placeholder="Votre message ..." class="newMessageTchat" id="'.$id_user2.'" autofocus>';
			
		
		
 ?>