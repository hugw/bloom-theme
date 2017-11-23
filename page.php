<?php
/**
 * Static page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['page'] = $page = new Timber\Post();

Timber::render( ['page-' . $page->post_name . '.twig', 'page.twig'], $ctx );
