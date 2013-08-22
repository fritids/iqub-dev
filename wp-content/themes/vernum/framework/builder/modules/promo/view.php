<?php

$left_content = $right_content = '';

if( 'left' == $align ) {
    $left_content = 'alpha';
    $right_content = 'omega';
}
elseif( 'right' == $align ) {
    $left_content = 'omega';
    $right_content = 'alpha';
}

$image = '<div class="eight columns ' . $left_content . '"><img src="' . $image . '"></div>';
$teaser = '<figcaption class="eight columns ' . $right_content . '"><h3>' . $title . '</h3><p>' . $content . '</p>';
$url = ( $link_url ) ? get_permalink( $link_url ) : $url;
if ( $url ) {
    $url_text = ( $url_text ) ? $url_text : 'Read More';
    $teaser .= '<a href="' . $url . '" class="button">' . $url_text . '</a>';
}
$teaser .= '</figcaption>';

?>
<figure class="promo clearfix">
<?php
    if( 'left' == $align )
        echo $image . $teaser;
    elseif( 'right' == $align )
        echo $teaser . $image;
?>	
</figure>