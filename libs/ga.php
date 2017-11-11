<?php
/**
 * Google Analytics
 *
 * @copyright Copyright (c) 2015, hugw.io
 * @author Hugo W - hugo.wnt@gmail.com
 * @license GPLv2
 */

add_action( 'wp_head', function() {
	$analytics = bloom_settings( 'analytics' );

	if ( $analytics->target == 'all' ) echo $analytics->code;
	if ( $analytics->target == 'no_users' && ! is_user_logged_in() ) echo $analytics->code;
	if ( $analytics->target == 'no_admins' && ! current_user_can( 'edit_posts' ) ) echo $analytics->code;
} );
