
<?php

include_once 'bdd.php';

$search = $_POST['search'];

$select = $bdd->prepare('SELECT id,longname,avatar FROM user WHERE longname LIKE :search');
$select->execute(array('search' => '%'.$search.'%'));


$array = array(); // on créé le tableau

while($donnee = $select->fetch()) // on effectue une boucle pour obtenir les données
{
	if(!empty($donnee['avatar'])){
		$img = '<img src="../images/user/'.$donnee['avatar'].'" alt="avatar">'; 
	}else{
		$img='';
	}
    array_push($array, '<a href="user.php?id='.$donnee['id'].'"><li><div class="imgSearch">'.$img.'</div>'.$donnee['longname'].'</li></a>'); // et on ajoute celles-ci à notre tableau
}



$select = $bdd->prepare('SELECT id,nameEvent FROM event WHERE nameEvent LIKE :search');
$select->execute(array('search' => '%'.$search.'%'));

while($donnee = $select->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, '<a href="event.php?id='.$donnee['id'].'"><li>'.$donnee['nameEvent'].'</li></a>'); // et on ajoute celles-ci à notre tableau
}


$i=0;
foreach ($array as $value) {
	if($i>4){
		exit();
	}else{
		echo $value;
	}
}
?>