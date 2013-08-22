<?php

// chcek
if ( empty( $skills ) ) return;

echo '<article class="teaser-text">';

    if( $title ) echo '<h5>' . $title . '</h5>';
    
    echo '<ul class="skills clearfix">';
    
        foreach( $skills as $skill ) {
            echo '<li><span class="skill-title">' . $skill['title'] . '</span><div class="skill-bar"><div class="skill-bar-content" data-percentage="' . $skill['percentage'] . '">' . $skill['percentage'] . '%</div></div></li>';
        }
    echo '</ul>';

echo '</article>';
?>