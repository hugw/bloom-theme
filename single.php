<?php
/**
 * Single page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['post'] = $post = new Timber\Post();
$ctx['type'] = 'single';

$templates = ['single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig', 'page.twig'];

Timber::render( $templates, $ctx );
