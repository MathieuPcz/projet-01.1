<?php

include_once 'bdd.php';

$search = $_POST['search'];

$select = $bdd->prepare('SELECT ville_nom_simple FROM villes_france_free WHERE ville_nom_simple LIKE :search');
$select->execute(array('search' => $search.'%'));


$array = array(); // on créé le tableau

while($donnee = $select->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, '<a href="#" class="resultSearch" id="'.ucfirst($donnee['ville_nom_simple']).'"><li>'.$donnee['ville_nom_simple'].'</li></a>'); // et on ajoute celles-ci à notre tableau
}




$i=0;
foreach ($array as $value) {
	if($i>3){
		break;
	}else{
		echo $value;
	}
	$i++;
}
?>