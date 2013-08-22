<?php

/**
 * Module: Promo
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Promo extends SpyropressBuilderModule {

    public function __construct() {
        
        $this->path = dirname( __FILE__ );

        // Widget variable settings
        $this->description = __( 'Display content in differnet style.', 'spyropress' );
        $this->id_base = 'promo';
        $this->name = __( 'Teaser Content', 'spyropress' );
        
        // Templates
        $this->templates['teaser'] = array(
            'label' => 'Teaser Content',
            'view' => 'teaser.php'
        );
        
        $this->templates['white-overlay'] = array(
            'label' => 'White Overlay',
            'view' => 'white-overlay.php'
        );
        
        $this->templates['overlay'] = array(
            'label' => 'Overlay',
            'view' => 'overlay.php'
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
                'id' => 'align',
                'type' => 'radio',
                'options' => array(
                    'left' => 'Left Align',
                    'right' => 'Right Align',
                ),
                'std' => 'left'
            )
        );
        
        $this->fields = spyropress_get_options_link( $this->fields );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        $style = '';
        extract( $args ); extract( $instance );
        // get view to render
        include $this->get_view( $style );
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Promo' );

?>