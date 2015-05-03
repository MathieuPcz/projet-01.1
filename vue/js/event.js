$(document).ready(function(){

	/*recuper la variable get url*/
	$.urlParam = function(name){
		    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
		    return results[1] || 0;
		}
	var url = $.urlParam('id');


	/*gestion de l'événement modif suppr add....*/
	$('#validModif').click(function(){
		var choix = $('#choix').val();

		if(choix == '1'){
			$('.container').fadeOut();
			$('#modifierEvent').fadeIn(800);
		}else if(choix == '0'){
			$('.container').fadeOut();
			$('#inviteFriends').fadeIn(800);

		}else if(choix == '2'){
			$('#affiche').click();
			$('#affiche').change(function() {
			var file = document.querySelector('#affiche');
			var id = url;
			
			xhr = new XMLHttpRequest();
			xhr.open('POST','../../controler/modifImgEvent.php?id='+id);
			xhr.onload = function(){
				if(xhr.responseText != 1)
					{
						
						$('#imageBaniere').html(xhr.responseText);
						$('#infoModif').html('Modification réussie').fadeOut(3000);
						
					}else{
						
						alert('Seul les images peuvent être envoyées');
					}
			}
			xhr.upload.onprogress = function(e){
				
				$('#infoModif').html('Chargement en cours ...');
			}
			var form = new FormData();
			form.append('affiche',file.files[0]);
			xhr.send(form);
			return false;
		});
		}else if(choix ="4"){
			$('.container').fadeOut();
			$('#acceptUserPublic').fadeIn(800);
		}else{
			$('.container').fadeOut();
			$('#delete').fadeIn(800);
		}
	})
	
	$('#supprNon').click(function(){
		$('#delete').fadeOut();
		$('.container').fadeIn(800);
	})

		$('#supprOui').click(function(){
		
		$.ajax({
		type: "post",
		url: "../../controler/deleteEvent.php",
		data: {
			'id_event' : url
			},
			beforeSend: function(){
					$('#deleteEvent').html("<strong>Suppression en cours...</strong>").fadeIn(400);
					$('#deleteEvent').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == "success"){
				$('#deleteEvent').html("<strong>Suppression en cours...</strong>").fadeIn(400);
				window.location = "../user/";
				
				} else { 
					$('#deleteEvent').html(data).fadeIn(1000);
					$('#deleteEvent').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})


		$('#modifierContenuEvent').click(function(){
		
		$.ajax({
		type: "post",
		url: "../../controler/modifContenuEvent.php",
		data: {
			'id_event' : url,
			'typeEvent' : $('#modif_typeEvent').val(),
			'heure_deb_event' : $('#modif_heure_deb_event').val(),
			'access' : $('#modif_access').val(),
			'event' : $('#modif_event').val(),
			'nameEvent' : $('#modif_nameEvent').val(),
			'dateEvent' : $('#modif_dateEvent').val(),
			'lieuEvent' : $('#modif_lieuEvent').val(),
			'villeEvent' : $('#modif_villeEvent').val(),
			'event_description' : $('#modif_event_description').val(),
			'place_user' : $('#modif_place_user').val()
			},
			beforeSend: function(){
					$('#infoModifEvent').html("<strong>Modification en cours...</strong>").fadeIn(400);
					$('#infoModifEvent').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == "success"){
				$('#infoModifEvent').html("<strong>Modification en cours...</strong>").fadeIn(400);
				window.location = "../user/event.php?id="+url;
				
				} else { 
					$('#infoModifEvent').html(data).fadeIn(1000);
					$('#infoModifEvent').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})

	/*gere la participation ou non de l'user */
	$('#participe').click(function(){
					$.ajax({
					type: "post",
					url: "../../controler/verifParticipant.php",
					data: {
						'id_event' : url
						},
						beforeSend: function(){
								$('#infoParticipation').html("<strong>Enregistrement en cours...</strong>").fadeIn(400);
								$('#infoParticipation').css('color','#A5CBFF');
							},
						success: function(data){
							if(data == "success"){
								$('#infoParticipation').html('Inscription réussie, elle sera effective dès lors que l\'hôte de cet événement vous aura accepté !');
								window.location = "event.php?id="+url;
							
							} else { 
								$('#infoParticipation').html(data).fadeIn(1000);
								$('#infoParticipation').css('color','rgb(230,53,49)');
								
							}
						}
					});
				})
	$('#declineEvent').click(function(){
					$.ajax({
					type: "post",
					url: "../../controler/declineEvent.php",
					data: {
						'id_event' : url
						},
						beforeSend: function(){
								$('#infoParticipation').html("<strong>Modification en cours...</strong>").fadeIn(400);
								$('#infoParticipation').css('color','#A5CBFF');
							},
						success: function(data){
							if(data == "success"){
								$('#infoParticipation').html('Vous n\'êtes maintenant plus inscrit !').delay(1000);
								window.location = "event.php?id="+url;
							
							} else { 
								$('#infoParticipation').html(data).fadeIn(1000);
								$('#infoParticipation').css('color','rgb(230,53,49)');
								
							}
						}
					});
				});

		$('#annulerInvite').click(function(){
			$('#inviteFriends').fadeOut();
			$('.container').fadeIn(800);
		});
		
			$('#participeInviteEvent').click(function(){
					$.ajax({
					type: "post",
					url: "../../controler/valideInviteEvent.php",
					data: {
						'id_event' : url
						},
						beforeSend: function(){
								$('#infoParticipation').html("<strong>Enregistrement en cours...</strong>").fadeIn(400);
								$('#infoParticipation').css('color','#A5CBFF');
							},
						success: function(data){
							if(data == "success"){
								$('#infoParticipation').html('Inscription réussie, elle sera effective dès lors que l\'hôte de cet événement vous aura accepté !');
								window.location = "event.php?id="+url;
							
							} else { 
								$('#infoParticipation').html(data).fadeIn(1000);
								$('#infoParticipation').css('color','rgb(230,53,49)');
								
							}
						}
					});
				});
			$('#declineInviteEvent').click(function(){
					$.ajax({
					type: "post",
					url: "../../controler/declineEvent.php",
					data: {
						'id_event' : url
						},
						beforeSend: function(){
								$('#infoParticipation').html("<strong>Modification en cours...</strong>").fadeIn(400);
								$('#infoParticipation').css('color','#A5CBFF');
							},
						success: function(data){
							if(data == "success"){
								$('#infoParticipation').html('Vous n\'êtes maintenant plus inscrit !').delay(1000);
								window.location = "event.php?id="+url;
							
							} else { 
								$('#infoParticipation').html(data).fadeIn(1000);
								$('#infoParticipation').css('color','rgb(230,53,49)');
								
							}
						}
					});
				});

			$('.nbParticipant').click(function(){

				$('.container').fadeOut();
				$('#gestionInvite').fadeIn(800);
			})

			$('#annulInvite').click(function(){

				$('#gestionInvite').fadeOut();
				$('.container').fadeIn(800);
			})

			$('#annulerAcceptUserPublic').click(function(){
				$('#AcceptUserPublic').fadeOut();
				$('.container').fadeIn(800);
			})


			
})