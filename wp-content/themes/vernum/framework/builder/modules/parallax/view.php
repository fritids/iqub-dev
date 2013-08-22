<?php

$teaser = '<div class="' . $style . ' parallax" data-speed="' . $speed . '" data-bg="' . $image . '"><h4>' . $title . '</h4><p>' . $content . '</p>';
$url = ( $link_url ) ? get_permalink( $link_url ) : $url;
if ( $url ) {
    
    $button_class = '';
    if( 'plain-overlay' == $style ) $button_class = ' scroll green';
    
    $url_text = ( $url_text ) ? $url_text : 'Read More';
    $teaser .= '<a href="' . $url . '" class="button ' . $button_class . '">' . $url_text . '</a>';
}
$teaser .= '</div>';

echo do_shortcode( $teaser );
?>