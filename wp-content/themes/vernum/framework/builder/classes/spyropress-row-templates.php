<?php

/**
 * SpyroPress Builder
 * Default builder row types
 *
 * @author 		SpyroSol
 * @category 	Builder
 * @package 	Spyropress
 */

/**
 * Blank Row
 */
class blank_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Blank Row', 'spyropress' ),
            'description' => __( 'Full width row not boxed.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_16' )
            )
        );
    }
    
    function row_wrapper( $row_ID, $row ) {
        $section_class = '';
        if( isset( $row['options']['custom_container_class'] ) && !empty( $row['options']['custom_container_class'] ) )
            $section_class = ' class="' . $row['options']['custom_container_class'] . '"';
    
        $row_html = sprintf( '
            <div id="%1$s"%2$s>
                %3$s
            </div>', $row_ID, $section_class, builder_render_frontend_columns( $row['columns'] )
        );
        
        return $row_html;
    }
}
spyropress_builder_register_row( 'blank_row_class' );

/**
 * One Column Row
 */
class one_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '1Col Row', 'spyropress' ),
            'description' => __( 'Full width row.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_16' )
            )
        );
    }
}
spyropress_builder_register_row( 'one_col_row_class' );

/**
 * Two Column Row
 */
class two_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '2Col Row', 'spyropress' ),
            'description' => __( 'Row contain 2 half columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/2col.png' ),
            'columns' => array(
                array( 'type' => 'col_8' ),
                array( 'type' => 'col_8' )
            )
        );
    }
}
spyropress_builder_register_row( 'two_col_row_class' );

/**
 * Four Column Row
 */
class four_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '4Col Row', 'spyropress' ),
            'description' => __( 'Row contain 4 one-third columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/4col.png' ),
            'columns' => array(
                array( 'type' => 'col_4' ),
                array( 'type' => 'col_4' ),
                array( 'type' => 'col_4' ),
                array( 'type' => 'col_4' )
            )
        );
    }
}
spyropress_builder_register_row( 'four_col_row_class' );

/**
 * Eight Column Row
 */
class eight_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '8Col Row', 'spyropress' ),
            'description' => __( 'Row contain 8 columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/6col.png' ),
            'columns' => array(
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' ),
                array( 'type' => 'col_2' )
            )
        );
    }
}
spyropress_builder_register_row( 'eight_col_row_class' );

/**
 * Left Sidebar Row
 */
class left_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Left Sidebar', 'spyropress' ),
            'description' => __( 'Row has left sidebar.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/left-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_4' ),
                array( 'type' => 'col_12' )
            )
        );
    }
}
spyropress_builder_register_row( 'left_sidebar_row_class' );

/**
 * Right Sidebar Row
 */
class right_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Right Sidebar', 'spyropress' ),
            'description' => __( 'Row has right sidebar.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/right-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_12' ),
                array( 'type' => 'col_4' )
            )
        );
    }
}
spyropress_builder_register_row( 'right_sidebar_row_class' );

?>