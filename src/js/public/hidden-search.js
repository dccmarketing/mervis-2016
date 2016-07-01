/**
 * hidden-search.js
 *
 * Handles toggling the appearnace of a hidden search field
 */
( function() {

	var index, search, page, button;

	search = document.querySelector( '#hidden-search' );
	if ( ! search ) { return; }

	button = document.querySelector( '.btn-search .icon-menu' );
	if ( ! button ) { return; }

	//console.log( search );
	//console.log( button );

	search.setAttribute( 'aria-hidden', 'true' );

	button.addEventListener( 'click', function( e ) {

		console.log( 'yep' );

		e.preventDefault();

		if ( -1 !== search.className.indexOf( 'open' ) ) {

			search.className = search.className.replace( ' open', '' );
			search.setAttribute( 'aria-hidden', 'true' );

		} else {

			search.className += ' open';
			search.setAttribute( 'aria-hidden', 'false' );

		}

	});

} )();
