<?php

/**
 * SpyroPress Builder Rows
 *
 * Main builder rows file which contains row class, factory and functions
 *
 * @category 	Builder
 * @package 	Spyropress
 * @subpackage  Builder
 */

/**
 * Row Factory
 */
if ( ! class_exists( 'SpyropressBuilderRows' ) ) {

    class SpyropressBuilderRows {

        private $rows = array();

        function __construct() {
        }

        function register( $row_class ) {
            $this->rows[$row_class] = new $row_class();
        }

        function unregister( $row_class ) {
            if ( isset( $this->rows[$row_class] ) )
                unset( $this->rows[$row_class] );
        }

        function get_row( $type ) {
            return $this->rows[$type];
        }

        function get_rows() {
            return $this->rows;
        }
    }
}

/**
 * Row
 */
if ( ! class_exists( 'SpyropressBuilderRow' ) ) {

    class SpyropressBuilderRow {
        var $config;

        function row_wrapper( $row_ID, $row ) {
            $section_class = '';
            if( isset( $row['options']['custom_container_class'] ) && !empty( $row['options']['custom_container_class'] ) )
                $section_class = ' class="' . $row['options']['custom_container_class'] . '"';
        
            $row_html = sprintf( '
                <div id="%1$s"%2$s>
                    <div class="%3$s">
                        %4$s
                    </div>
                </div>', $row_ID, $section_class, get_row_class( true ), builder_render_frontend_columns( $row['columns'] )
            );
            
            return $row_html;
        }
    }
}

/**
 * Render Row Types List
 */
function spyropress_builder_render_rows() {
    global $spyropress_builder;
    $rows = $spyropress_builder->rows->get_rows();

    if ( empty( $rows ) )
        return;

    $content = '<ul>';
    foreach ( $rows as $key => $row ) {
        $content .= sprintf( '<li><a class="row-action-add" href="#" data-row-type="%s"><img src="%s"/ ><strong>%s</strong></a></li>',
            $key, $row->config['icon'], $row->config['name'] );
    }
    $content .= '</ul>';

    echo $content;
}

/**
 * Registers a SpyropressBuilderRow Row
 * @param string $row_class The name of a class that extends SpyropressBuilderRow
 */
function spyropress_builder_register_row( $row_class ) {
    global $spyropress_builder;

    $spyropress_builder->rows->register( $row_class );
}

/**
 * Unregisters a SpyropressBuilderRow row.
 * @param string $row_class The name of a class that extends SpyropressBuilderRow
 */
function spyropress_builder_unregister_row( $row_class ) {
    global $spyropress_builder;

    $spyropress_builder->rows->unregister( $row_class );
}

?>