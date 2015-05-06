<ul>
					<li class="menu"><?php echo '<a href="user.php?id='.$_SESSION['user'].'">';  ?><?php echo '<div id="imgAvatar">'.$user->selectAvatar($_SESSION['user']).'</div>'; ?><?php echo '<div id="nameAvatar">'.$user->selectFirstname($user_id).'</div>';  ?></a></li>
					<li class="menu"><a href="../user/">Evénements</a></li>
						<li class="menu" id="notificationMenu"><a href="#">Notification	<?php 
								$nbNotif = $notification->countNotif($_SESSION['user'],0);
								if($nbNotif>0){
									$nbNotif = '<strong class="notification">'.$nbNotif.'</strong>';
								}
								echo '<div id="numberNotif">'.$nbNotif.'</div>'; ?></a>
							<ul class="menu_ul">
								<?php 
								$result = $notification->selectAllNotif($_SESSION['user']);
								$i=0;
								foreach($result as $value){

									if(empty($value['id'])){
										echo'Aucune notification';
									}elseif($i>2){
										break;
									}else{
										echo '<li class="sousMenu"><a href="../../controler/verifNotif.php?id='.$value['id'].'">'.$value['description'].'</a></li>';

									}
									$i++;		
									}
									
								 ?>
								 <li class="sousMenu"><a href="#" id="allNotification">Voir toutes les notifications</a></li>
							</ul>
			
						</li>
					<li class="menu"><a href="../../controler/disconnect.php">Déconnexion</a></li>
				</ul>