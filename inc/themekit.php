<?php

/**
 * Returns an attachment by the filename
 *
 * @param 		string 			$post_name 				The post name
 *
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
 * @param 	string 		$post 			The name of the post type
 * @param   array 		$params 		Optional parameters
 *
 * @return 	object 		A post object
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

	if( get_option( 'show_on_front' ) == 'page' ) {

		return get_permalink( get_option( 'page_for_posts' ) );

	} else  {

		return bloginfo( 'url' );

	}

} // mervis_2016_get_posts_page()

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
 * @param 	string 		$address 		An address
 *
 * @return 	string 						URL for Google Maps
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
 * @param 	string 		$number 			A phone number
 *
 * @return 	mixed 							Formatted HTML telephone link
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
 * @param 	string 		$text 		The string to reduce
 * @param 	int 		$limit 		Max amount of characters to allow
 * @param 	string 		$after 		Text for after the limit
 *
 * @return 	string 					The possibly reduced string
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

function mervis_get_state_abbreviation( $state ) {

	$return = '';

	switch( $state ) {

		case 'Alabama': 		$return = 'AL'; break;
		case 'Alaska': 			$return = 'AK'; break;
		case 'Arizona': 		$return = 'AZ'; break;
		case 'Arkansas': 		$return = 'AR'; break;
		case 'California': 		$return = 'CA'; break;
		case 'Colorado': 		$return = 'CO'; break;
		case 'Connecticut': 	$return = 'CT'; break;
		case 'Delaware': 		$return = 'DE'; break;
		case 'Florida': 		$return = 'FL'; break;
		case 'Georgia': 		$return = 'GA'; break;
		case 'Hawaii': 			$return = 'HI'; break;
		case 'Idaho': 			$return = 'ID'; break;
		case 'Illinois': 		$return = 'IL'; break;
		case 'Indiana': 		$return = 'IN'; break;
		case 'Iowa': 			$return = 'IA'; break;
		case 'Kansas': 			$return = 'KS'; break;
		case 'Kentucky': 		$return = 'KY'; break;
		case 'Louisiana': 		$return = 'LA'; break;
		case 'Maine': 			$return = 'ME'; break;
		case 'Maryland': 		$return = 'MD'; break;
		case 'Massachusetts': 	$return = 'MA'; break;
		case 'Michigan': 		$return = 'MI'; break;
		case 'Minnesota': 		$return = 'MN'; break;
		case 'Mississippi': 	$return = 'MS'; break;
		case 'Missouri': 		$return = 'MO'; break;
		case 'Montana': 		$return = 'MT'; break;
		case 'Nebraska': 		$return = 'NE'; break;
		case 'Nevada': 			$return = 'NV'; break;
		case 'New Hampshire': 	$return = 'NH'; break;
		case 'New Jersey': 		$return = 'NJ'; break;
		case 'New Mexico': 		$return = 'NM'; break;
		case 'New York': 		$return = 'NY'; break;
		case 'North Carolina': 	$return = 'NC'; break;
		case 'North Dakota': 	$return = 'ND'; break;
		case 'Ohio': 			$return = 'OH'; break;
		case 'Oklahoma': 		$return = 'OK'; break;
		case 'Oregon': 			$return = 'OR'; break;
		case 'Pennsylvania': 	$return = 'PA'; break;
		case 'Rhode Island': 	$return = 'RI'; break;
		case 'South Carolina': 	$return = 'SC'; break;
		case 'South Dakota': 	$return = 'SD'; break;
		case 'Tennessee': 		$return = 'TN'; break;
		case 'Texas': 			$return = 'TX'; break;
		case 'Utah': 			$return = 'UT'; break;
		case 'Vermont': 		$return = 'VT'; break;
		case 'Virginia': 		$return = 'VA'; break;
		case 'Washington': 		$return = 'WA'; break;
		case 'West Virginia': 	$return = 'WV'; break;
		case 'Wisconsin': 		$return = 'WI'; break;
		case 'Wyoming': 		$return = 'WY'; break;

	} // switch

	return $return;

} // mervis_get_state_abbreviation()

function mervis_get_state_name( $state ) {

	$return = '';

	switch( $state ) {

		case 'AL': $return = 'Alabama'; break;
		case 'AK': $return = 'Alaska'; break;
		case 'AZ': $return = 'Arizona'; break;
		case 'AR': $return = 'Arkansas'; break;
		case 'CA': $return = 'California'; break;
		case 'CO': $return = 'Colorado'; break;
		case 'CT': $return = 'Connecticut'; break;
		case 'DE': $return = 'Delaware'; break;
		case 'FL': $return = 'Florida'; break;
		case 'GA': $return = 'Georgia'; break;
		case 'HI': $return = 'Hawaii'; break;
		case 'ID': $return = 'Idaho'; break;
		case 'IL': $return = 'Illinois'; break;
		case 'IN': $return = 'Indiana'; break;
		case 'IA': $return = 'Iowa'; break;
		case 'KS': $return = 'Kansas'; break;
		case 'KY': $return = 'Kentucky'; break;
		case 'LA': $return = 'Louisiana'; break;
		case 'ME': $return = 'Maine'; break;
		case 'MD': $return = 'Maryland'; break;
		case 'MA': $return = 'Massachusetts'; break;
		case 'MI': $return = 'Michigan'; break;
		case 'MN': $return = 'Minnesota'; break;
		case 'MS': $return = 'Mississippi'; break;
		case 'MO': $return = 'Missouri'; break;
		case 'MT': $return = 'Montana'; break;
		case 'NE': $return = 'Nebraska'; break;
		case 'NV': $return = 'Nevada'; break;
		case 'NH': $return = 'New Hampshire'; break;
		case 'NJ': $return = 'New Jersey'; break;
		case 'NM': $return = 'New Mexico'; break;
		case 'NY': $return = 'New York'; break;
		case 'NC': $return = 'North Carolina'; break;
		case 'ND': $return = 'North Dakota'; break;
		case 'OH': $return = 'Ohio'; break;
		case 'OK': $return = 'Oklahoma'; break;
		case 'OR': $return = 'Oregon'; break;
		case 'PA': $return = 'Pennsylvania'; break;
		case 'RI': $return = 'Rhode Island'; break;
		case 'SC': $return = 'South Carolina'; break;
		case 'SD': $return = 'South Dakota'; break;
		case 'TN': $return = 'Tennessee'; break;
		case 'TX': $return = 'Texas'; break;
		case 'UT': $return = 'Utah'; break;
		case 'VT': $return = 'Vermont'; break;
		case 'VA': $return = 'Virginia'; break;
		case 'WA': $return = 'Washington'; break;
		case 'WV': $return = 'West Virginia'; break;
		case 'WI': $return = 'Wisconsin'; break;
		case 'WY': $return = 'Wyoming'; break;

	} // switch

	return $return;

} // mervis_get_state_name()

function mervis_get_tel_phone( $number ) {

	$trimmed 	= trim( $number );
	$nochars 	= preg_replace("/[^0-9]/", "", $trimmed);

	return $nochars;

} // mervis_get_tel_phone()
