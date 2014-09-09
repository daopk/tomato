$( document ).ready(function() {
	newwish = $('.new-wish');

	setTimeout(function() {
    	animation.hideoverlay();
    }, 500);

	newwish.click(function(event) {
		/* Act on the event */
		animation.showoverlay();
		animation.hideloading();
		addwish.show();
	});

	$('#cancel').click(function(event) {
		/* Act on the event */
		addwish.hide();
	});
});


var animation = {
	hideloading : function(){
   		$('.innerpoop').hide();
	},
	showloading : function(){
		$('.innerpoop').show();
	},
	hideoverlay : function(){
		$('.overlay').hide();	
	},
	showoverlay : function(){
		$('.overlay').show();	
	}
}

var addwish = {
	show : function(){
		$('.add-wish').show();
	},
	send : function(){
		// Sent wish
		addwish.hide();
	},
	hide : function(){
		$('.add-wish').hide();
		animation.hideoverlay();
	}
}