<?php

// Setup Instance for view
$instance = spyropress_clean_array( $instance );

// tempalte
$tmpl = '<!-- isotope-portfolio --><div class="container"><div id="portfolio-container">{content}</div></div><!-- /isotope-portfolio -->';

    
$terms = get_terms( 'portfolio_category' );
if( !empty( $terms ) ) {
    $filters = '<!-- isotope-filter -->';
    $filters .= '<div class="container"><div class="sixteen columns center-filters alpha omega"><ul id="filters" class="option-set"><li class="selected"><a href="#filter" data-filter="*">show all</a></li>';
    foreach( $terms as $term ) {
        $filters .= '<li>/</li><li><a href="#filter" data-filter=".' . $term->slug . '">' . $term->name . '</a></li>';
    }
    $filters .= '</ul></div></div><!-- /isotope-filter -->';
    
    echo $filters;
}    

// output content
echo $this->query( $instance, $tmpl );  
?>