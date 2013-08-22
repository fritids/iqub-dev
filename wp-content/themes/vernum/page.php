<?php

/**
 * Default Page Template
 */

get_header();

spyropress_before_main_container();
echo '<!-- content -->';

    spyropress_before_loop();
    while( have_posts() ) {
        the_post();
        
        spyropress_before_post();
        
            spyropress_before_post_content();
            spyropress_the_content();
            wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'spyropress' ), 'after' => '</div>' ) );
            spyropress_after_post_content();
            
        spyropress_after_post();
    }
    spyropress_after_loop();
echo '<!-- /content -->';
spyropress_after_main_container();
get_footer();

?>