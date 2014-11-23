$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 1000,
      paginationSpeed : 1000,
      singleItem:true,
	  autoPlay: 6000,
	  responsive: true,
 
      // "singleItem:true" is a shortcut for:
      items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
 
});