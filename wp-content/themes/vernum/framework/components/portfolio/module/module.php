<?php

/**
 * Module: Portfolio
 * Display a list of portfolio
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Portfolio extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->cssclass = 'module-portfolio';
        $this->description = __( 'Display a list of portfolio.', 'spyropress' );
        $this->id_base = 'spyropress_portfolio';
        $this->name = __( 'Portfolio', 'spyropress' );

        // Fields
        $this->fields = array(            
            array(
                'label' => __( 'Number of items per page', 'spyropress' ),
                'id' => 'limit',
                'type' => 'range_slider',
                'max' => 30,
                'std' => 4
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args );

        // get view to render
        include $this->get_view();
    }
    
    function query( $atts, $content = null ) {

        $default = array (
            'post_type' => 'portfolio',
            'limit' => -1,
            'columns' => 3,
            'row' => false,
            'pagination' => false,
            'callback' => 'generate_portfolio_item',
            'item_class' => 'portfolio-entry'
        );
        $atts = wp_parse_args( $atts, $default );
        
        if ( $content )
            return token_repalce( $content, spyropress_query_generator( $atts ) );
    
        return spyropress_query_generator( $atts );
    }

}

spyropress_builder_register_module( 'Spyropress_Module_Portfolio' );


// Item HTML Generator
function generate_portfolio_item( $post_ID, $atts ) {

    // these arguments will be available from inside $content
    $image = array(
        'post_id' => $post_ID,
        'echo' => false,
        'width' => 420
    );
    $image_tag = get_image( $image );
    
    $image['width'] = 9999;
    $image['type'] = 'src';
    $image_url = get_image( $image );
    
    // item tempalte
    $terms = get_the_terms( $post_ID, 'portfolio_category' );
    $class = '';
    if( !empty( $terms ) ) {
        foreach( $terms as $term ) {
            $class .= ' ' . $term->slug;
        }
    }
    
    $item_tmpl = '
    <div class="one-third column item ' . $class . '">
        <figure class="portfolio-item">
            <a class="portfolio-thumb swipebox" href="' . $image_url . '">
                ' . $image_tag . '
            </a>
            <figcaption class="item-description">
                <span>' . get_the_title( $post_ID ) . '</span>
            </figcaption>
        </figure>
    </div>';
    
    return $item_tmpl;
}
?>