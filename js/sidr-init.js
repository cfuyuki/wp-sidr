jQuery(document).ready(function($){
					
	console.log ("hooking up sidr");

	// hook up the left side menu
	$(".sidr-left-link").sidr({
		name: "sidr-left",
		side: "left"
	});

	// hook up the right side menu
	$(".sidr-right-link").sidr({
		name: "sidr-right",
		side: "right"
	});

});