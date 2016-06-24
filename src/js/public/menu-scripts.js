/**
 * Opens the current page's submenu. When hovering over another top-level
 * menu item, it closes the current page's submenu and opens the other.
 *
 * Only operates if the current menu item is defined (so not on the homepage).
 *
 * slideToggle prevents moving to vanilla JS.
 *
 * @link 	http://quagliero.github.io/posts/js/look-ma-no-jquery/
 */

( function( $ ) {

	var parents, i, len;

	parents = document.querySelectorAll( '.menu-item-has-children' );
	if ( ! parents ) { return; }

	len = parents.length;
	if ( 0 >= len ) { return; }

	for ( i = 0; i < len; i++ ) {

		var parent, submenu, clicker, checkclass;

		parent = parents[i];
		submenu = parent.querySelector( '.sub-menu' );
		clicker = parent.querySelector( '.show-hide' );
		checkclass = 'open';

		enquire.register( 'screen and (max-width: 1023px)' , {
			match: function() {

				if ( 0 <= parent.className.indexOf( checkclass ) ) { return; }

				clicker.addEventListener( 'click', function( event ){

					event.preventDefault();

					$(submenu).slideToggle(250);
					parent.classList.toggle( checkclass );

					if ( -1 !== parent.className.indexOf( checkclass ) ) {

						clicker.innerHTML = '-';

					} else {

						clicker.innerHTML = '+';

					}

				});

			},
			unmatch: function() {
				submenu.setAttribute( 'style', '' );
			}
		}); // enquire

	} // for

} )( jQuery );
