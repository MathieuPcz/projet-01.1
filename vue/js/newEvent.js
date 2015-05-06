$(document).ready(function(){
	/*verif et envoie de l'event à la bdd*/
	$('#event').keyup(function(){
		if($(this).val().length < 3){
		$('#event').css('background-color','#E89103');
		$('#infoEvent').html('<br>3 caractères minimum').fadeIn(1000);
		$('#infoEvent').css('color','#E89103');
		$('#event').css('color','white');
		
		}else{
			$('#event').css('background-color','#A5CBFF');
			$('#event').css('color','white');
			$('#infoEvent').fadeOut(1000);
		}
	})

	$('#nameEvent').keyup(function(){
		if($(this).val().length < 3){
		$('#nameEvent').css('background-color','#E89103');
		$('#infoEvent').html('<br>3 caractères minimum').fadeIn(1000);
		$('#infoEvent').css('color','#E89103');
		$('#nameEvent').css('color','white');
		
		}else{
			$('#nameEvent').css('background-color','#A5CBFF');
			$('#nameEvent').css('color','white');
			$('#infoEvent').fadeOut(1000);
		}
	})
	$('#dateEvent').keyup(function(){
		if($(this).val().length < 10){
		$('#dateEvent').css('background-color','#E89103');
		$('#infoEvent').html('<br>Veuillez écrire une date de type jj/mm/aaaa').fadeIn(1000);
		$('#infoEvent').css('color','#E89103');
		$('#dateEvent').css('color','white');
		
		}else{
			$('#dateEvent').css('background-color','#A5CBFF');
			$('#dateEvent').css('color','white');
			$('#infoEvent').fadeOut(1000);
		}

	})
	$('#lieuEvent').keyup(function(){
		if($(this).val().length < 3 ){
		$('#lieuEvent').css('background-color','#E89103');
		$('#infoEvent').html('<br>3 caractères minimum').fadeIn(1000);
		$('#infoEvent').css('color','#E89103');
		$('#lieuEvent').css('color','white');
		
		}else{
			$('#lieuEvent').css('background-color','#A5CBFF');
			$('#lieuEvent').css('color','white');
			$('#infoEvent').fadeOut(1000);
		}

	})

	$('#place_user').keyup(function(){
		if(parseInt($(this).val()) ){
			$('#place_user').css('background-color','#A5CBFF');
			$('#place_user').css('color','white');
			$('#infoEvent').fadeOut(1000);
		
		
		}else{
			$('#place_user').css('background-color','#E89103');
		$('#infoEvent').html('<br>Veuillez entrer un nombre').fadeIn(1000);
		$('#infoEvent').css('color','#E89103');
		$('#place_user').css('color','white');
		}

	})
	$('#register_email').keyup(function(){
		$.ajax({
		type: "post",
		url: "controler/verifMail.php",
		data: {
			'email' : $('#register_email').val()
			},
			success: function(data){
				if(data == "success"){
				$('#register_email').css('background-color','#A5CBFF');
				$('#register_email').css('color','white');
				$('#infoEvent').fadeOut(1000);
				
				} else { 
					$('#register_email').css('background-color','#E89103');
					$('#register_email').css('color','white');
					$('#infoEvent').html('<br>'+data).fadeIn(1000);
					$('#infoEvent').css('color','#E89103');
					
				}
			}
		});
	})

	
	$('#envoyerEvent').click(function(){
		$.ajax({
		type: "post",
		url: "../../controler/verifEvent.php",
		data: {
			'typeEvent' : $('#typeEvent').val(),
			'heure_deb_event' : $('#heure_deb_event').val(),
			'access' : $('#access').val(),
			'villeEvent' : $('#villeEvent').val(),
			'nameEvent' : $('#nameEvent').val(),
			'dateEvent' : $('#dateEvent').val(),
			'lieuEvent' : $('#lieuEvent').val(),
			'event_description' : $('#event_description').val(),
			'place_user' : $('#place_user').val()
			},
			beforeSend: function(){
					$('#infoEvent').html("<strong>Création en cours...</strong>").fadeIn(400);
					$('#infoEvent').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == "success"){
				
				
				} else { 
					$('#infoEvent').html(data).fadeIn(1000);
					$('#infoEvent').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})	

	
});