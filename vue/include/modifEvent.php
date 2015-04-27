<section id="modifierEvent">
			<img src="../images/logo-register.png" alt="création" style="width:50%;">
			<form>
				<select name="typeEvent" id="modif_typeEvent">
					<option value="<?php echo $event->selectTypeEvent($id_event); ?>" selected="selected"><?php echo $event->selectTypeEvent($id_event); ?></option>
					<option value="Before">Before</option>
					<option value="After">After</option>
				</select>
				<select name="heure_deb_event" id="modif_heure_deb_event">
					<option value="<?php echo $event->selectHeure_deb_event($id_event); ?>" selected="selected"><?php echo $event->selectHeure_deb_event($id_event); ?></option>
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
				<select name="access" id="modif_access">
					<option value="<?php echo $event->selectAccess($id_event); ?>"><?php echo $event->selectAccess($id_event); ?></option>
					<option value="manuelle">Manuellement</option>
					<option value="automatique">Automatiquement</option>
				</select>
				<input type="text" value="<?php echo $event->selectNameEvent($id_event); ?>" id="modif_nameEvent" maxlength="25">
				<input type="text" value="<?php echo $event->selectEvent($id_event); ?>" id="modif_event" maxlength="25">
				<input type="text" value="<?php echo $event->selectDateEvent($id_event); ?>" id="modif_dateEvent" maxlength="10">
				<input type="text" value="<?php echo $event->selectLieuEvent($id_event); ?>" id="modif_lieuEvent" maxlength="100">
				<input type="number" value="<?php echo $event->selectPlaceUser($id_event); ?>" id="modif_place_user"/>
				<textarea  id="modif_event_description" name="event_description" ><?php echo $event->selectDescription($id_event); ?></textarea>
				<button type="button" id="annulModifEvent">Annuler</button>
				<button type="button" id="modifierContenuEvent">Modifier</button>
				<div id="infoModifEvent"></div>
			</form>
		</section>