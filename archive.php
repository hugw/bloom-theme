<?php
/**
 * Archives page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['posts'] = new Timber\PostQuery();
$ctx['title'] = bloom_get_archive_title();
$ctx['description'] = term_description();


Timber::render( ['archive.twig', 'index.twig'], $ctx );
