<?php

/**
 * Full Width Slider
 * Related functions
 */

/**
 * Slides Options
 */
function get_fwslides_setting() {
    $slides = array(
        array(
            'label'  => __( 'Slides', 'spyropress' ),
            'type' => 'heading',
            'icon' => 'general',
            'slug' => 'instruction'
        ),

        array(
    		'label' => __( 'Slide', 'spyropress' ),
    		'type' => 'repeater',
            'id' => 'slides',
            'fields' => array(

                array(
                    'label' => __( 'Title', 'spyropress' ),
                    'id' => 'title',
                    'type' => 'text',
                ),
                
                array(
                    'label' => __( 'Description', 'spyropress' ),
                    'id' => 'description',
                    'type' => 'textarea',
                    'rows' => 5
                ),
                
                array(
                    'label' => __( 'Button Text', 'spyropress' ),
                    'id' => 'button',
                    'type' => 'text',
                    'std' => 'Read More'
                ),
                
                array(
                    'label' => __( 'Link', 'spyropress' ),
                    'id' => 'link',
                    'type' => 'text',
                ),
                
                array(
                    'label' => __( 'Image', 'spyropress' ),
                    'id' => 'image',
                    'type' => 'upload',
                ),
            )
        )
    );

    return $slides;
}

/**
 * Slider Setting Options
 */
function get_fwslider_setting() {
    $settings = array(
        array(
            'label' => __( 'Full WIdth Slider', 'spyropress' ),
            'type' => 'heading',
            'icon' => 'general',
            'slug' => 'fwslider'
        ),
        
        array(
            'label' => __( 'Slideshow Speed', 'spyropress' ),
            'id' => 'slideshowSpeed',
            'type' => 'range_slider',
            'desc' => __( 'Set how long each slide will show, in seconds.', 'spyropress' ),
            'max' => 40
        ),

        array(
            'label' => __( 'Animation Speed', 'spyropress' ),
            'id' => 'animationSpeed',
            'type' => 'range_slider',
            'desc' => __( 'Set the speed of animations, in seconds.', 'spyropress' ),
            'max' => 40
        )
    );

    return $settings;
}

/**
 * Enqueue Style and Script
 */
function enqueue_fwslider_assets() {
}

/* generate jquery */
function generate_fwslider_jquery( $slider_id, $settings = '' ) {

    $defaults = array(
        'slideshowSpeed' => 1,
        'animationSpeed' => 12,
    );

    $params = wp_parse_args( $settings, $defaults );
    
    // slideshowSpeed
    if ( isset( $params['slideshowSpeed'] ) )
        $params['duration'] = ( int )$params['slideshowSpeed'] * 1000;

    // animationSpeed
    if ( isset( $params['animationSpeed'] ) )
        $params['pause'] = ( int )$params['animationSpeed'] * 1000;

    $params = json_encode( $params );

    $js = sprintf( "new fwslider().init( %s );", $slider_id, $params );
    add_window_load( $js );
}

/**
 * Generate Markup
 */
function fwslider_shortcode_handler( $slider_id, $slides, $settings = '' ) {

    // generate id
    $slider_id = 'fwslider';

    // script
    generate_fwslider_jquery( $slider_id, $settings );

    $out = '';
    $out .= '<div class="fwslider" id="' . $slider_id . '"><div class="slider_container">';

    foreach ( $slides as $slide ) {

        $image = $content = '';

        // set content
        $image = '<img src="' . $slide['image'] . '" alt="" />';
        
        // set title
        if( isset( $slide['title'] ) )
            $content .= '<h4 class="title">' . $slide['title'] . '</h4>';
        
        // set description
        if ( isset( $slide['description'] ) )
            $content .= '<p class="description">' . $slide['description'] . '</p>';

        // set link
        if ( isset( $slide['link'] ) ) {
            $content .= '<a class="button readmore" href="' . $slide['link'] . '">' . $slide['button'] . '</a>';
        }

        $out .= sprintf( '<div class="slide"> 
			%1$s
			<div class="slide_content">
				<div class="slide_content_wrap">
					%2$s
				</div>
			</div>
		</div>', $image, $content );
    }

    $out .= '</div>
    <!-- slider navigation -->
	<div class="timers"></div>
	<div class="slide-nav nav-prev slidePrev"><span><i class="icon-chevron-left "></i></span></div>
	<div class="slide-nav nav-next slideNext"><span><i class="icon-chevron-right "></i></span></div>
    </div>';

    return $out;
}
?>