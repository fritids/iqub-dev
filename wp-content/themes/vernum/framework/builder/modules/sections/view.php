<?php

// chcek
if ( empty( $sections ) ) return;

$count = 0;
$sections_id = array_flat( $sections );
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'bucket',
    'post__in' => $sections_id,
    'orderby' => 'post__in'
);
$query = new WP_Query( $args );
while( $query->have_posts() ) {
    $section = $sections[$count];
    $count++;
    
    $query->the_post();
    $title = ( isset( $section['title'] ) ) ? $section['title'] : get_the_title();
    $section_id = get_post_field( 'post_name', get_the_ID() );
    
    echo '<!-- ' . $section_id . ' -->';
    echo '<section id="section-' . $section_id . '">';
        spyropress_the_content();    
    echo '</section> <!-- /' . $section_id . ' -->';
}
wp_reset_query();
?>