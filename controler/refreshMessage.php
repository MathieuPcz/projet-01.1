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
	$message = $tchat->selectAllMessage($id_user,$id_user2);
				foreach ($message as $value) {
			if($user->selectLongname($_SESSION['user']) != $value['longname']){
				$avatar = $user->selectAvatar($id_user);
					if(!empty($avatar)){
					$avatar = $user->selectAvatar($id_user);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar">';
				}
				echo '<div class="user1"><div class="messageprivee" id="'.$value['dateMessage'].'"><div class="avatarMessage">'.$avatar.'</div><p>'.$value['message'].'</p><div class="dateMessage">'.$value['dateMessage'].'</div></div></div>';
			}else{
				$avatar = $user->selectAvatar($id_user2);
					if(!empty($avatar)){
					$avatar = $user->selectAvatar($id_user2);
				}else{
					$avatar = '<img src="../images/logo-header.png" alt="no-avatar">';
				}
				echo '<div class="user2"><div class="messageprivee" id="'.$value['dateMessage'].'"><div class="avatarMessage">'.$avatar.'</div><p>'.$value['message'].'</p><div class="dateMessage">'.$value['dateMessage'].'</div></div></div>';
			}
			

		}

?>