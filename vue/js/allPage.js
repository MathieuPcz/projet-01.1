$(document).ready(function(){
	/*desactive session*/
    function session(){
        window.location="valide_dec.php"; //page de déconnexion
    }
    setTimeout("session()",600000); //ça fait bien 5min??? c'est pour le test

	/*recherche barre du haut (amis + event)*/
	$('#search').keyup(function(){
		if($(this).val().length > 2){

				$.ajax({
				type: "post",
				url: "../../controler/search.php",
				data: {
					'search' : $('#search').val()
					},
					success: function(data){
						$('#resultSearch').html('<ul>'+data+'</ul>').fadeIn();
						
						
					}
				});	
		}else{
			$('#resultSearch').fadeOut();
		}
	});
	$('.container').click(function(){
		$('#resultSearch').fadeOut();
	});
	$('.tchat').click(function(){
		$('#resultSearch').fadeOut();
	});

	$('#allNotification').live("click",function(){
		$('.container').fadeOut();
		$('#allnotif').fadeIn(800);
	});

	$('#fermerNotif').click(function(){
		$('#allnotif').fadeOut();
		$('.container').fadeIn(800);

	});
	
	/*affiche user tchat */
	setInterval(function() {
        $.ajax({
				type: "post",
				url: "../../controler/tchat.php",
				data: {
					
					},
					success: function(data){
						$('#refreshAmiTchat').html(data);
						if(!data){
							$('.tchatsousCategories').append('Aucun utilisateur(public) inscrit');
						}
						
					}
				});	
        }, 500);

		/*recherche user tchat*/
		$('#searchUserTchat').keyup(function(){
		if($(this).val().length > 1){
				$('#fadeOutTchat').fadeOut();
				$.ajax({
				type: "post",
				url: "../../controler/searchUserTchat.php",
				data: {
					'search' : $('#searchUserTchat').val()
					},
					success: function(data){
						$('#resultSearchUser').html(data).fadeIn();
						
						
					}
				});	
		}else{
			$('#resultSearchUser').fadeOut();
			$('#fadeOutTchat').fadeIn();
		}
	})
		/*refreshscrollbar pour qu'elle soit au bottom*/
		var scrollBottomBar = function(){
			var id = $('.messageUser').attr('id');
			element = document.getElementById(id);
			element.scrollTop = element.scrollHeight;
		}

		/*fait apparaitre fenetre discussion avec message de la personnne selectionner*/
	$('.selectUser').live("click", function(){
		var id_user2 = ($(this).attr("id"));
		var nbClick = 0; 
		nbClick++;

		
		$('.discut').fadeIn();
				$.ajax({
				type: "post",
				url: "../../controler/tchatPrivee.php",
				data: {
					'id_user2' : id_user2
					},
					success: function(data){
						$('.discut').html(data);
						
		
						
					}
				});	
		
			clearInterval(refreshMessage);
			
		
	});

	$('.messageUser').live('click',function(){
		clearInterval(scrollBottomBar);
	})
		var refreshMessage = (function(){
				var id_user2 = ($('.newMessageTchat').attr("id"));
						$.ajax({
						type: "post",
						url: "../../controler/refreshMessage.php",
						data: {
							'id_user2' : id_user2
							},
							success: function(data){
								$('.messageUser').html(data);
								setInterval(scrollBottomBar,500);

								
							}
						});
				});
		setInterval(refreshMessage, 300);




	$('.croix').live('click', function(){
		$('.discut').fadeOut();
	})


		/*envoie le message a la personne qui a avait été sélectionner précédement*/
		$('.newMessageTchat').live('keypress',function(e){
	    if( e.which == 13 ){
	       var id_user2 = ($(this).attr("id"));
	    	
				$.ajax({
				type: "post",
				url: "../../controler/envoieMessagePrivee.php",
				data: {
					'id_user2' : id_user2,
					'message' : $('.newMessageTchat').val(),
					'longname' : $('.titleUser strong').val()
					},
					success: function(data){
						
						$('.newMessageTchat').val('');

					}
				});	
	    }
	});

		/*informe que le message a été lu*/
	$('.newMessageTchat').live('click', function(){
		var id_user2 = ($(this).attr("id"));
		$.ajax({
				type: "post",
				url: "../../controler/lookmessage.php",
				data: {
					'id_user2' : id_user2,
					},
					success: function(data){
						
					}
				});	
	})

	/*recharge les notifications*/
	setInterval(function(){

		$.ajax({
				type: "post",
				url: "../../controler/loadNotif.php",
				data: {
					},
					success: function(data){
						$('#notificationMenu').html(data);
					}
				});	

	},500);

})