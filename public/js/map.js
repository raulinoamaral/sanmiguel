var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var latlng = new google.maps.LatLng(-34.4793263,-54.3365654);
function initializeMap()
{
	directionsDisplay = new google.maps.DirectionsRenderer();
	var settings = 
	{
		scrollwheel: false,
		zoom: 16,
		center: latlng,
		mapTypeControl: false,
		streetViewControl: false,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR},
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.DEFAULT},
		mapTypeId: google.maps.MapTypeId.ROADMAP
		
	};

	var styles = [
  	{
    	stylers: [
      		{ hue: "#019934" },
      		{ saturation: 10 },
    	]
  	},
  	{
		featureType: "poi",
    	stylers: [
     			{ visibility: "off" }
    			]
  	}
	];
	

	var map = new google.maps.Map(document.getElementById("mapa"), settings);
	var companyPos = new google.maps.LatLng(-34.4793263,-54.3365654);
  	var companyMarker = new google.maps.Marker
	({
		position: companyPos,
		map: map,
		title:"Veterinaria San Miguel"
  	});
	google.maps.event.addListener(companyMarker, 'click', function()
	{
		infowindow.open(map,companyMarker);
	});
	map.setOptions({styles: styles});
	directionsDisplay.setMap(map);
}