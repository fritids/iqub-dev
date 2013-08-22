<?php

/**
 * Shortcodes
 */

init_shortcode();
function init_shortcode() {
    
    $shortcodes = array(
        'news-letter'   => 'spyropress_news_letter',
        'socials'       => 'spyropress_social_information'
    );
    
    foreach( $shortcodes as $tag => $func )
        add_shortcode( $tag, $func );
}

function spyropress_news_letter( $atts = array(), $content = '' ) {
    
    return '<div class="newsletter-form">
				<div class="pencil"><input class="sub_email" type="email" id="email" name="subscribe" /></div>
				<button class="sub_send" id="submit">Submit</button>
			</div>';
}

function spyropress_social_information( $atts = array(), $content = '' ) {

    $socials = get_setting_array( 'socials' );
    if( empty( $socials ) ) return;
    
    $content = '';
    foreach( $socials as $social ) {
        $content .= '<li><a href="' . $social['link'] . '"><i class="icon-' . $social['network'] . '"></i></a></li>';
    }
    
    return '<ul class="socials bot clearfix">' . $content . '</ul>';
}

add_action( 'init', 'wpcf7_add_shortcode_submit2', 5 );

function wpcf7_add_shortcode_submit2() {
	if( defined( 'WPCF7_VERSION' ) ) {
        wpcf7_remove_shortcode( 'submit', 'wpcf7_submit_shortcode_handler' );
        wpcf7_add_shortcode( 'submit', 'my_submit_shortcode_handler' );
    }
}

function my_submit_shortcode_handler( $tag ) {
	$tag = new WPCF7_Shortcode( $tag );

	$class = wpcf7_form_controls_class( $tag->type );

	$atts = array();

	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_option( 'id', 'id', true );
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

	$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

	if ( empty( $value ) )
		$value = __( 'Send', 'wpcf7' );

	$atts['type'] = 'submit';
	//$atts['value'] = $value;

	$atts = wpcf7_format_atts( $atts );

	$html = sprintf( '<button %1$s>%2$s</button>', $atts, $value );

	return $html;
}
?>