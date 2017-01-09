/**
 * Show location info on Android screens
 */
( function( $ ) {
	$( ".location" ).each( function() {

		console.log( $(this) );

		var location, button, content, plus_minus;

		location = $(this);
		button = location.children(".show-info");
		content = location.children(".loc-info");
		plus_minus = button.children(".show-button");

		if ( ! content.hasClass( "open" ) ) {

			button.click( function(){

				console.log( button );

				content.toggleClass("open");

				if ( content.hasClass( "open" ) ) {

					plus_minus.html("-");
					plus_minus.css( "padding", "0 0.5625em 0.1em" );

				} else {

					plus_minus.html("+");
					plus_minus.css( "padding", "" );

				}

			}); // button.click()

		}
	}); // each
} )( jQuery );
