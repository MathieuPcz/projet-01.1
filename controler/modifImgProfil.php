<?php
session_start();
include_once ('bdd.php');
include_once ('../modele/register.php');
$user = new User($bdd);

if(!empty($_FILES['affiche'])&& isset($_GET['id']))
	{
		$id_user=$_GET['id'];
		$dossier= '../vue/images/user/';
		$fichier=$id_user.$_FILES['affiche']['name'];
		$verif_image=$_FILES['affiche']['tmp_name'];
		
		if(getimagesize($verif_image))
			{
			
			if(move_uploaded_file($_FILES['affiche']['tmp_name'], $dossier . $fichier))
				{		
				$modif_img=$id_user.$_FILES['affiche']['name'];
				$user->modifAvatar($id_user,$modif_img);
					
				echo '<img src="../images/user/'.$id_user.$_FILES['affiche']['name'].'" id="avatar" "/>';	
				}

			}else{
			echo 1;
			}
	}
?>
  