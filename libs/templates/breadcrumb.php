<?php
/**
 * Breadcrumb
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

function bloom_breadcrumb() {
  if( ! function_exists('yoast_breadcrumb') ) return;

  Timber::render( 'partials/breadcrumb.twig' );
}
