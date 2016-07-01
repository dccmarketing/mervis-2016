( function( $ ) {

	$( "#accordion" ).accordion({
		active: 0,
		animate: 200,
		collapsible: true,
		header: "h2",
		heightStyle: "content",
		icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
	});

} )( jQuery );
