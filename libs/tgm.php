<?php
/**
 * TGM setup
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

add_action( 'tgmpa_register', function() {
	$plugins = [
		[
			'name'      => 'Timber',
			'slug'      => 'timber-library',
			'required'  => true,
		],
		[
			'name'      => 'WordPress SEO by Yoast',
			'slug'      => 'wordpress-seo',
			'required'  => false,
		],
		[
			'name'      => 'Image Compression',
			'slug'      => 'wp-smushit',
			'required'  => false,
		]
	];

	$config = [
		'id'           => 'bloom',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	];

	tgmpa( apply_filters( '_bloom_child_tgm_plugins', $plugins ), apply_filters( '_bloom_child_tgm_config', $config ) );
} );
