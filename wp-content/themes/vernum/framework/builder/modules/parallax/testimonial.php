<?php

$teaser = '<div class="testimonials parallax" data-speed="' . $speed . '" data-bg="' . $image . '"><div class="testimonials-overlay">';
    
    if( !empty( $testimonials ) ) {
        $teaser .= '<ul class="clearfix">';
        
        foreach( $testimonials as $testimonial ) {
            $teaser .= '
            <li>
				<div class="avatar" style="background-image: url(\'' . $testimonial['image'] .'\')"></div>
				<blockquote class="rotator">
					<p>' . $testimonial['content'] . '</p>
					<cite class="quote-author"><strong>' . $testimonial['title'] . '</strong>, ' . $testimonial['position'] . '</cite>
				</blockquote>
			</li>';
        }
        
        $teaser .= '</ul>';
    }

$teaser .= '</div></div>';

echo $teaser;
?>