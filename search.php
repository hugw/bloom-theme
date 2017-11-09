<?php
/**
 * Search page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['posts'] = new Timber\PostQuery();
$ctx['title'] = sprintf( __( 'Search Results for: %s', 'bloom' ), '<span>' . get_search_query() . '</span>' );

Timber::render( ['search.twig', 'archive.twig', 'index.twig'], $ctx );
