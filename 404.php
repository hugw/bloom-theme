<?php
/**
 * Error 404 page
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

$ctx = Timber::get_context();
Timber::render( '404.twig', $ctx );
