<?php
/**
 * Google Analytics
 *
 * @copyright Copyright (c) 2015, hugw.io
 * @author Hugo W - hugo.wnt@gmail.com
 * @license GPLv2
 */

add_action( 'wp_head', function() {
	$ga = bloom_settings( 'analytics' );

	if ( $ga->target == 'all' ) echo $ga->code;
	if ( $ga->target == 'no_users' && ! is_user_logged_in() ) $ga->code;
	if ( $ga->target == 'no_admins' && ! current_user_can( 'edit_posts' ) ) echo $ga->code;
} );
