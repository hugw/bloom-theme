<?php
/**
 * Ads
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

function ad_slot( $name ) {
  $items = get_field( "ads_{$name}_items", 'options' );
  $width = get_field( "ads_{$name}_settings_width", 'options' );
  $height = get_field( "ads_{$name}_settings_height", 'options' );

  // Ensure item is valid and have settings
  if( !( $items && $width && $height ) ) return;

  // Filter out inactive items
  $items = array_filter($items, function ($item) {
    return ( $item['status'] == 'active' );
  });

  $items_count = count($items);

  // Ensure we have at least
  // one valid item
  if ( !$items_count ) return;

  // Coin flip
  $sample_key = rand(0, $items_count - 1);
  $item = array_values($items)[$sample_key];

  // Render ad slot
  $ctx = [ 'item' => $item, 'width' => $width, 'height' => $height, 'name' => $name ];
  Timber::render( 'partials/ad-slot.twig', $ctx );
}
