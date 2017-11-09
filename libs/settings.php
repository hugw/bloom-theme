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
			'twitter'    => '/',
			'facebook'   => '/',
			'googleplus' => '/',
			'youtube'    => '/',
			'instagram'  => '',
			'flickr'     => '',
			'dribbble'   => '',
			'bitbucket'  => '',
			'github'     => '',
			'pinterest'  => '',
			'vimeo'      => '',
			'rss'        => '/feed',
		],

		// Related posts
		// 'related_posts' => [
		// 	'post_types' => ['post'],
		// 	'auto_posts' => TRUE,
		// 	'max_posts'  => 4
		// ],

		// Misc
		'excerpt_length' => '25',
		'excerpt_more' => '...',

		// Analytics
		'analytics' => (object) [
			'code' => '',
			'target' => 'all', // all, no_users, no_admins
		],

		// Content width
		'content_width' => 610,

		// Thumbnail size
		'thumbnail_size' => (object) [
			'width' => 610,
			'height' => 350,
			'crop' => true
		]
  ];

	// Merge child theme config values
  $bloom = apply_filters( '_bloom_child_settings', $bloom );
}, 9 );
