jQuery(function($){
	$(document).ready(function(){
		
		// Toggle
		$("h3.wc-toggle-trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("fast");
			return false; //Prevent the browser jump to the link anchor
		});
					
		// UI tabs
		$( ".wc-tabs" ).tabs();
		
		// UI accordion
		$(".wc-accordion").accordion({autoHeight: false});		

	}); // END doc ready
}); // END function ($)
