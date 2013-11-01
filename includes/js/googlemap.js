/*-----------------------------------------------------------------------------------*/
/* Googlemap - code from http://aquagraphite.com/
/*===================================================================================*/
jQuery(function($){
	$(document).ready(function(){
		$('.googlemap').each( function() {
			
			var $map_id = $(this).attr('id'),
			$title = $(this).find('.title').val(),
			$location = $(this).find('.location').val(),
			$zoom = parseInt( $(this).find('.zoom').val() ),
			geocoder, map;
			
			var mapOptions = {
				zoom: $zoom,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			geocoder = new google.maps.Geocoder();
			
			geocoder.geocode( { 'address': $location}, function(results, status) {
			
				if (status == google.maps.GeocoderStatus.OK) {
				
					var mapOptions = {
						scrollwheel: false,
						zoom: $zoom,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					
					map = new google.maps.Map($('#'+ $map_id + ' .map_canvas')[0], mapOptions);
					
					map.setCenter(results[0].geometry.location);
					
					var marker = new google.maps.Marker({
					  map: map, 
					  position: results[0].geometry.location,
					  title : $location
					});
					
					var contentString = '<div class="map-infowindow">'+
						( ($title) ? '<h3>' + $title + '</h3>' : '' ) + 
						$location + '<br/>' +
						'<a href="https://maps.google.com/?q='+ $location +'" target="_blank">View on Google Map</a>' +
						'</div>';
					
					var infowindow = new google.maps.InfoWindow({
					  content: contentString
					});
					
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					});
					
				} else {
					$('#'+ $map_id).html("Geocode was not successful for the following reason: " + status);
				}
			});
			
		});
	});
});
