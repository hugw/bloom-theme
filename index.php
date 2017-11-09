<?php
/**
 * Main page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
$ctx['posts'] = new Timber\PostQuery();

Timber::render( ['index.twig'], $ctx );
