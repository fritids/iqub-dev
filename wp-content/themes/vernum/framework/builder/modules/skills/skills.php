<?php

/**
 * Module: Sections
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Skills extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        
        $this->description = __( 'Skill builder.', 'spyropress' );
        $this->id_base = 'skills';
        $this->name = __( 'Skills', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),
                    
            array(
                'label' => __( 'Skill', 'spyropress' ),
                'id' => 'skills',
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
                        'label' => __( 'Percentage <em>in numbers</em>', 'spyropress' ),
                        'id' => 'percentage',
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
spyropress_builder_register_module( 'Spyropress_Module_Skills' );

?>