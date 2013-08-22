<?php

// chcek
if ( empty( $services ) ) return;

$count = 0;
foreach( $services as $item ) {
    ++$count;
    
    $icon = isset( $item['icon'] ) ? '<div class="hex"><span aria-hidden="true" class="li_' . $item['icon'] . '"></span></div>' : '';
    $class = '';
    
    if( 1 == $count )
        $class = ' alpha';
    if( 3 == $count ) {
        $count = 0;
        $class = ' omega';
    }
    
    echo '<div class="one-third column' . $class . '">
        <figure class="service">
    		' . $icon . '
    		<figcaption>
    			<h3>' . $item['title'] . '</h3>
    			<p>' . $item['description'] . '</p>
    		</figcaption>
    	</figure>
    </div>';
}
?>