<?php
/**
 * Static page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['post'] = $post = new Timber\Post();
$ctx['type'] = 'page';

Timber::render( ['page-' . $post->post_name . '.twig', 'page.twig'], $ctx );
