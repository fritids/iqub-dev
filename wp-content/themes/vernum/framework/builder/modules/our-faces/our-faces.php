<?php

/**
 * Module: Our Faces
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Our_Faces extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        
        $this->description = __( 'Let you build your team section.', 'spyropress' );
        $this->id_base = 'our_faces';
        $this->name = __( 'Our Faces', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),
            
            array(
                'label' => __( 'Faces', 'spyropress' ),
                'id' => 'faces',
                'type' => 'repeater',
                'item_title' => 'title',
                'hide_label' => true,
                'fields' => array(
                    
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Image', 'spyropress' ),
                        'id' => 'image',
                        'type' => 'upload'
                    ),
                    
                    array(
                        'label' => __( 'Facebook', 'spyropress' ),
                        'id' => 'facebook',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Twitter', 'spyropress' ),
                        'id' => 'twitter',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Linkedin', 'spyropress' ),
                        'id' => 'linkedin',
                        'type' => 'text'
                    ),
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args ); extract( $instance );
        // get view to render
        include $this->get_view();
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Our_Faces' );

?>