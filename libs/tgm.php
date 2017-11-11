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


		'strings'      => [
			'page_title' => __( 'Install Required Plugins', 'bloom' ),
			'menu_title' => __( 'Install Plugins', 'bloom' ),
			'installing' => __( 'Installing Plugin: %s', 'bloom' ),
			'updating'   => __( 'Updating Plugin: %s', 'bloom' ),
			'oops'       => __( 'Something went wrong with the plugin API.', 'bloom' ),

			'notice_can_install_required' => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'bloom'
			),
			'notice_can_install_recommended' => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'bloom'
			),
			'notice_ask_to_update' => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'bloom'
			),
			'notice_ask_to_update_maybe' => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'bloom'
			),
			'notice_can_activate_required' => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'bloom'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'bloom'
			),
			'install_link' => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'bloom'
			),
			'update_link' => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'bloom'
			),
			'activate_link' => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'bloom'
			),

			'return'                          => __( 'Return to Required Plugins Installer', 'bloom' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'bloom' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'bloom' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'bloom' ),
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'bloom' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'bloom' ),
			'dismiss'                         => __( 'Dismiss this notice', 'bloom' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'bloom' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'bloom' ),

			'nag_type'                        => '', // 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'.
		],
	];

	tgmpa( apply_filters( '_bloom_child_tgm_plugins', $plugins ), apply_filters( '_bloom_child_tgm_config', $config ) );
} );
