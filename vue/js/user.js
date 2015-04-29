$(document).ready(function(){

	$.urlParam = function(name){
		    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
		    return results[1] || 0;
		}
	var url = $.urlParam('id');

	$('#valider').click(function(){
		var choix = $('#modifierProfil').val();

		if(choix == '0'){
			$('.container').fadeOut();
			$('#modifProfilRegister').fadeIn(800);
		}else if(choix == '1'){
			$('#affiche').click();
			$('#affiche').change(function() {
				var file = document.querySelector('#affiche');
				var id = url;
				
				xhr = new XMLHttpRequest();
				xhr.open('POST','../../controler/modifImgProfil.php?id='+id);
				xhr.onload = function(){
					if(xhr.responseText != 1)
						{
							
							$('#profilImg').html(xhr.responseText);
							$('#modifProfilInfo').html('Modification réussie').fadeOut(3000);
							
						}else{
							
							alert('Seul les images peuvent être envoyées');
						}
				}
				xhr.upload.onprogress = function(e){
					
					$('#modifProfilInfo').html('Chargement en cours ...');
				}
				var form = new FormData();
				form.append('affiche',file.files[0]);
				xhr.send(form);
				return false;
			});
		}else if(choix == '2'){
			$('#newPass').fadeIn(800);
		}else{
			$('.container').fadeOut();
			$('#delete').fadeIn(800);
		}
	})

	$('#stopModifPass').click(function(){
		$('#newPass').fadeOut();
	})

	$('#annulerProfilRegister').click(function(){
		$('#modifProfilRegister').fadeOut();
		$('.container').fadeIn(800);
	})
	
	$('#supprNon').click(function(){
		$('#delete').fadeOut();
		$('.container').fadeIn(800);
	})

		$('#supprOui').click(function(){
		
		$.ajax({
		type: "post",
		url: "../../controler/deleteProfil.php",
		data: {
			'id_user' : url
			},
			beforeSend: function(){
					$('#modifProfilInfo').html("<strong>Suppression en cours...</strong>").fadeIn(400);
					$('#modifProfilInfo').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == "success"){
				$('#modifProfilInfo').html("<strong>Suppression en cours...</strong>").fadeIn(400);
				window.location = "../../";
				
				} else { 
					$('#modifProfilInfo').html(data).fadeIn(1000);
					$('#modifProfilInfo').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})


		$('#modifierProfilRegister').click(function(){
		
		$.ajax({
		type: "post",
		url: "../../controler/modifContenuProfil.php",
		data: {
			'id_user' : url,
			'love' : $('#modif_love').val(),
			'name' : $('#modif_name').val(),
			'firstname' : $('#modif_firstname').val(),
			'city' : $('#modif_city').val(),
			'email' : $('#modif_email').val(),
			'age' : $('#modif_age').val(),
			'profession' : $('#modif_profession').val(),
			'naissance' : $('#modif_naissance').val(),
			'etude' : $('#modif_etude').val(),
			'citation' : $('#modif_citation').val(),
			'description' : $('#modif_description').val()
			},
			beforeSend: function(){
					$('#modifInfo').html("<strong>Modification en cours...</strong>").fadeIn(400);
					$('#modifInfo').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == 1){
				$('#modifInfo').html("<strong>Modification en cours...</strong>").fadeIn(400);
				window.location = "../user/user.php?id="+url;
				
				} else{ 
					$('#modifInfo').html(data).fadeIn(1000);
					$('#modifInfo').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})

$('#modifPassword').click(function(){
		
		$.ajax({
		type: "post",
		url: "../../controler/modifPassword.php",
		data: {
			'id_user' : url,
			'pass' : $('#pass').val(),
			'newpass' : $('#newpass').val(),
			'repass' : $('#repass').val()
			},
			beforeSend: function(){
					$('#infoPass').html("<strong>Modification en cours...</strong>").fadeIn(400);
					$('#infoPass').css('color','#A5CBFF');
				},
			success: function(data){
				if(data == 1){
				$('#infoPass').html("<strong>Modification en cours...</strong>").fadeIn(400);
				window.location = "../user/user.php?id="+url;
				
				} else{ 
					$('#infoPass').html(data).fadeIn(1000);
					$('#infoPass').css('color','rgb(230,53,49)');
					
				}
			}
		});
	})


})