<div id="modifProfilRegister">
	<img src="../images/logo-header.png" alt="Inscription">
	<form>
		<select  id="modif_love">
			<option value="Célibataire">Célibataire</option>
			<option value="En couple">En couple</option>
			<option value="none">Pas intéressé</option>
		</select>

		<input type="text" id="modif_name" maxlength="25"  value="<?php echo $user->selectName($id_user); ?>">
		<input type="text"  id="modif_firstname" maxlength="25" value="<?php echo $user->selectFirstname($id_user); ?>">
		<input type="text" placeholder="Votre ville" id="modif_city" maxlength="25" value="<?php echo $user->selectLieu($id_user); ?>">

		<input type="email" placeholder="Votre âge"  id="modif_age" value="<?php if(!empty($user->selectAge($id_user))){echo $user->selectAge($id_user);} ?>">
		<input type="email" placeholder="Votre profession actuelle"  id="modif_profession" value="<?php if(!empty($user->selectProfession($id_user))){echo $user->selectProfession($id_user);} ?>">
		<input type="email" placeholder="Votre lieu de naissance"  id="modif_naissance" value="<?php if(!empty($user->selectNaissance($id_user))){echo $user->selectNaissance($id_user);} ?>">
		<input type="email" placeholder="Votre niveau d'étude"  id="modif_etude" value="<?php if(!empty($user->selectEtude($id_user))){echo $user->selectEtude($id_user);} ?>">
		<textarea  id="modif_citation" class="firstTextarea" Placeholder="Votre citation favorite"><?php if(!empty($user->selectCitation($id_user))){echo $user->selectCitation($id_user);} ?></textarea>
		<textarea  id="modif_description" Placeholder="Decrivez vous"><?php if(!empty($user->selectDescription($id_user))){echo $user->selectDescription($id_user);} ?></textarea>
		<div id="modifButton"><button id="annulerProfilRegister" type="button">Annuler</button>
		<button type="button" id="modifierProfilRegister">Modifier</button></div>
		<div id="modifInfo"></div>
	</form>
</div>
