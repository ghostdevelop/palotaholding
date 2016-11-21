
function initMap() {    
	      	var style = [
			    {
			        "featureType": "all",
			        "stylers": [
			            {
			                "saturation": 0
			            },
			            {
			                "hue": "#e7ecf0"
			            }
			        ]
			    },
			    {
			        "featureType": "road",
			        "stylers": [
			            {
			                "saturation": -70
			            }
			        ]
			    },
			    {
			        "featureType": "transit",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "poi",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "water",
			        "stylers": [
			            {
			                "visibility": "simplified"
			            },
			            {
			                "saturation": -60
			            }
			        ]
			    }
			];
	// Create a map object and specify the DOM element for display.
	var map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat:locations[0].location.lat, lng: locations[0].location.lng},
	  scrollwheel: false,
	  styles: style,
	  zoom: 14
	});
	
	
	jQuery.each( locations, function( key, value ) {
	
	    marker = new google.maps.Marker({
	        position: value.location,
	        map: map,	        
	    });    
	    
	    var contentString = '<div id="marker-popup">'+
	    	'<a href="'+value.permalink+'">' +
	        '<h3>'+ value.title +'</h3>'+
	        '<img src="'+ value.image + '" />' +
	        '</a>' +
	        '</div>';
	
	    var infowindow = new google.maps.InfoWindow({
	        content: contentString
	    });	    
	    
		google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
		    return function() {
		        infowindow.setContent(contentString);
		        infowindow.open(map,marker);
		    };
		})(marker,contentString,infowindow));  
	
	});    


}

jQuery('.extended_search_button.closed').live('click', function(){
		var btn = jQuery(this);  
		jQuery('.extended_search_wraper').toggle()
  jQuery(this).parent().animate({
    right: "-12",
  }, 500, function() {
	  btn.toggleClass('opened');
	  btn.toggleClass('closed');
  });
});


jQuery('.extended_search_button.opened').live('click', function(){
		var btn = jQuery(this);
  jQuery(this).parent().animate({
    right: "-612",
  }, 500, function() {
			jQuery('.extended_search_wraper').toggle()  		
	  btn.toggleClass('closed');
	  btn.toggleClass('opened');
  });
}); 