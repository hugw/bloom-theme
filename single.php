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

if( function_exists('get_field') ) {
  $ctx['related_posts'] = Timber::get_posts($post->get_field('related_posts'));
}

$templates = ['post-' . $post->ID . '.twig', 'post-' . $post->post_type . '.twig', 'post.twig', 'page.twig'];

Timber::render( $templates, $ctx );
