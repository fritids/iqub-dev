<?php

/**
 * Theme Meta Info for internal usage
 * 
 * Dont Mess with it.
 */
add_action('spyropress_init', 'spyropress_setup_theme');
function spyropress_setup_theme() {
    global $spyropress;
    
    $spyropress->internal_name = 'vernum';
    $spyropress->theme_name = 'Vernum';
    $spyropress->theme_version = '1.0';
    
    $spyropress->row_class = 'container';
}
?>