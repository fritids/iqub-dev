<?php

/**
 * Pricing Table Component
 *
 * @package		SpyroPress
 * @category	Components
 */

/**
 * SpyropressPricingTable
 *
 * @package Default-WP
 * @author phpdesigner
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class SpyropressPricingTable extends SpyropressComponent {

    private $path;

    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_shortcode( 'pricing_table',  array( $this, 'shortcode_handler' ) );
    }

    function register() {

        // Init Post Type
        $args = array( 'supports' => array( 'title' ) );
        $post_type = new SpyropressCustomPostType( 'Pricing Table', 'pricingtable', $args );

        // Shortcode Meta Box
        $instructions = '<p>' . __( 'Display price table anywhere into your posts, pages, custom post types or widgets by using the shortcode below:', 'spyropress' ) . '</p>';
        $instructions .= '<p><code>[pricing_table id={post_id}]</code></p>';

        $sc_fields['shortcode'] = array(
            array(
                'label' => 'shortcode',
                'type' => 'heading',
                'slug' => 'shortcode'
            ),

            array(
                'id' => 'instruction_info',
                'type' => 'raw_info',
                'function' => array( $this, 'set_post_id' ),
                'desc' => $instructions,
            )
        );

        $post_type->add_meta_box( 'shortcode', 'Shortcode', $sc_fields, false, false, 'side' );

        // Add Meta Boxes
        $meta_fields['table'] = array(
            array(
                'label' => 'Table',
                'type' => 'heading',
                'slug' => 'table'
            ),

            array(
                'label' => __( 'Table', 'spyropress' ),
                'type' => 'repeater',
                'id' => 'tables',
                'item_title' => 'title',
                'hide_label' => true,
                'fields' => array(

                    array(
                        'id' => 'recommended',
                        'type' => 'checkbox',
                        'options' => array(
                            '1' => 'Recommended'
                        )
                    ),

                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),

                    array( 'type' => 'row' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Price', 'spyropress' ),
                                'id' => 'price',
                                'type' => 'text'
                            ),

                            array(
                                'label' => __( 'Button Text', 'spyropress' ),
                                'id' => 'text',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Currency', 'spyropress' ),
                                'id' => 'currency',
                                'type' => 'text'
                            ),

                            array(
                                'label' => __( 'Button URL', 'spyropress' ),
                                'id' => 'url',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                    array( 'type' => 'row_end' ),

                    array(
                        'label' => __( 'Features', 'spyropress' ),
                        'type' => 'repeater',
                        'id' => 'features',
                        'item_title' => 'title',
                        'fields' => array(
                            array(
                                'label' => __( 'Title', 'spyropress' ),
                                'id' => 'title',
                                'type' => 'text'
                            )
                        )
                    )
                )
            )
        );

        $post_type->add_meta_box( 'tables', 'Tables', $meta_fields, false, false );
    }

    /**
     * Callback for post_ID for instruction box
     */
    function set_post_id( $output ) {
        global $post;
        return str_replace( '{post_id}', $post->ID, $output );
    }

    /**
     * Shortcode handler
     */
    function shortcode_handler( $atts, $content = '' ) {

        // check
        if( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) return;

        $slider_id = $atts['id'];

        // get slider meta
        $meta = get_post_custom( $slider_id );

        // get slider type
        $columns = maybe_unserialize( $meta['tables'][0] );
        if( empty( $columns ) ) return;

        // get template
        $template = 'pricing';
        if( isset( $meta['template'] ) )
            $template = maybe_unserialize( $meta['template'][0] );

        $func = "render_table_design";
        return $this->{$func}( $columns );
    }

    function render_table_design( $columns ) {
        $tables = '';
        foreach( $columns as $column ) {

            $recommended = isset( $column['recommended'] );
            $label_class = ( $recommended ) ? 'label color' : 'label black';
            $button_class = ( $recommended ) ? 'button green' : 'button';

            $features = '';
            foreach( $column['features'] as $feature ) {
                $t = ( $recommended ) ? str_replace( '<strong>', '<strong class="green">', $feature['title'] ) : $feature['title'];
                $features .= '<li>' . $t . '</li>';
            }

            $tables .= '            
            <div class="one-third column">
				<div class="plan">
					<div class="' . $label_class . '">' . $column['title'] . '</div>
					<div class="features">
						<div class="price clearfix">
							<sup class="curr">' . $column['currency'] . '</sup>' . $column['price'] . '
						</div>
						<div class="clear"></div>
						<ul>' . $features . '</ul>
					</div>
					<a href="' . $column['url'] . '" class="' . $button_class . '">' . $column['text'] . '</a>
				</div>
			</div>
            ';
        }
        return '<div class="container">' . $tables . '</div>';
    }
}

/**
 * Init the Component
 */
new SpyropressPricingTable();
?>