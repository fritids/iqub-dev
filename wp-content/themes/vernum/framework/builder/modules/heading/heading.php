<?php

/**
 * Module: Heading
 * Add headings into the page layout wherever needed.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Heading extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->cssclass = 'module-heading';
        $this->description = __( 'Add headings into the page layout wherever needed.', 'spyropress' );
        $this->id_base = 'spyropress_heading';
        $this->name = __( 'Heading', 'spyropress' );

        // Fields
        $this->fields = array(

            array(
                'label' => __( 'Heading Text', 'spyropress' ),
                'id' => 'heading',
                'type' => 'text',
            ),
            
            array(
                'label' => __( 'Descriptive Text', 'spyropress' ),
                'id' => 'description',
                'type' => 'textarea',
                'rows' => 4
            ),
            
            array(
                'label' => __( 'Style', 'spyropress' ),
                'id' => 'style',
                'type' => 'select',
                'options' => array(
                    'one-line' => 'One Liner',
                    'two-lines' => 'Two Liner',
                ),
                'std' => 'two-lines'
            ),
            
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        $style = 'two-lines';
        extract( $args ); extract( $instance );

        // get view to title
        echo '<div class="title clearfix">';
            if( $heading ) echo "<div class='alpha six columns'><h2>$heading</h2></div>";
            if( $description ) echo "<div class='omega ten columns'><p class='$style'>$description</p></div>";
        echo '</div>';
    }
}

spyropress_builder_register_module( 'Spyropress_Module_Heading' );

?>