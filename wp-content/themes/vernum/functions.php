<?php

/**
 * SpyroPress is a theme framework for professional WordPress theme designing developed by SpyroSol.
 *
 * DON'T HACK ME!! You should NOT modify the SpyroPress theme framework to avoid issues with updates in the future.
 * It's designed to offer cutting edge flexibility - with lots of ways to manipulate output!
 *
 * @package SpyroPress
 */

set_time_limit( 600 );

/**
 * contentn width
 */
if ( ! isset( $content_width ) ) $content_width = 726;

/**
 * Starting SpyroPress Engine
 */
load_template( get_template_directory() . '/framework/spyropress.php', true );
load_template( get_template_directory() . '/includes/init.php', true );

/**
 * Add theme support for spyropress framework features
 */
add_action( 'after_setup_theme', 'my_theme_setup', 4 );
function my_theme_setup() {

    // Add wordpress features
    add_theme_support( 'automatic-feed-links' );

    // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
    add_theme_support( 'post-thumbnails' );

    // Add Components
    add_theme_support( 'spyropress-components', array( 'bucket', 'portfolio', 'pricing-table', 'slider' ) );

    // Root Relative Urls Support
    add_theme_support( 'relative-urls' );
    
    // SpyroPress Builder
    add_theme_support( 'spyropress-builder' );
    
    // Menus
    add_theme_support( 'spyropress-core-menus', array( 'primary' ) );
    
    // Add Sidebars
    $sidebars = array(
        'primary' => array(
            'name' => __( 'Primary', 'spyropress' ),
            'description' => __( 'The main (primary) widget area, most often used as a sidebar.','spyropress' ),
            'before_widget' => '<section id="%1$s" class="clearfix widget %2$s">',
        )
    );
    add_theme_support( 'spyropress-core-sidebars', $sidebars );

    // Options
    $options = array(
        'theme' => array(
            'page_title' => __( 'Theme Options', 'spyropress' ),
            'menu_title' => __( 'Theme Options', 'spyropress' ),
            'isactive' => true,
            'hidden' => false
        )
    );
    add_theme_support( 'spyropress-options', $options );
    
    // Add Sliders
    $sliders = array(
        'flex' => __( 'Flex Slider', 'spyropress' ),
        'fw' => __( 'Full Width Slider', 'spyropress' ),
    );
    add_theme_support( 'spyropress-sliders', $sliders );
}
?>