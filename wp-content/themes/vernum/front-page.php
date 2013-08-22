<?php
get_header();

if( !is_home() ) {
    while( have_posts() ) {
        the_post();
        spyropress_the_content();
    }
}
else {
    get_template_part( 'templates/blog', 'content' );
}
get_footer();
?>