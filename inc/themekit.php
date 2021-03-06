<?php

/**
 * Returns an attachment by the filename
 *
 * @exits 		If $post_name is empty.
 * @param 		string 			$post_name 				The post name
 * @return 		object 									The attachment post object
 */
function mervis_2016_get_attachment_by_name( $post_name ) {

	if ( empty( $post_name ) ) { return 'Post name is empty'; }

	$args['name'] 			= trim ( $post_name );
	$args['post_per_page'] 	= 1;
	$args['post_status'] 	= 'any';

	$posts = $this->get_posts( 'attachment', $args, $post_name . '_attachments' );

	if ( $posts->posts[0] ) {

		return $posts->posts[0];

	}

	return FALSE;

} // mervis_2016_get_attachment_by_name()

/**
 * Returns a post object of the requested post type
 *
 * @exits 		If $post is empty.
 * @param 		string 		$post 			The name of the post type
 * @param   	array 		$params 		Optional parameters
 * @return 		object 		A post object
 */
function mervis_2016_get_posts( $post, $params = array(), $cache = '' ) {

	if ( empty( $post ) ) { return -1; }

	$return = '';
	$cache_name = 'posts';

	if ( ! empty( $cache ) ) {

		$cache_name = '' . $cache . '_posts';

	}

	$return = wp_cache_get( $cache_name, 'posts' );

	if ( false === $return ) {

		$args['post_type'] 				= $post;
		$args['post_status'] 			= 'publish';
		$args['order_by'] 				= 'date';
		$args['posts_per_page'] 		= 50;
		$args['no_found_rows']			= true;
		$args['update_post_meta_cache'] = false;
		$args['update_post_term_cache'] = false;

		$args 	= wp_parse_args( $params, $args );
		$query 	= new WP_Query( $args );

		if ( ! is_wp_error( $query ) && $query->have_posts() ) {

			wp_cache_set( $cache_name, $query, 'posts', 5 * MINUTE_IN_SECONDS );

			$return = $query;

		}

	}

	return $return;

} // mervis_2016_get_posts()

/**
 * Returns the URL for the posts page
 *
 * @return 		string 						The URL for the posts page
 */
function mervis_2016_get_posts_page() {

	if ( get_option( 'show_on_front' ) == 'page' ) {

		return get_permalink( get_option( 'page_for_posts' ) );

	} else  {

		return bloginfo( 'url' );

	}

} // mervis_2016_get_posts_page()

/**
 * Determines if a page is within a tree of pages or not.
 *
 * @exits 		If $pageID is empty.
 * @param 		int 		$pageID 		The page ID.
 * @return 		bool 						TRUE if in a tree, FALSE if not.
 */
function mervis_is_tree( $pageID ) {

	if ( empty( $pageID ) ) { return; }

	if ( is_int( $pageID ) ) {

		$id = $pageID;

	} elseif ( is_string( $pageID ) ) {

		$page = get_page_by_title( $pageID );

		if ( ! $page ) { return; }

		$id = $page->ID;

	}

	global $post;

	if ( is_page( $id ) ) { return TRUE; }
	if ( empty( $post ) ) { return FALSE; }

	$ancs = get_post_ancestors( $post->ID );

	foreach ( $ancs as $anc ) {

		if ( is_page() && $id === $anc ) { return TRUE; }

	}

	return FALSE;

} // mervis_is_tree()

/**
 * Returns a Google Map link from an address
 *
 * @exits 		If $address is empty.
 * @param 		string 		$address 		An address
 * @return 		string 						URL for Google Maps
 */
function mervis_2016_make_map_link( $address ) {

	if( empty( $address ) ) { return FALSE; }

	$return = '';

	$query_args['q'] 	= urlencode( $address );
	$return 			= add_query_arg( $query_args, 'http://www.google.com/maps/' );

	return $return;

} // mervis_2016_make_map_link()

/**
 * Converts a phone number into a tel link
 *
 * @exits 		If $number is empty.
 * @param 		string 		$number 			A phone number
 * @return 		mixed 							Formatted HTML telephone link
 */
function mervis_2016_make_phone_link( $number ) {

	if ( empty( $number ) ) { return FALSE; }

	$return = '';

	$formatted 	= preg_replace( '/[^0-9]/', '', $number );

	$return .= '<span itemprop="telephone">';
	$return .= '<a href="tel:' . $formatted . '">';
	$return .= '<span class="screen-reader-text">';
	$return .= esc_html__( 'Call ', 'mervis-2016' ) . '</span>';
	$return .= $number . '</a>';
	$return .= '</span>';

	return $return;

} // mervis_2016_make_phone_link()

/**
 * Reduce the length of a string by character count
 *
 * @exits 		If $text is empty.
 * @param 		string 		$text 		The string to reduce
 * @param 		int 		$limit 		Max amount of characters to allow
 * @param 		string 		$after 		Text for after the limit
 * @return 		string 					The possibly reduced string
 */
function mervis_2016_shorten_text( $text, $limit = 100, $after = '...' ) {

	if ( empty( $text ) ) { return; }

	$length = strlen( $text );
	$text 	= substr( $text, 0, $limit );

	if ( $length > $limit ) {

		$text = $text . $after;

	} // Ellipsis

	return $text;

} // mervis_2016_shorten_text()

/**
 * Returns an array of state abbreviations or single state abbreviation.
 *
 * @param 		string 				$state 			Optional. The name of a state.
 * @return 		string/array 		$states 		Either the state abbreviation or
 *                                    					or an array of state abbreviations.
 */
