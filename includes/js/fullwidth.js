( function( $ ) {
	var fullWidthSite = function() {
		var siteWidth = $('#page').width();
		var contentWidth = $('#content').width();
		var margin = Math.floor( ( siteWidth - contentWidth ) / 2 ) * -1;
		$('body.fullwidth .wc-full-width-site').css( {'margin-left': margin+'px', 'margin-right': margin+'px'} );
	}
	fullWidthSite();
	$(window).resize( fullWidthSite );
} )( jQuery );
