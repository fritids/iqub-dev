<?php

$teaser = '<div class="teaser-text"><h3>' . $title . '</h3><p>' . $content . '</p>';
$url = ( $link_url ) ? get_permalink( $link_url ) : $url;
if ( $url ) {
    $url_text = ( $url_text ) ? $url_text : 'Read More';
    $teaser .= '<a href="' . $url . '" class="button">' . $url_text . '</a>';
}
$teaser .= '</div>';

echo $teaser;
?>