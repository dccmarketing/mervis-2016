<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @package Mervis_2016
 * @author Slushman <chris@slushman.com>
 */
class Mervis_2016_Themehooks {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Adds a hidden search field
	 *
	 * @hooked 		mervis_2016_body_top 		15
	 *
	 * @return 		mixed 				The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="hidden-search" id="hidden-search">
			<div class="wrap"><?php

			get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

	/**
	 * Adds a search form
	 *
	 * @hooked 		mervis_2016_404_content 		15
	 *
	 * @return 		mixed 		Search form markup
	 */
	public function add_search() {

		get_search_form();

	} // add_search()

	/**
	 * Inserts Google Tag manager code after body tag
	 *
	 * @exits 		tag_manager field is empty.
	 *
	 * @hooked 		mervis_2016_body_top 		10
	 *
	 * @return 		mixed 				The inserted Google Tag Manager code
	 */
	public function analytics_code() {

		$tag = get_theme_mod( 'tag_manager' );

		if ( empty( $tag ) ) { return; }

		echo '<!-- Google Tag Manager -->';
		echo $tag;
		echo '<!-- Google Tag Manager -->';

	} // analytics_code()

	/**
	 * Returns the appropriate breadcrumbs.
	 *
	 * @exits 		On the front page.
	 *
	 * @hooked		mervis_2016_wrap_content
	 *
	 * @return 		mixed 				WooCommerce breadcrumbs, then Yoast breadcrumbs
	 */
	public function breadcrumbs() {

		if ( is_front_page() ) { return; }

		?><div class="breadcrumbs">
			<div class="wrap-crumbs"><?php

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {

					$args['after'] 			= '</span>';
					$args['before'] 		= '<span rel="v:child" typeof="v:Breadcrumb">';
					$args['delimiter'] 		= '&nbsp;>&nbsp;';
					$args['home'] 			= esc_html_x( 'Home', 'breadcrumb', 'mervis-2016' );
					$args['wrap_after'] 	= '</span></span></nav>';
					$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';

					woocommerce_breadcrumb( $args );

				} elseif ( function_exists( 'yoast_breadcrumb' ) ) {

					yoast_breadcrumb();

				}

			?></div><!-- .wrap-crumbs -->
		</div><!-- .breadcrumbs --><?php

	} // breadcrumbs()

	/**
	 * The comments markup
	 *
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @exits 		Comments closed.
	 * @exits 		There are no comments.
	 *
	 * @hooked 		mervis_2016_entry_after 		10
	 *
	 * @return 		mixed 					The comments markup
	 */
	public function comments() {

		if ( ! comments_open() || get_comments_number() <= 0 ) { return; }

		comments_template();

	} // comments()

	public function div_begin() {

		?><div><?php

	} // div_begin()

	public function div_end() {

		?></div><?php

	} // div_end()

	public function featured_image() {

		if ( is_front_page() ) { return; }

		?><div class="featured-image">
			<div class="page-title-head"><?php

			if ( is_home() && ! is_front_page() ) {

				esc_html_e( 'News', 'mervis-2016' );

			} else {

				the_title();

			}

			?></div>
		</div><?php

	} // featured_image()

	/**
	 * Adds the copyright and credits to the footer content.
	 *
	 * @hooked 		mervis_2016_footer_content
	 *
	 * @return 		mixed 									The footer markup
	 */
	public function footer_content() {

		?><div class="site-info">
			<div class="copyright">&copy <?php echo date( 'Y' ); ?> <a class="link-admin" href="<?php echo esc_url( get_admin_url(), 'mervis-2016' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a> <?php esc_html_e( '- All Rights Reserved.', 'mervis-2016' ); ?></div>
			<ul class="footer-links">
				<li><a href="/privacy-policy/"><?php esc_html_e( 'Privacy', 'mervis-2016' ); ?></a></li>
				<li><a href="/terms-of-use/"><?php esc_html_e( 'Terms of Use', 'mervis-2016' ); ?></a></li>
				<li><a href="/site-map/"><?php esc_html_e( 'Site Map', 'mervis-2016' ); ?></a></li>
			</ul>
			<div class="credits"><?php

				printf( esc_html__( 'Site created by %1$s', 'mervis-2016' ), '<a href="https://dccmarketing.com/" rel="nofollow" target="_blank">DCC Marketing</a>' );

			?></div>
		</div><!-- .site-info --><?php

	} // footer_content()

	/**
	 * Adds the opening wrapper tag.
	 *
	 * @return 		mixed 		The opening wrapper tag
	 */
	public function footer_wrap_begin() {

		?><div class="wrap wrap-footer"><?php

	} // footer_wrap_begin()

