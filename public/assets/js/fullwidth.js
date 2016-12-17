( function( $ ) {
	"use strict";

	var fullWidthSite = function() {
		$('.wc-shortcodes-full-width').each( function() {
			var $this,
				siteWidthId,
				$siteWidth,
				$contentWidth,
				siteWidth,
				contentWidth,
				// sitePos,
				// contentPos,
				marginLeft,
				marginRight;

			$this = $(this);

			// get selector names
			siteWidthId = $(this).data('selector');

			// save elements
			$siteWidth = $( siteWidthId );
			$contentWidth = $this.parent();
			if ( $siteWidth.length && $contentWidth.length ) {
				// get width
				siteWidth = $siteWidth.outerWidth( false );
				contentWidth = $contentWidth.width();

				// get position
				// sitePos = $( siteWidthId ).offset();
				// contentPos = $contentWidth.offset();

				// calculate margin
				// marginLeft = Math.floor( contentPos.left - sitePos.left ) * -1;
				// marginRight = Math.floor( siteWidth - contentWidth + sitePos.left - contentPos.left ) * -1;

				// used for centering.
				marginLeft = marginRight = Math.floor( ( siteWidth - contentWidth ) / 2 ) * -1;

				// apply margin offset
				$this.css( {'margin-left': marginLeft+'px', 'margin-right': marginRight+'px', 'visibility':'visible'} );
			}
		});
	};
	fullWidthSite();

	$(window).resize( fullWidthSite );

} )( jQuery );
