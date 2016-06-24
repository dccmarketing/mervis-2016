/**
 * hidden-search.js
 *
 * Handles toggling the appearnace of a hidden search field
 */
( function() {

	var index, search, page, button;

	search = document.querySelector( '#hidden-search-top' );
	if ( ! search ) { return; }

	page = document.querySelector( '#page' );
	if ( ! page ) { return; }

	button = document.querySelector( '.btn-search' );
	if ( ! button ) { return; }

	search.setAttribute( 'aria-hidden', 'true' );

	button.onclick = function( e ) {

		e.preventDefault();

		if ( -1 !== search.className.indexOf( 'open' ) ) {

			search.className = search.className.replace( ' open', '' );
			search.setAttribute( 'aria-hidden', 'true' );

		} else {

			search.className += ' open';
			search.setAttribute( 'aria-hidden', 'false' );

		}

		var affected = [ page, button ];

		for	( index = 0; index < affected.length; index++ ) {

			if ( -1 !== affected[index].className.indexOf( 'open' ) ) {

				affected[index].className = affected[index].className.replace( ' open', '' );

			} else {

				affected[index].className += ' open';

			}

		}

	};

} )();

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

/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation suypport for dropdown menus.
 */
( function() {

	var container, button, menu, links, subMenus, i, len;

	container = document.querySelector( '#site-navigation' );
	if ( ! container ) { return; }

	button = container.querySelector( '.menu-toggle' );
	if ( 'undefined' === typeof button ) { return; }

	menu = container.querySelectorAll( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {

		button.style.display = 'none';

		return;

	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {

		menu.className += ' nav-menu';

	}

	// Get all the link elements within the menu.
	links    = menu.querySelectorAll( 'a' );
	subMenus = menu.querySelectorAll( 'ul' );

	/**
	 * Tablet menu - pushing out from left

	var body = document.querySelector( 'body' );
	if ( 'undefined' === typeof body ) { return; }
	*/

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {

		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {

				if ( -1 !== self.className.indexOf( 'focus' ) ) {

					self.className = self.className.replace( ' focus', '' );

				} else {

					self.className += ' focus';

				}

			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

	/**
	 * Toggles menu open and closed.
	 */
	function toggleMenu() {

		var self = this;

		if ( -1 !== container.className.indexOf( 'toggled' ) ) {

			container.className = container.className.replace( ' toggled', '' );
			this.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );

		} else {

			container.className += ' toggled';
			this.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );

		}

		/**
		 * Tablet menu - pushing out from left

		if ( -1 !== body.className.indexOf( 'toggled' ) ) {

			body.className = body.className.replace( ' toggled', '' );

		} else {

			body.className += ' toggled';

		}
		*/
	}

	button.addEventListener( 'click', toggleMenu, true );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {

		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );

	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {

		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );

	}

} )();

/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {

		window.addEventListener( 'hashchange', function() {

			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) { return; }

			element = document.getElementById( id );

			if ( element ) {

				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {

					element.tabIndex = -1;

				}

				element.focus();
				
			}

		}, false );

	}

})();
