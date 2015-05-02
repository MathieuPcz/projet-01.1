$(document).ready(function(){
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
	})
	$('.container').click(function(){
		$('#resultSearch').fadeOut();
	})
	$('.tchat').click(function(){
		$('#resultSearch').fadeOut();
	})

	$('#allNotification').click(function(){
		$('.container').fadeOut();
		$('#allnotif').fadeIn(800);
	})

	$('#fermerNotif').click(function(){
		$('#allnotif').fadeOut();
		$('.container').fadeIn(800);

	})
})
