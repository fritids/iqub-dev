<?php

/**
 * Module: Sub-Pages
 * A list of sub-page titles or excerpts.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Row_Options extends SpyropressBuilderModule {

    public function __construct() {

        $this->cssclass = 'row-options';
        $this->description = __( 'Set row options and styling here.', 'spyropress' );
        $this->id_base = 'spyropress_row_options';
        $this->name = __( 'Row Options', 'spyropress' );

        // Fields
        $this->fields = array(
            
            array(
                'id' => 'show',
                'type' => 'checkbox',
                'options' => array(
                    '1' => '<strong>Disable this row temporarily</strong>'
                )
            ),
            
            array(
                'label' => __( 'Pre-defined Colors', 'spyropress' ),
                'id' => 'custom_container_class',
                'type' => 'select',
                'options' => array(
                    'grey' => 'Grey'
                )
            ),
            
            array( 'label' => __( 'Custom CSS', 'spyropress' ), 'type' => 'toggle' ),

            array(
                'id' => 'row_custom_css',
                'type' => 'textarea',
                'class' => 'section-full',
                'desc' => __( 'Token Available: {this_row}', 'spyropress' ),
            ),

            array( 'type' => 'toggle_end' )
        );

        $this->create_widget();

        add_filter( 'builder_save_row_css', array( $this, 'compile_css' ), 10, 3 );
    }

    function compile_css( $row_id, $instance, $old_instance ) {

        $row_id = isset( $instance['custom_container_id'] ) ? $instance['custom_container_id'] : $row_id;
        $insertion = '';
        
        // row custom css
        if ( $instance['row_custom_css'] )
            $insertion .= str_replace( '{this_row}', '#' . $row_id, $instance['row_custom_css'] );
        
        return $insertion;
    }
}

?>