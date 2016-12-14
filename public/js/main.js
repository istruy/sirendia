$(document).ready(function() {			
	$("#owl-demo").owlCarousel({	
	  autoPlay : 7000,
	  swapSpeed : 1000,
	  slideSpeed : 2000,
	  singleItem:true,	
	  pagination:false			
	});
	

	$('#sign-in').click( function(event){
		event.preventDefault();
		$('#overlay').fadeIn(400,
		 	function(){
				$('#enterForm')
					.css('display', 'block')
					.animate({opacity: 1, top: '50%'}, 200); 
		});
	});
	$('#overlay').click( function(){
		$('#enterForm')
			.animate({opacity: 0, top: '45%'}, 200, 
				function(){
					$(this).css('display', 'none');
					$('#overlay').fadeOut(400);
				}
			);
	});	
});


function onLog(){
	var login = $('input[name=login]').val();
	var password = $('input[name=password]').val();

	$.ajax({
		type: "POST",
		url: "/profile",
		data: {action: "enter", login: login, password: password},
	}).done(function(data) {
		var res = data;
		if (res === "success"){
			window.location.reload();
		} else {
			$('#errors').text(res);
		}
	});
}

function setLike(obj) {
	if($(obj).hasClass('fa-heart-o')) {
		$(obj).removeClass('fa-heart-o');
		$(obj).addClass('fa-heart');
	} else {
		$(obj).addClass('fa-heart-o');
		$(obj).removeClass('fa-heart');
	}
}

function quickView(obj) {
	var id = $(obj).closest('figure').attr('id');
	$.ajax({
		type: "POST",
		url: "/goods/index.php",
		data: {action: "type", id: id},
		success: function(data) {
			window.location.href = '/goods/' + data + '/' + id;	
		}
	});
	
}

