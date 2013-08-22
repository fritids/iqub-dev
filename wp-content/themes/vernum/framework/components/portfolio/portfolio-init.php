<?php

/**
 * Portfolio Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPortfolio extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_filter( 'builder_include_modules', array( $this, 'register_module' ) );
    }

    function register() {

        // Init Post Type
        $post = new SpyropressCustomPostType( 'Portfolio' );
        
        // Add Taxonomy
        $post->add_taxonomy( 'Portfolio Category', '', 'Categories', array( 'hierarchical' => true ) );
    }
    
    function register_module( $modules ) {

        $modules[] = $this->path . '/module/module.php';

        return $modules;
    }
}

/**
 * Init the Component
 */
new SpyropressPortfolio();
?>