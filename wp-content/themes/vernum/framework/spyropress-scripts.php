<?php

/**
 * Enqueue scripts and stylesheets
 *
 * @category Core
 * @package SpyroPress
 *
 */

/**
 * De-Register StyleSheets
 */
function disable_contact7_styles() {
        wp_deregister_style( 'contact-form-7' );
        wp_deregister_style( 'contact-form-7-rtl' );
}

/**
 * Register StyleSheets
 */
function spyropress_register_stylesheets() {
    
    // Default stylesheets
    wp_enqueue_style( 'base', assets_css() . 'base.css', false, false );
    wp_enqueue_style( 'skeleton', assets_css() . 'skeleton.css', false, false );
    wp_enqueue_style( 'layout', assets_css() . 'layout.css', false, false );
    wp_enqueue_style( 'fwslider', assets_css() . 'fwslider.css', false, false );
    wp_enqueue_style( 'swipebox', assets_css() . 'swipebox.css', false, false );
    wp_enqueue_style( 'font', assets_css() . 'font.css', false, false );
    wp_enqueue_style( 'linecons', assets_css() . 'linecons.css', false, false );

    // Dynamic StyleSheet
    if ( file_exists( template_path() . 'assets/css/dynamic.css' ) )
        wp_enqueue_style( 'dynamic', assets_css() . 'dynamic.css', false, '2.0.0' );

    // Builder StyleSheet
    if ( file_exists( template_path() . 'assets/css/builder.css' ) )
        wp_enqueue_style( 'builder', assets_css() . 'builder.css', false, '2.0.0' );
    
    // modernizr
    wp_enqueue_script( 'jquery' );
}

/**
 * Enqueque Scripts
 */
function spyropress_register_scripts() {

    /**
     * Register Scripts
     */
    // threaded comments
    if ( is_single() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Plugins
    wp_register_script( 'jquery-ui', assets_js() . 'jquery-ui.min.js', false, false, true );
    wp_register_script( 'jquery-isotope', assets_js() . 'jquery.isotope.min.js', false, false, true );
    wp_register_script( 'fwslider', assets_js() . 'fwslider.js', false, false, true );
    wp_register_script( 'retina', assets_js() . 'retina.js', false, false, true );
    wp_register_script( 'jquery-twitter', assets_js() . 'jquery.twitter.js', false, false, true );
    wp_register_script( 'jquery-parallax', assets_js() . 'parallax.js', false, false, true );
    wp_register_script( 'jquery-swipebox', assets_js() . 'jquery.swipebox.min.js', false, false, true );
    wp_register_script( 'ios-orientationchange-fix', assets_js() . 'ios-orientationchange-fix.js', false, false, true );
    wp_register_script( 'jquery-scrollTo', assets_js() . 'jquery.scrollTo.js', false, false, true );
    wp_register_script( 'jquery-nav', assets_js() . 'jquery.nav.js', false, false, true );
    wp_register_script( 'jquery-dropdown', assets_js() . 'jquery.dropdown.js', false, false, true );
    wp_register_script( 'jquery-sticky', assets_js() . 'jquery.sticky.js', false, false, true );
    wp_register_script( 'jquery-jpanel', assets_js() . 'jquery.jpanelmenu.js', false, false, true );
    wp_register_script( 'jquery-quovolver', assets_js() . 'jquery.quovolver.js', false, false, true );
    
    $deps = array(
        'jquery-ui',
        'jquery-isotope',
        'fwslider',
        'retina',
        'jquery-twitter',
        'jquery-parallax',
        'jquery-swipebox',
        'ios-orientationchange-fix',
        'jquery-scrollTo',
        'jquery-nav',
        'jquery-dropdown',
        'jquery-sticky',
        'jquery-jpanel',
        'jquery-quovolver'
    );
    // custom scripts
    wp_register_script( 'custom-script', assets_js() . 'custom.js', $deps, '2.1', true );

    /**
     * Enqueue All
     */
    wp_enqueue_script( 'custom-script' );
}

function spyropress_conditional_scripts() {
    
    $content = '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
    
    echo get_relative_url( $content );
}
?>