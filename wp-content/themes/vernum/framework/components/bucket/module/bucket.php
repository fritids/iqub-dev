<?php

/**
 * Module: Bucket
 * A list of partial layouts created using Template Builder.
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Bucket extends SpyropressBuilderModule {

    public function __construct() {

        /* Widget variable settings. */

        $this->cssclass = 'module-bucket';
        $this->description = __( 'A list of partial layouts created using Template Builder.', 'spyropress' );
        $this->id_base = 'spyropress_bucket';
        $this->name = __( 'Bucket', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),
            array(
                'label' => __( 'Buckets', 'spyropress' ),
                'desc' => __( 'Partial Layout created using Template Builder.', 'spyropress' ),
                'id' => 'bucket',
                'type' => 'select',
                'options' => spyropress_get_buckets()
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        extract( $args );
        extract( $instance );
        // outputs the content of the widget
        ob_start();
        // get view to render
        include $this->_get_view();
        ob_get_flush();
    }

}

/**
 * Register
 */
spyropress_builder_register_module( 'Spyropress_Module_Bucket' );
register_widget( 'Spyropress_Module_Bucket' );
?>