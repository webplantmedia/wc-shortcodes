jQuery(function($){
	$(document).ready(function(){
		$('.wc-skillbar').each(function(){
			$(this).find('.wc-skillbar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
		});
	});
});
