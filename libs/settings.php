<?php
/**
 * Settings
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

/**
 * Settings variables
 *
 * * Can't be replaced by child themes
 */
add_action( 'after_setup_theme', function() {
	global $bloom;

	$bloom = [
		// Social icons
		'social' => (object) [
			'twitter'    => '',
			'facebook'   => '',
			'googleplus' => '',
			'youtube'    => '',
			'instagram'  => '',
			'flickr'     => '',
			'dribbble'   => '',
			'bitbucket'  => '',
			'github'     => '',
			'pinterest'  => '',
			'vimeo'      => '',
			'rss'        => '/feed',
		],

		// Preview
		'preview' => (object) [
			'length' => '25',
			'end' => ' ...',
			'read_more' => __( 'Read more', 'bloom' ),
		],

		// Analytics
		'analytics' => (object) [
			'code' => '',
			'target' => 'all', // all, no_users, no_admins
		],

		// Content width
		'content_width' => 790,

		// Thumbnail size
		'thumbnail_size' => (object) [
			'width' => 790,
			'height' => 450,
			'crop' => true
		],

		// Recent post thumbnail size
		'recent_posts_thumbnail_size' => (object) [
			'width' => 120,
			'height' => 68,
			'crop' => true
		],

		// Facebook Token
		'fb_token' => '',
	];

	// Merge child theme config values
  $bloom = apply_filters( '_bloom_child_settings', $bloom );
}, 9 );
