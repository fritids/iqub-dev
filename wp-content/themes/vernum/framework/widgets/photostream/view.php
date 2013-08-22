<?php

$shots = array();
if ( $social_network == 'dribble' ) {
    $shots = $this->get_dribble_stream( $user, $limit );
}
if ( $social_network == 'flickr' ) {
    $shots = $this->get_flickr_stream( $user, $limit );
}
if ( $social_network == 'instagram' ) {
    $shots = $this->get_instagram_stream( $user, $limit );
}
if ( $social_network == 'pinterest' ) {
    $shots = $this->get_pinterest_stream( $user, $limit );
}

$output = '';
if ( ! empty( $shots ) && $shots ) {
    $output .= '<ul>';

    foreach ( $shots as $shot ) {
        $output .= '<li>';
        $output .= sprintf( '
                <a class="photo" target="_blank" href="%1$s" title="%2$s">
                    <img src="%3$s" alt="%2$s" />
                </a>', $shot['url'], $shot['title'], $shot['image'] );
        $output .= '</li>';
    }

    $output .= '</ul>';
}

echo $before_widget;
if ( $title )
    echo $before_title . $title . $after_title;
echo $output;
echo $after_widget;

?>