<?php
/**
 * Google Analytics
 *
 * @copyright Copyright (c) 2015, hugw.io
 * @author Hugo W - hugo.wnt@gmail.com
 * @license GPLv2
 */

add_action( 'wp_head', function() {
	$code = bloom_settings( 'analytics_tracker' );
	$tracker = bloom_settings( 'analytics_who_to_tracker' );

	if ( $tracker == 'all' ) echo $code;
	if ( $tracker == 'no_users' && ! is_user_logged_in() ) $code;
	if ( $tracker == 'no_admins' && ! current_user_can( 'edit_posts' ) ) echo $code;
} );
