<?php
/**
 * Utility functions
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

/**
 * Retrieve current loaded
 * page type
 */
function bloom_get_page_type() {
	global $wp_query;

	$current = 'notfound';

	if ( $wp_query->is_page ) {
			$current = is_front_page() ? 'front' : 'page';
	} elseif ( $wp_query->is_home ) {
			$current = 'home';
	} elseif ( $wp_query->is_single ) {
			$current = ( $wp_query->is_attachment ) ? 'attachment' : 'single';
	} elseif ( $wp_query->is_category ) {
			$current = 'category';
	} elseif ( $wp_query->is_tag ) {
			$current = 'tag';
	} elseif ( $wp_query->is_tax ) {
			$current = 'tax';
	} elseif ( $wp_query->is_archive ) {
			if ( $wp_query->is_day ) {
					$current = 'day';
			} elseif ( $wp_query->is_month ) {
					$current = 'month';
			} elseif ( $wp_query->is_year ) {
					$current = 'year';
			} elseif ( $wp_query->is_author ) {
					$current = 'author';
			} else {
					$current = 'archive';
			}
	} elseif ( $wp_query->is_search ) {
			$current = 'search';
	} elseif ( $wp_query->is_404 ) {
			$current = 'notfound';
	}

	return $current;
}

/**
 * Retrieve current
 * archive title
 */
function bloom_get_archive_title() {
	$title = __( 'Archives', 'bloom' );

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'bloom' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'bloom' ), '<span>' . get_the_date() . '</span>' );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'bloom' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bloom' ) ) . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'bloom' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bloom' ) ) . '</span>' );
	} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = __( 'Asides', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = __( 'Galleries', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = __( 'Images', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = __( 'Videos', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = __( 'Quotes', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = __( 'Links', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = __( 'Statuses', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = __( 'Audios', 'bloom' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = __( 'Chats', 'bloom' );
	}

	return $title;
}

/**
 * Get settings
 */
function bloom_settings( $name = NULL, $default = NULL ) {
	global $bloom;

	if ( ! $name ) return $bloom;
	if ( isset( $bloom[ $name ] ) ) return $bloom[ $name ];
	else return $default;
}

/**
 * Format body classes
 * using modifier notation
 */
function bloom_body_classes() {
	return implode( ' ', array_map( function ($item) { return "is-{$item}"; }, get_body_class() ) );
}
