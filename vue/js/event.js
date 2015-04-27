$(document).ready(function(){

	$.urlParam = function(name){
		    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
		    return results[1] || 0;
		}
	var url = $.urlParam('id');

	$('#validModif').click(function(){
		var choix = $('#choix').val();

		if(choix == '1'){
			alert('1');
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
})