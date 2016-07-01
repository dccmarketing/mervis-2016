/**
 * Checkbox Multiple Control
 *
 * Saves the checked options to the hidden field.
 */

( function( $ ) {

	$( document ).ready( function() {
		$( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
			checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
				function() {
					return this.value;
				}
			).get().join( ',' );

			$( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
		});

	}); // $( document ).ready

})( jQuery );

/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, a .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to,
				} );
			}
		} );
	} );

	// menubox_title1.
	wp.customize( 'menubox_title1', function( value ) {
		value.bind( function( to ) {
			$( '#menubox1 .menubox-title' ).text( to );
		} );
	} );

	// menubox_title2.
	wp.customize( 'menubox_title2', function( value ) {
		value.bind( function( to ) {
			$( '#menubox2 .menubox-title' ).text( to );
		} );
	} );

	// menubox_title3.
	wp.customize( 'menubox_title3', function( value ) {
		value.bind( function( to ) {
			$( '#menubox3 .menubox-title' ).text( to );
		} );
	} );

	// menubox_title4.
	wp.customize( 'menubox_title4', function( value ) {
		value.bind( function( to ) {
			$( '#menubox4 .menubox-title' ).text( to );
		} );
	} );



/*
	wp.customize( 'text_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).text( to );
		} );
	} );

	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'url_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title a' ).attr( 'href', to );
		} );
	} );

	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'email_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).text( to );
			//$( '.entry-title a' ).attr( 'href', 'mailto:'+to );
		} );
	} );

	wp.customize( 'date_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).text( to );
		} );
	} );

	wp.customize( 'checkbox_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).style.display( 'none' );
			if ( to ) {

			}
		} );
	} );

	wp.customize( 'color_field', function( value ) {
		value.bind( function( to ) {
			$( '.color_field' ).css( {
				'color': to,
			} );
		} );
	} );

	wp.customize( 'image_field', function( value ) {
		value.bind( function( to ) {
			$( '.image_field' ).css( {
				'color': to,
			} );
		} );
	} );
*/
} )( jQuery );
