<?php
/**
 * Setup functions
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

/**
 * Make theme available
 * for translation
 */
load_theme_textdomain( 'bloom', BLOOM_DIR . '/lang' );

/**
 * Set the content width based on the theme's
 * design and stylesheet
 */
add_action( 'after_setup_theme', function() {
	$GLOBALS['content_width'] = apply_filters( 'bloom_content_width', bloom_settings( 'content_width' ) );
}, 0 );

/**
 * Basic setup
 *
 * * Can't be replaced by child themes
 */
add_action( 'after_setup_theme', function() {
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Editor style
	add_editor_style( '/assets/css/bloom-editor.min.css' );

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption'] );

	// Let WP manage titles
	add_theme_support( 'title-tag' );

	// Post formats
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'image', 'video', 'quote', 'audio', 'gallery'
	// ) );

	// Add support for Post thumbnails on posts and pages
	$thumb = bloom_settings( 'thumbnail_size' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( $thumb->width, $thumb->height, $thumb->crop );

	// Excerpt Length
	add_filter( 'excerpt_length', function() {
		return bloom_settings( 'excerpt_length' );
	} );

	// Excerpt more
	add_filter( 'excerpt_more', function( $more ) {
		return bloom_settings( 'excerpt_more' );
	} );

	// Disable Jetpack Open Graph
	// when WPSEO by Yoast is present
	if ( defined('WPSEO_VERSION') && defined( 'JETPACK__VERSION' ) ) {
		add_filter( 'jetpack_enable_open_graph', '__return_false' );
	}

	// Enable responsive videos
	// from JetPack
	if ( defined( 'JETPACK__VERSION' ) ) {
		add_theme_support( 'jetpack-responsive-videos' );
	}
} );

/**
 * Menus
 *
 * * Can't be replaced by child themes
 */
add_action( 'after_setup_theme', function() {
	register_nav_menu( 'primary', __( 'Primary menu', 'bloom' ) );
} );

/**
 * Sidebar widgets
 *
 * * Can't be replaced by child themes
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Primary Sidebar', 'bloom' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	] );
} );

/**
 * Expose settings to
 * page context
 *
 * * Can't be replaced by child themes
 */
add_filter( 'timber/context', function( $ctx ) {
	$ctx['primary_sidebar'] = Timber::get_widgets('primary-sidebar');
	$ctx['menu'] = new Timber\Menu( 'primary' );
	$ctx['settings'] = bloom_settings();

	return apply_filters( '_bloom_child_context', $ctx );
} );

/**
 * Enqueue base stylesheets
 *
 * * Can't be replaced by child themes
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'bloom-theme' , BLOOM_URL . '/assets/css/bloom.min.css' );

	// Enqueue child themes stylesheets
	do_action( '_bloom_enqueue_stylesheets' );
} );

/**
 * Enqueue base scripts
 *
 * * Can't be replaced by child themes
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery' );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'bloom-theme' , BLOOM_URL . '/assets/js/bloom.min.js' );

	// add_action( 'wp_head', function() {
	// 	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url( 'admin-ajax.php' ) . '\';</script>';
	// } );

	// Enqueue child themes scripts
	do_action( '_bloom_enqueue_scripts' );
} );

/**
 * Allow shortcodes on Widgets and Excerpts
 *
 * * Can't be replaced by child themes
 */
add_action( 'after_setup_theme', function() {
	add_filter( 'widget_text', 'do_shortcode' );
	add_filter( 'the_excerpt', 'do_shortcode' );
} );

/**
 * Image quality
 *
 * * Can't be replaced by child themes
 */
add_filter( 'jpeg_quality', function() { return 100; }, 99 );

/**
 * Head cleaning
 * @link http://wpengineer.com/1438/wordpress-header/
 *
 * * Can't be replaced by child themes
 */
add_action( 'init', function() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3);
	#remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'the_generator', '__return_false' );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

	global $wp_widget_factory;
	remove_action( 'wp_head', [$wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'] );
} );

/**
 * Allow more tags in TinyMCE including
 * <iframe> and <script>
 */
if ( ! function_exists( '_bloom_add_more_tags' ) ) {
	function _bloom_add_more_tags( $options ) {
		$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';

		if ( isset( $initArray['extended_valid_elements'] ) ) {
			$options['extended_valid_elements'] .= ',' . $ext;
		} else {
			$options['extended_valid_elements'] = $ext;
		}

		return $options;
	}
	add_filter( 'tiny_mce_before_init', '_bloom_add_more_tags' );
}

/**
 * Avoid empty search queries redirecting to index
 *
 * * Can't be replaced by child themes
 */
add_filter( 'request', function( $query_vars ) {
	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = ' ';
	}

	return $query_vars;
} );

/**
 * Nice search
 *
 * * Can't be replaced by child themes
 */
add_action( 'template_redirect', function() {
	global $wp_rewrite;

	if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
		return;
	}

	$search_base = $wp_rewrite->search_base;

	if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var('s') ) ) );
		exit();
	}
} );

/**
 * Tag cloud args
 *
 * * Can't be replaced by child themes
 */
add_filter('widget_tag_cloud_args', function( $args ) {
	if( isset( $args['taxonomy'] ) && $args['taxonomy'] == 'post_tag' ) {
		$args['number'] = 15; // Limit number of tags
		$args['orderby'] = 'count';
		$args['order'] = 'DESC';
	}

	return $args;
});

/**
 * Set a new searchform.php path
 *
 * * Can't be replaced by child themes
 */
add_filter( 'get_search_form', function() {
	Timber::render( 'partials/search-form.twig' );
	return '';
});

/**
 * Stop images being wrapped in p tags
 * @link http://www.wpfill.me/
 *
 * * Can't be replaced by child themes
 */
add_filter( 'the_content', function( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
} );

/**
 * Enable upload of flash files
 *
 * * Can't be replaced by child themes
 */
add_filter( 'upload_mimes', function( $mimes ) {
	if ( function_exists( 'current_user_can' ) ) $unfiltered = current_user_can( 'unfiltered_html' );
	if ( ! empty( $unfiltered ) ) $mimes['swf'] = 'application/x-shockwave-flash';
	return $mimes;
} );

/**
 * Add supported for
 * paginated posts
 *
 * * Can't be replaced by child themes
 */
add_filter( 'mce_buttons', function ($mce_buttons) {
	$pos = array_search( 'wp_more', $mce_buttons, true );

	if ($pos !== false) {
		$tmp_buttons = array_slice( $mce_buttons, 0, $pos + 1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos + 1 ) );
	}

	return $mce_buttons;
} );
