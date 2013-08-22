<?php

/**
 * Module: Parallax
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

global $parallax_speed;
$parallax_speed = 5;

class Spyropress_Module_Parallax extends SpyropressBuilderModule {

    public function __construct() {
        
        $this->path = dirname( __FILE__ );

        // Widget variable settings
        $this->description = __( 'Create parallax in differnet style.', 'spyropress' );
        $this->id_base = 'parallax';
        $this->name = __( 'Parallax Area', 'spyropress' );
        
        // Templates        
        $this->templates['white-overlay'] = array(
            'label' => 'White Overlay',
        );
        
        $this->templates['plain-overlay'] = array(
            'label' => 'Plain Overlay',
        );
        
        $this->templates['testimonial'] = array(
            'label' => 'Testimonials',
            'view' => 'testimonial.php'
        );
        
        // Fields
        $this->fields = array(
            
            array(
                'label' => 'Style',
                'id' => 'style',
                'type' => 'select',
                'options' => $this->get_option_templates()
            ),
            
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
            ),
            
            array(
                'label' => __( 'Content', 'spyropress' ),
                'id' => 'content',
                'type' => 'textarea',
                'rows' => 6
            ),
            
            array(
                'label' => __( 'Image', 'spyropress' ),
                'id' => 'image',
                'type' => 'upload'
            ),
            
            array(
                'label' => 'Testimonials',
                'type' => 'toggle'
            ),
            
            array(
                'label' => __( 'Testimonials', 'spyropress' ),
                'id' => 'testimonials',
                'type' => 'repeater',
                'item_title' => 'title',
                'hide_label' => true,
                'fields' => array(
                    
                    array(
                        'label' => __( 'Content', 'spyropress' ),
                        'id' => 'content',
                        'type' => 'textarea',
                        'rows' => 5
                    ),
                    
                    array(
                        'label' => __( 'Image', 'spyropress' ),
                        'id' => 'image',
                        'type' => 'upload'
                    ),
                    
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Position', 'spyropress' ),
                        'id' => 'position',
                        'type' => 'text'
                    )
                )
            ),
            
            array(
                'type' => 'toggle_end'
            ),
        );
        
        $this->fields = spyropress_get_options_link( $this->fields );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        global $parallax_speed;
        $speed = $parallax_speed;
        $parallax_speed--;
        if( 0 == $parallax_speed )
            $parallax_speed = 5;
        
        $speed = $speed / 10;
    
        // extracting info
        $style = '';
        extract( $args ); extract( $instance );
        // get view to render
        include $this->get_view( $style );
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Parallax' );

?>