	/**
	 * Adds the closing wrapper tag.
	 *
	 * @return 		mixed 		The closing wrapper tag
	 */
	public function footer_wrap_end() {

		?></div><!-- wrap-footer --><?php

	} // footer_wrap_end()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 *
	 * @hooked 		mervis_2016_404_content		25
	 *
	 * @return 		mixed 							Markup for the archives
	 */
	public function four_04_archives() {

		if ( ! is_404() ) { return; }

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'mervis-2016' ), convert_smilies( ':)' ) ) . '</p>';

		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

	} // four_04_archives()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 *
	 * @hooked 		mervis_2016_404_content		20
	 *
	 * @return 		mixed 							The categories widget
	 */
	public function four_04_categories() {

		if ( ! is_404() ) { return; }
		if ( ! mervis_2016_categorized_blog() ) { return; }

		?><div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'mervis-2016' ); ?></h2>
			<ul><?php

				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );

			?></ul>
		</div><!-- .widget --><?php

	} // four_04_categories()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @exits 		Not on 404 page.
	 *
	 * @hooked 		mervis_2016_404_content 		15
	 *
	 * @return 		mixed 							The Recent Posts widget
	 */
	public function four_04_posts_widget() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Recent_Posts' );

	} // four_04_posts_widget()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 *
	 * @hooked 		mervis_2016_404_content		30
	 *
	 * @return 		mixed 							The tag cloud widget
	 */
	public function four_04_tag_cloud() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Tag_Cloud' );

	} // four_04_tag_cloud()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		mervis_2016_header_top 		10
	 *
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_menus_wrap_begin() {

		?><div class="wrap-header-menus"><?php

	} // header_menus_wrap_begin()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	mervis_2016_header_bottom 		90
	 *
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_menus_wrap_end() {

		?></div><!-- .wrap-header-menus --><?php

	} // header_menus_wrap_end()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		mervis_2016_header_top 		10
	 *
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_wrap_begin() {

		?><div class="wrap wrap-header"><?php

	} // header_wrap_begin()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	mervis_2016_header_bottom 		90
	 *
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_wrap_end() {

		?></div><!-- .wrap-header --><?php

	} // header_wrap_end()

	/**
	 * Adds the android menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_android() {

		//if (  ) { return; }

		if ( ! has_nav_menu( 'android-footer' ) ) { return; }

		$menu_args['theme_location']	= 'android-footer';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-android';
		$menu_args['container_class'] 	= 'menu nav-android';
		$menu_args['menu_id']         	= 'menu-android-items';
		$menu_args['menu_class']      	= 'menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_android()

	/**
	 * Adds the main menu
	 *
	 * @hooked 		mervis_2016_header_bottom 		95
	 *
	 * @return 		mixed 					The primary menu markup
	 */
	public function menu_belowslider() {

		//if ( is_front_page() ) { return; }

		?><nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'mervis-2016' ); ?></button><?php

				$menu_args['theme_location']	= 'belowslider';
				$menu_args['container'] 		= 'div';
				$menu_args['container_id']    	= 'menu-belowslider';
				$menu_args['container_class'] 	= 'menu nav-belowslider';
				$menu_args['menu_id']         	= 'menu-belowslider-items';
				$menu_args['menu_class']      	= 'menu-items medium upper';
				$menu_args['depth']           	= 2;
				$menu_args['fallback_cb']     	= '';
				$menu_args['walker']  			= new Mervis_2016_Walker();

				wp_nav_menu( $menu_args );

		?></nav><!-- #site-navigation --><?php

	} // menu_belowslider()

	/**
	 * Adds the header menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_header() {

		//if (  ) { return; }

		if ( ! has_nav_menu( 'header-menu' ) ) { return; }

		$menu_args['theme_location']	= 'header-menu';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-header-menu';
		$menu_args['container_class'] 	= 'menu nav-header-menu';
		$menu_args['menu_id']         	= 'menu-header-menu-items';
		$menu_args['menu_class']      	= 'menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_header()

	/**
	 * Adds the home about menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_menubox1() {

		//if (  ) { return; }

		if ( ! is_front_page() ) { return; }
		if ( ! has_nav_menu( 'menubox1' ) ) { return; }

		$menu_args['theme_location']	= 'menubox1';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-menubox1';
		$menu_args['container_class'] 	= 'menu nav-menubox1 menubox';
		$menu_args['menu_id']         	= 'menu-menubox1-items';
		$menu_args['menu_class']      	= 'menubox-menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_menubox1()

	/**
	 * Adds the home about menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_menubox2() {

		//if (  ) { return; }

		if ( ! is_front_page() ) { return; }
		if ( ! has_nav_menu( 'menubox2' ) ) { return; }

		$menu_args['theme_location']	= 'menubox2';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-menubox2';
		$menu_args['container_class'] 	= 'menu nav-menubox2 menubox';
		$menu_args['menu_id']         	= 'menu-menubox2-items';
		$menu_args['menu_class']      	= 'menubox-menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_menubox2()

	/**
	 * Adds the home about menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_menubox3() {

		//if (  ) { return; }

		if ( ! is_front_page() ) { return; }
		if ( ! has_nav_menu( 'menubox3' ) ) { return; }

		$menu_args['theme_location']	= 'menubox3';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-menubox3';
		$menu_args['container_class'] 	= 'menu nav-menubox3 menubox';
		$menu_args['menu_id']         	= 'menu-menubox3-items';
		$menu_args['menu_class']      	= 'menubox-menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_menubox3()

	/**
	 * Adds the home about menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_menubox4() {

		//if (  ) { return; }

		if ( ! is_front_page() ) { return; }
		if ( ! has_nav_menu( 'menubox4' ) ) { return; }

		$menu_args['theme_location']	= 'menubox4';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-menubox4';
		$menu_args['container_class'] 	= 'menu nav-menubox4 menubox';
		$menu_args['menu_id']         	= 'menu-menubox4-items';
		$menu_args['menu_class']      	= 'menubox-menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_menubox4()

	/**
	 * Adds the top tabs menu
	 *
	 * @exits 		Menu not active.
	 *
	 * @hooked 		mervis_2016_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_toptabs() {

		//if (  ) { return; }

		if ( ! has_nav_menu( 'header-tabs' ) ) { return; }

		$menu_args['theme_location']	= 'header-tabs';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-top-tabs-menu';
		$menu_args['container_class'] 	= 'menu nav-top-tabs-menu';
		$menu_args['menu_id']         	= 'menu-top-tabs-menu-items';
		$menu_args['menu_class']      	= 'menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_toptabs()

	/**
	 * Displays the opening menubox section tag.
	 *
	 * @exits 		Not the front page.
	 *
	 * @return 		mixed 				HTML tag
	 */
	public function menubox_wrap_begin() {

		if ( ! is_front_page() ) { return; }

		?><section class="menuboxes"><?php

	} // menubox_wrap_begin()

	/**
	 * Displays the closing menubox section tag.
	 *
	 * @exits 		Not the front page.
	 *
	 * @return 		mixed 				HTML tag
	 */
	public function menubox_wrap_end() {

		if ( ! is_front_page() ) { return; }

		?></section><!-- .menuboxes --><?php

	} // menubox_wrap_end()

	/**
	 * Adds the posted_on post meta.
	 *
	 * @exits 		Not on post type page.
	 * @exits 		Not on search page.
	 *
	 * @return 		mixed 			The posted_on post meta.
	 */
	public function posted_on() {

		if ( 'post' != get_post_type() ) { return; }
		if ( ! is_search() ) { return; }

		?><div class="entry-meta"><?php

			mervis_2016_posted_on();

		?></div><!-- .entry-meta --><?php

	} // posted_on()

	/**
	 * Adds the post navigation to the archive pages
	 *
	 * @exits 		Not on posts home.
	 * @exits 		Not on archive page.
	 *
	 * @hooked 		mervis_2016_while_after
	 *
	 * @return 		mixed 							The posts navigation
	 */
	public function posts_nav() {

		if ( ! is_home() || ! is_archive() ) { return; }

		the_posts_navigation();

	} // posts_nav()

	/**
	 * Adds a sidebar.
	 *
	 * @return [type] [description]
	 */
	public function sidebar_footer() {

		?><div class="sidebar-footer">
			<div class="wrap"><?php

				dynamic_sidebar( 'footer' );

			?></div>
		</div><?php

	} // sidebar_footer()

	/**
	 * Adds a sidebar.
	 *
	 * @exits 		Not on the front page.
	 *
	 * @return [type] [description]
	 */
	public function sidebar_home() {

		if( ! is_front_page() ) { return; }

		?><div class="sidebar-home">
			<div class="wrap"><?php

			dynamic_sidebar( 'home' );

			?></div>
		</div><?php

	} // sidebar_home()

	/**
	 * Adds a sidebar.
	 *
	 * @exits 		Not on the front page.
	 *
	 * @return [type] [description]
	 */
	public function sidebar_news() {

		if( ! is_home() ) { return; }

		?><div class="sidebar-news widget-area">
			<div class="wrap"><?php

			dynamic_sidebar( 'sidebar' );

			?></div>
		</div><?php

	} // sidebar_news()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		mervis_2016_header_bottom			85
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_end() {

		?></div><!-- .site-branding --><?php

	} // site_branding_end()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		mervis_2016_header_top				15
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_start() {

		?><div class="site-branding"><?php

	} // site_branding_start()

	/**
	 * Adds the site description markup
	 *
	 * @hooked 		mervis_2016_header_content 		15
	 *
	 * @return 		mixed 								The site description markup
	 */
	public function site_description() {

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) {

			?><p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p><?php

		}

	} // site_description()

	/**
	 * Adds the a11y skip link markup
	 *
	 * @hooked 		mervis_2016_body_top 		20
	 *
	 * @return 		mixed 				Skip link markup
	 */
	public function skip_link() {

		?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mervis-2016' ); ?></a><?php

	} // skip_link()

	/**
	 * Displays the home slider
	 *
	 * @exits 		Not the home page
	 * @exits 		Soliloquy isn't installed and/or activated
	 *
	 * @return 		mixed 			Home Page Slider
	 */
	public function slider_home() {

		if ( ! is_front_page() ) { return; }
		if ( ! function_exists( 'soliloquy' ) ) { return; }

		soliloquy( 'home', 'slug' );

	} // slider_home()

	/**
	 * Displays the text logo.
	 *
	 * @return [type] [description]
	 */
	public function text_logo() {

		$output = '';
		$logo 	= get_field( 'text_logo', get_the_ID() );

		if ( ! $logo ) {

			$parents = get_post_ancestors( get_the_ID() );

			if ( ! empty( $parents ) ) {

				$id 	= $parents[count( $parents ) - 1];
				$logo 	= get_field( 'text_logo', $id );

			}

		}

		if ( ! $logo ) {

			$logo = get_theme_mod( 'default_text_logo' );

		}

		if ( empty( $logo ) ) { return; }

		?><p class="text-logo">
			<a><img src="<?php echo esc_url( $logo ); ?>"></a>
		</p><!-- Background Images --><?php

	} // text_logo()

	/**
	 * Adds the page title to an archive page
	 *
	 * @exits 		Not on archive page.
	 *
	 * @hooked 		mervis_2016_while_before
	 *
	 * @return 		mixed 							The archive page title
	 */
	public function title_archive() {

		if ( ! is_archive() ) { return; }

		?><header class="page-header"><?php

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );

		?></header><!-- .page-header --><?php

	} // title_archive()

	/**
	 * Returns the entry title
	 *
	 * @exits 		On static front page.
	 * @exits 		On a static page.
	 *
	 * @hooked 		entry_header_content 			10
	 *
	 * @return 		mixed 							The entry title
	 */
	public function title_entry() {

		if ( is_front_page() && ! is_home() ) { return; }
		if ( is_page() ) { return; }

		if ( is_single() ) {

			the_title( '<h1 class="entry-title">', '</h1>' );

		} else {

			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		}

	} // title_entry()

	/**
	 * Returns the page title
	 *
	 * @exits 		On the front page.
	 * @exits 		On posts home.
	 * @exits 		Not on a page.
	 *
	 * @hooked 		mervis_2016_while_before 		10
	 *
	 * @return 		mixed 							The entry title
	 */
	public function title_page() {

		if ( is_front_page() || is_home() ) { return; }
		if ( ! is_page() ) { return; }

		the_title( '<h1 class="page-title">', '</h1>' );

	} // title_page()

	/**
	 * The search title markup
	 *
	 * @exits 		Not on a search page.
	 *
	 * @hooked 		mervis_2016_while_before
	 *
	 * @return 		mixed 							Search title markup
	 */
	public function title_search() {

		if ( ! is_search() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php

				printf( esc_html__( 'Search Results for: %s', 'mervis-2016' ), '<span>' . get_search_query() . '</span>' );

			?></h1>
		</header><!-- .page-header --><?php

	} // title_search()

	/**
	 * Adds the single post title to the index
	 *
	 * @exits 		On static front page
	 *
	 * @hooked 		mervis_2016_while_before
	 *
	 * @return 		mixed 							The single post title
	 */
	public function title_single_post() {

		if ( ! is_home() && is_front_page() ) { return; }

		?><header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header><?php

	} // title_single_post()

	/**
	 * Adds the site title markup
	 *
	 * @exits 		get_custom_logo doesn't exist
	 * @exits 		get_custom_logo is empty
	 *
	 * @hooked 		mervis_2016_header_content 		10
	 *
	 * @return 		mixed 								The site title markup
	 */
	public function title_site() {

		if ( ! function_exists( 'get_custom_logo' ) ) { return; }

		$logo = get_custom_logo();

		if ( empty( $logo ) ) { return; }

		if ( is_front_page() && is_home() ) {

			?><h1 class="site-title"><?php echo $logo; ?></h1><?php

		} else {

			?><p class="site-title"><?php echo $logo; ?></p><?php

		}

	} // title_site()

} // class
