<?php

/**
 * Module: Sections
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Sections extends SpyropressBuilderModule {

    public function __construct() {

        /* Widget variable settings. */

        $this->cssclass = '';
        $this->description = __( 'Sections Builder.', 'spyropress' );
        $this->id_base = 'sections';
        $this->name = __( 'Sections', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Section', 'spyropress' ),
                'id' => 'sections',
                'type' => 'repeater',
                'item_title' => 'bucket',
                'fields' => array(
                    
                    array(
                        'label' => __( 'Menu Text', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Section', 'spyropress' ),
                        'id' => 'bucket',
                        'type' => 'select',
                        'options' => spyropress_get_buckets()
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
spyropress_builder_register_module( 'Spyropress_Module_Sections' );

?>