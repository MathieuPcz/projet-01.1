<?php
session_start();
include_once ('bdd.php');
include_once ('../modele/newEvent.php');
$event = new Event($bdd);

if(!empty($_FILES['affiche'])&& isset($_GET['id']))
	{
		$id=$_GET['id'];
		$id_user=$_SESSION['user'];
		$dossier= '../vue/images/event/';
		$fichier=$id_user.$_FILES['affiche']['name'];
		$verif_image=$_FILES['affiche']['tmp_name'];
		
		if(getimagesize($verif_image))
			{
			
			if(move_uploaded_file($_FILES['affiche']['tmp_name'], $dossier . $fichier))
				{		
				$modif_img=$id_user.$_FILES['affiche']['name'];
				$event->modifImg($modif_img,$id);
					
				echo '<img src="../images/event/'.$id_user.$_FILES['affiche']['name'].'" id="" style="width:100%; "/>';	
				}

			}else{
			echo 1;
			}
	}
?>
  