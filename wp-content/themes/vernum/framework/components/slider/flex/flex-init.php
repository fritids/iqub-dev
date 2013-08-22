<?php

/**
 * Flex Slider
 * Related functions
 */

/**
 * Slides Options
 */
function get_flexslides_setting() {
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
                    'label' => __( 'Type', 'spyropress' ),
                    'id' => 'type',
                    'type' => 'select',
                    'options' => array(
                        'image' => __( 'Image', 'spyropress' ),
                        'video' => __( 'Video', 'spyropress' )
                    ),
                    'std' => 'image'
                ),

                array(
                    'label' => __( 'Image', 'spyropress' ),
                    'id' => 'image',
                    'type' => 'upload',
                ),

                array(
                    'label' => __( 'Link', 'spyropress' ),
                    'id' => 'link',
                    'type' => 'text',
                ),

                array(
                    'label' => __( 'Caption/Video ', 'spyropress' ),
                    'id' => 'caption',
                    'type' => 'textarea',
                ),
            )
        )
    );

    return $slides;
}

/**
 * Slider Setting Options
 */
function get_flexslider_setting() {
    $settings = array(
        array(
            'label' => __( 'Flex Slider', 'spyropress' ),
            'type' => 'heading',
            'icon' => 'general',
            'slug' => 'flexslider'
        ),

        array(
            'label' => __( 'Direction', 'spyropress' ),
            'id' => 'direction',
            'type' => 'select',
            'desc' => __( 'Select the sliding direction.', 'spyropress' ),
            'options' => array(
                'horizontal' => __( 'Horizontal', 'spyropress' ),
                'vertical' => __( 'Vertical', 'spyropress' )
            )
        ),

        array(
            'label' => __( 'Animation', 'spyropress' ),
            'id' => 'animation',
            'type' => 'select',
            'options' => array(
                'fade' => __( 'Fade', 'spyropress' ),
                'slide' => __( 'Slide', 'spyropress' ),
            )
        ),
        array(
            'label' => __( 'Easing', 'spyropress' ),
            'id' => 'easing',
            'type' => 'select',
            'desc' => __( 'Determines the easing method used in jQuery transitions.', 'spyropress' ),
            'options' => spyropress_get_options_easing()
        ),

        array(
            'label' => __( 'Usability Features', 'spyropress' ),
            'id' => 'usabilityFeatures',
            'type' => 'checkbox',
            'class' => 'section-full',
            'options' => array(
                'reverse' => __( '<strong>Reverse:</strong> Reverse the animation direction', 'spyropress' ),
                'animationLoop' => __( '<strong>Animation Loop:</strong> Should the animation loop', 'spyropress' ),
                'slideshow' => __( '<strong>Slideshow:</strong> Animate slider automatically', 'spyropress' ),
                'randomize' => __( '<strong>Randomize:</strong> Randomize slide order', 'spyropress' ),
                'pauseOnAction' => __( '<strong>Pause on Action:</strong> Pause the slideshow when interacting with control elements, highly recommended', 'spyropress' ),
                'pauseOnHover' => __( '<strong>Pause On Hover:</strong> Pause the slideshow when hovering over slider, then resume when no longer hovering', 'spyropress' ),
                'video' => __( '<strong>Video:</strong> If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches', 'spyropress' ),
            )
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
            'desc' => __( 'Set the speed of animations, in milliseconds.', 'spyropress' ),
            'max' => 4000
        ),

        array(
            'label' => __( 'Controls &amp; Navigation', 'spyropress' ),
            'type' => 'toggle'
        ),

        array(
            'label' => __( 'Control Nav', 'spyropress' ),
            'id' => 'controlNav',
            'type' => 'select',
            'options' => array(
                'no-paging' => __( 'None', 'spyropress' ),
                'paging' => __( 'Paging', 'spyropress' ),
                'thumbnails' => __( 'Thumbnails', 'spyropress' )
            ),
            'desc' => __( 'Create navigation for paging control of each clide? Note: Leave true for manualControls usage.', 'spyropress' ),
            'std' => 'paging'
        ),

        array(
            'label' => __( 'Control Features', 'spyropress' ),
            'id' => 'controlFeatures',
            'type' => 'checkbox',
            'css' => 'section-full',
            'options' => array(
                'directionNav' => __( '<strong>Direction Nav:</strong> Disable next/previous navigation', 'spyropress' ),
                'keyboard' => __( '<strong>Keyboard:</strong> Disable slider navigating via keyboard left/right keys', 'spyropress' ),
                'pausePlay' => __( '<strong>Pause/Play:</strong> Enable pause/play element to control slider slideshow', 'spyropress' )
            )
        ),

        array( 'type' => 'row' ),

            array( 'type' => 'col', 'size' => 6 ),
                array(
                    'label' => __( 'Prev Text', 'spyropress' ),
                    'id' => 'prevText',
                    'type' => 'text',
                    'class' => 'section-full',
                    'desc' => __( 'Set the text for the "previous" directionNav item.', 'spyropress' ),
                    'std' => 'Previous'
                ),
                array(
                    'label' => __( 'Play Text', 'spyropress' ),
                    'id' => 'playText',
                    'type' => 'text',
                    'class' => 'section-full',
                    'desc' => __( 'Set the text for the "play" pausePlay item.', 'spyropress' ),
                    'std' => 'Play'
                ),
            array( 'type' => 'col_end' ),

            array( 'type' => 'col', 'size' => 6 ),
                array(
                    'label' => __( 'Next Text', 'spyropress' ),
                    'id' => 'nextText',
                    'type' => 'text',
                    'class' => 'section-full',
                    'desc' => __( 'Set the text for the "next" directionNav item.', 'spyropress' ),
                    'std' => 'Next'
                ),
                array(
                    'label' => __( 'Pause Text', 'spyropress' ),
                    'id' => 'pauseText',
                    'type' => 'text',
                    'class' => 'section-full',
                    'desc' => __( 'Set the text for the "pause" pausePlay item.', 'spyropress' ),
                    'std' => 'Pause'
                ),
            array( 'type' => 'col_end' ),

        array( 'type' => 'row_end' ),

        array( 'type' => 'toggle_end' )
    );

    return $settings;
}

