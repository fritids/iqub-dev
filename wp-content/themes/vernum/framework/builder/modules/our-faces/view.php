<?php

// chcek
if ( empty( $faces ) ) return;

echo '<article class="teaser-text">';

    if( $title ) echo '<h5>' . $title . '</h5>';
    
    $count = 0;
    foreach( $faces as $face ) {
        ++$count;
        
        $class = '';
        
        if( 1 == $count )
            $class = ' alpha';
        if( 3 == $count ) {
            $count = 0;
            $class = ' omega';
        }
        
        $social = '';
        $social .= isset( $face['facebook'] ) ? '<li><a href="' . $face['facebook'] . '"><i class="icon-facebook"></i></a></li>' : '';
        $social .= isset( $face['twitter'] ) ? '<li><a href="' . $face['twitter'] . '"><i class="icon-twitter"></i></a></li>' : '';
        $social .= isset( $face['linkedin'] ) ? '<li><a href="' . $face['linkedin'] . '"><i class="icon-linkedin"></i></a></li>' : '';
        
        if( $social ) $social = '<ul>' . $social . '</ul>';
        
        echo '<div class="one-third column' . $class . '">
            <figure class="picture">
        		<img src="' . $face['image'] . '" alt="" />
        		<figcaption>
        			<span>' . $face['title'] . '</span>
        			' . $social . '
        		</figcaption>
        	</figure>
        </div>';
    }
    
echo '</article>';
?>