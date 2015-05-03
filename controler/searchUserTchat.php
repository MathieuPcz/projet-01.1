<?php
session_start();
include_once 'bdd.php';
include_once '../modele/register.php';
$user = new User($bdd);

$search = $_POST['search'];
$id_user = $_SESSION['user'];
$select = $bdd->prepare('SELECT id_user2,longname FROM friends WHERE id_user=:id_user AND longname LIKE :search');
$select->execute(array('id_user'=>$id_user,
				'search' => '%'.$search.'%'));
$result = $select;

$array = array(); // on créé le tableau
echo '<div id="friendTchat"><div class="tchatCategories"><strong>Résultat</strong></div>';
foreach ($result as $donnee){
	$connect = $user->selectConnect($donnee['id_user2']);
	if(!empty($user->selectAvatar($donnee['id_user2']))){
	 $avatar = $user->selectAvatar($donnee['id_user2']);
	}else{
		$avatar = '<img src="../images/logo-header.png" alt="no-avatar" class="avatarTchat" style="height:40px;">';
	}
	if($connect==0){
		    array_push($array, '<div class="selectUser" id="'.$donnee['id_user2'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$donnee['longname'].'</p><div class="noconnect"></div></div>');

	}else{
		    array_push($array, '<div class="selectUser" id="'.$donnee['id_user2'].'"><div class="imgTchatUser">'.$avatar.'</div><p>'.$donnee['longname'].'</p><div class="connect"></div></div>'); // et on ajoute celles-ci à notre tableau

	}
}


$i=0;
foreach ($array as $value) {
	if($i>4){
		break;	
	}else{
		echo $value;
	}
}

?>