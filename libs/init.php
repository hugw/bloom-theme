<?php
/**
 * Core files and functions
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

if ( ! defined( 'BLOOM_DIR' ) ) define( 'BLOOM_DIR' , get_template_directory() );
if ( ! defined( 'BLOOM_LIBS_DIR' ) ) define( 'BLOOM_LIBS_DIR' , BLOOM_DIR . '/libs' );

if ( ! defined( 'BLOOM_URL' ) ) define( 'BLOOM_URL' , get_template_directory_uri() );
if ( ! defined( 'BLOOM_LIBS_URL' ) ) define( 'BLOOM_LIBS_URL' , BLOOM_URL . '/libs' );

foreach ( [
	// Core
	'tgm',
	'utils',
	'settings',
	'setup',

	// Widgets & Templates
	'templates/ga',
	'templates/breadcrumb',
	'templates/recent-posts',
	'templates/ads',

	// Vendor
	'vendor/tgm/class-tgm-plugin-activation',
] as $file ) include_once( BLOOM_LIBS_DIR . "/{$file}.php" );
