<section id="creatEvent">
			<img src="../images/logo-header.png" alt="création" style="width:50%;">
			<form>
				<select name="typeEvent" id="typeEvent">
					<option value="0" selected="selected">Type d'événement</option>
					<option value="Evenement">Evénement</option>
					<option value="Before">Before</option>
					<option value="After">After</option>
				</select>
				<select name="heure_deb_event" id="heure_deb_event">
					<option value="erreur" selected="selected">Heure de l'événement</option>
					<?php 
					$a = 0;
						while($a<24){
							$b=00;
							while($b<60){
								if($b==0){
									echo '<option value="'.$a.': 00">'.$a.': 00</option>';
								}elseif($a==0){
									echo '<option value="00 :'.$b.'">00 :'.$b.'</option>';
								}elseif($a == 0 && $b ==0){
									echo '<option value="00 : 00">00 : 00</option>';
								}else{
									echo '<option value="'.$a.':'.$b.'">'.$a.':'.$b.'</option>';
								}
								$b = $b + 15;
							}
							$a++;
						}
					 ?>
				</select>
				<select name="access" id="access">
					<option value="0">Acceptation :</option>
					<option value="manuelle">Manuellement</option>
					<option value="automatique">Automatiquement</option>
				</select>
				<input type="text" placeholder="Nom de votre événement" id="nameEvent" maxlength="25">
				<input type="text" placeholder="Date de votre événement" id="dateEvent" maxlength="10">
				<input type="text" placeholder="Adresse exacte de votre événement" id="lieuEvent" maxlength="100">
				<input type="text" placeholder="Votre ville" id="villeEvent" maxlength="100">
				<input type="number" placeholder="Place disponnible" id="place_user"/>
				<textarea  id="event_description" name="event_description" placeholder="Description"></textarea>
				<button type="button" id="annulEvent">Annuler</button>
				<button type="button" id="envoyerEvent">Créer</button>
				<div id="infoEvent"></div>
			</form>
		</section>