function mervis_get_state_abbreviation( $state ) {

	$states 					= array();
	$states['Alabama'] 			= 'AL';
	$states['Alaska'] 			= 'AK';
	$states['Arizona'] 			= 'AZ';
	$states['Arkansas'] 		= 'AR';
	$states['California'] 		= 'CA';
	$states['Colorado'] 		= 'CO';
	$states['Connecticut'] 		= 'CT';
	$states['Delaware'] 		= 'DE';
	$states['Florida'] 			= 'FL';
	$states['Georgia'] 			= 'GA';
	$states['Hawaii'] 			= 'HI';
	$states['Idaho'] 			= 'ID';
	$states['Illinois'] 		= 'IL';
	$states['Indiana'] 			= 'IN';
	$states['Iowa'] 			= 'IA';
	$states['Kansas'] 			= 'KS';
	$states['Kentucky'] 		= 'KY';
	$states['Louisiana'] 		= 'LA';
	$states['Maine'] 			= 'ME';
	$states['Maryland'] 		= 'MD';
	$states['Massachusetts'] 	= 'MA';
	$states['Michigan'] 		= 'MI';
	$states['Minnesota'] 		= 'MN';
	$states['Mississippi'] 		= 'MS';
	$states['Missouri'] 		= 'MO';
	$states['Montana'] 			= 'MT';
	$states['Nebraska'] 		= 'NE';
	$states['Nevada'] 			= 'NV';
	$states['New Hampshire'] 	= 'NH';
	$states['New Jersey'] 		= 'NJ';
	$states['New Mexico'] 		= 'NM';
	$states['New York'] 		= 'NY';
	$states['North Carolina'] 	= 'NC';
	$states['North Dakota'] 	= 'ND';
	$states['Ohio'] 			= 'OH';
	$states['Oklahoma'] 		= 'OK';
	$states['Oregon'] 			= 'OR';
	$states['Pennsylvania'] 	= 'PA';
	$states['Rhode Island'] 	= 'RI';
	$states['South Carolina'] 	= 'SC';
	$states['South Dakota'] 	= 'SD';
	$states['Tennessee'] 		= 'TN';
	$states['Texas'] 			= 'TX';
	$states['Utah'] 			= 'UT';
	$states['Vermont'] 			= 'VT';
	$states['Virginia'] 		= 'VA';
	$states['Washington'] 		= 'WA';
	$states['West Virginia'] 	= 'WV';
	$states['Wisconsin'] 		= 'WI';
	$states['Wyoming'] 			= 'WY';

	if ( empty( $state ) ) {

		return $states;

	}

	return $states[$state];

} // mervis_get_state_abbreviation()

/**
 * Returns the abbreviation for a state or an array of states.
 *
 * @param 		string 				$state 			The state abbreviation.
 * @return 		string|srray 		$states 		Either the name of a state
 *                                    					or an array of state names.
 */
function mervis_get_state_name( $state ) {

	$states 		= array();
	$states['AL'] 	= 'Alabama';
	$states['AK'] 	= 'Alaska';
	$states['AZ'] 	= 'Arizona';
	$states['AR'] 	= 'Arkansas';
	$states['CA'] 	= 'California';
	$states['CO'] 	= 'Colorado';
	$states['CT'] 	= 'Connecticut';
	$states['DE'] 	= 'Delaware';
	$states['FL'] 	= 'Florida';
	$states['GA'] 	= 'Georgia';
	$states['HI'] 	= 'Hawaii';
	$states['ID'] 	= 'Idaho';
	$states['IL'] 	= 'Illinois';
	$states['IN'] 	= 'Indiana';
	$states['IA'] 	= 'Iowa';
	$states['KS'] 	= 'Kansas';
	$states['KY'] 	= 'Kentucky';
	$states['LA'] 	= 'Louisiana';
	$states['ME'] 	= 'Maine';
	$states['MD'] 	= 'Maryland';
	$states['MA'] 	= 'Massachusetts';
	$states['MI'] 	= 'Michigan';
	$states['MN'] 	= 'Minnesota';
	$states['MS'] 	= 'Mississippi';
	$states['MO'] 	= 'Missouri';
	$states['MT'] 	= 'Montana';
	$states['NE'] 	= 'Nebraska';
	$states['NV'] 	= 'Nevada';
	$states['NH'] 	= 'New Hampshire';
	$states['NJ'] 	= 'New Jersey';
	$states['NM'] 	= 'New Mexico';
	$states['NY'] 	= 'New York';
	$states['NC'] 	= 'North Carolina';
	$states['ND'] 	= 'North Dakota';
	$states['OH'] 	= 'Ohio';
	$states['OK'] 	= 'Oklahoma';
	$states['OR'] 	= 'Oregon';
	$states['PA'] 	= 'Pennsylvania';
	$states['RI'] 	= 'Rhode Island';
	$states['SC'] 	= 'South Carolina';
	$states['SD'] 	= 'South Dakota';
	$states['TN'] 	= 'Tennessee';
	$states['TX'] 	= 'Texas';
	$states['UT'] 	= 'Utah';
	$states['VT'] 	= 'Vermont';
	$states['VA'] 	= 'Virginia';
	$states['WA'] 	= 'Washington';
	$states['WV'] 	= 'West Virginia';
	$states['WI'] 	= 'Wisconsin';
	$states['WY'] 	= 'Wyoming';

	if ( empty( $state ) ) {

		return $states;

	}

	return $states[$state];

} // mervis_get_state_name()

/**
 * Returns the phone number.
 *
 * @param 		string 		$number 		A potential phone number.
 * @return 		string 						The sanitized phone number.
 */
function mervis_get_tel_phone( $number ) {

	$trimmed 	= trim( $number );
	$nochars 	= preg_replace("/[^0-9]/", "", $trimmed);

	return $nochars;

} // mervis_get_tel_phone()