/**
 * Enqueue Style and Script
 */
function enqueue_flexslider_assets() {
    //wp_enqueue_style( 'flex', template_url() . 'assets/slider/flexslider/flexslider.css', '', '2.0' );
    //wp_enqueue_script( 'flex', template_url() . 'assets/slider/flexslider/jquery.flexslider-min.js', '', '2.0', true );
}

/* generate jquery */
function generate_flexslider_jquery( $slider_id, $settings = '' ) {

    $defaults = array(
        'smoothHeight' => true,
        'animationLoop' => false,
        'slideshow' => false,
        'pauseOnAction' => false,
    );

    $params = wp_parse_args( $settings, $defaults );

    
    // Easing
    if ( isset( $params['easing'] ) )
        $params['useCSS'] = false;

    // slideshowSpeed
    if ( isset( $params['slideshowSpeed'] ) )
        $params['slideshowSpeed'] = ( int )$params['slideshowSpeed'] * 1000;

    // animationSpeed
    if ( isset( $params['animationSpeed'] ) )
        $params['animationSpeed'] = ( int )$params['animationSpeed'];

    // reverse, animationLoop, slideshow, randomize, pauseOnAction, pauseOnHover, video
    if ( isset( $params['usabilityFeatures'] ) ) {
        foreach ( $params['usabilityFeatures'] as $k => $v )
            $params[$k] = true;
        
        unset( $params['usabilityFeatures'] );
    }

    // controlNav
    if ( isset( $params['controlNav'] ) ) {
        
        switch ( $params['controlNav'] ) {
            case 'thumbnails':
                $params['controlNav'] = 'thumbnails';
                break;
            case 'no-paging':
                $params['controlNav'] = false;
                break;
        }
    }

    // directionNav, keyboard, pausePlay
    if ( isset( $params['controlFeatures'] ) ) {
        foreach ( $params['controlFeatures'] as $k => $v )
            $params[$k] = false;

        if ( $params['controlFeatures']['pausePlay'] ) {
            unset( $params['pausePlay'] );
            $params['pausePlay'] = true;
        }
        
        unset( $params['controlFeatures'] );
    }

    $params = json_encode( $params );
    $params = str_replace( '}', ", 'start': slideComplete, 'after': slideComplete }",
        $params );

    $js = sprintf( "$('#%s').flexslider(%s);", $slider_id, $params );

    $js .= "function slideComplete(slider) {
            var caption = $(slider.container).find('.flex-caption').attr('style', ''),
				thisCaption = $('.flexslider .slides > li.flex-active-slide').find('.flex-caption');
			thisCaption.animate({left:20, opacity:1}, 500, 'easeOutQuint');
		}";
    add_window_load( $js );
}

/**
 * Generate Markup
 */
function flexslider_shortcode_handler( $slider_id, $slides, $settings = '' ) {

    // generate id
    $slider_id = 'flexslider_' . $slider_id;

    // script
    generate_flexslider_jquery( $slider_id, $settings );

    $out = '';
    $out .= '<div class="flexslider" id="' . $slider_id . '"><ul class="slides">';

    foreach ( $slides as $slide ) {

        $caption = $content = $thumb = '';
        
        $slide_type = isset( $slide['type'] ) ? $slide['type'] : 'image';

        // set content
        if ( 'image' == $slide_type ) {
            $content = '<img src="' . $slide['image'] . '" alt="" />';

            if( isset( $slide['caption'] ) )
                $caption = $slide['caption'];
            
            if ( isset( $settings['controlNav'] ) && 'thumbnails' == $settings['controlNav'] ) {
                
                $args = array(
                    'type' => 'src',
                    'width' => '150',
                    'return' => true,
                    'url' => $slide['image']
                );
                
                $thumb = sprintf( ' data-thumb="%s"', get_image( $args ) );
            }
        }
        elseif ( 'video' == $slide_type && isset( $slide['caption'] ) ) {
            $content = $slide['caption'];
        }

        // set link
        if ( isset( $slide['link'] ) )
            $content = sprintf( '<a href="%1$s">%2$s</a>', $slide['link'], $content );

        // set caption
        if ( ! empty( $caption ) )
            $content = $content . '<div class="flex-caption">' . $caption . '</div>';

        $out .= sprintf( '<li%2$s>%1$s</li>', $content, $thumb );
    }

    $out .= '</ul></div>';

    return $out;
}
?>