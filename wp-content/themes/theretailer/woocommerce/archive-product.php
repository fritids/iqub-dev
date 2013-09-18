<?php
 
global $theretailer_theme_options;

global $wp_query, $woocommerce;

$archive_product_sidebar = 'no';

if ( ($theretailer_theme_options['sidebar_listing']) && ($theretailer_theme_options['sidebar_listing'] == 1) ) { $archive_product_sidebar = 'yes'; };

if (isset($_GET["product_listing_sidebar"])) { $archive_product_sidebar = $_GET["product_listing_sidebar"]; }


$brand = get_query_var('brand');
global $query_string;

$args = array(
    'post_type' => 'product'
);
if ($brand) {
    $args['author_name'] = $brand;
}
query_posts( $args );
$woocommerce->query->unfiltered_product_ids = $wp_query->post_count;

$current_brand = get_user_by('slug', $brand);

get_header('shop'); 
?>

	<div class="container_12">

        <?php if ($archive_product_sidebar != "yes") { ?>            
        	<div class="grid_12">    
        <?php } else { ?>
        	<div class="grid_9 push_3">           
        	
        <?php } ?>
            
            <?php if ($archive_product_sidebar != "yes") { ?>            
           		<div class="listing_products_no_sidebar">           
            <?php } else { ?> 
            	<div class="listing_products">    
            <?php } ?>
        
                <div class="category_header">

                    <h1 class="page-title">
                        <?php if ($current_brand) {
                            echo $current_brand->display_name . ' ' . __('Shop', 'iqubator');
                        } else {
                            woocommerce_page_title();
                        } ?>
                    </h1>
                    
                    <?php
					if (!$brand) {
					   woocommerce_get_template( 'loop/result-count.php' );
                    }
					
					global $woocommerce;

					$orderby = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
			
					woocommerce_get_template( 'loop/orderby.php', array( 'orderby' => $orderby ) );
					
					?>
                    
                    <div class="clr"></div>
            
                    <div class="hr padding30 fixbottom10"></div>
                
                </div>
    
            <?php do_action( 'woocommerce_archive_description' ); ?>
    
            <?php if ( is_tax() ) : ?>
                <?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
            <?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
                <?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
            <?php endif; ?>
            
            <div class="listing_products__desc">

                <?php if ( have_posts() ) : ?>
                        
                        <?php if (woocommerce_product_subcategories()) : ?><hr class="paddingbottom40" /><?php endif; ?>
        
                        <?php while ( have_posts() ) : the_post(); ?>
        
                            
                                <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                           
        
                        <?php endwhile; // end of the loop. ?>
                    
        
                <?php else : ?>
        
                    <?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
        
                        <p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
        
                    <?php endif; ?>
        
                <?php endif; ?>
            
            </div>
            
            <div class="contact_form woocommerce hidden">
                <?php echo do_shortcode('[contact-form-7 id="117" title="Contact brand"]'); ?>
            </div>

            <div class="clear"></div>
            
            <?php
			
			if ( $wp_query->max_num_pages > 1 ) {
				if (function_exists("emm_paginate")) {
					emm_paginate();
				}
			}
			 
			?>
    
        
            </div>
        </div>
        
        <?php if ($archive_product_sidebar == "yes") { ?>  
            <?php if ( is_active_sidebar( 'widgets_product_listing' ) ) : ?>
                <div class="grid_3 pull_9">
                    <div class="gbtr_aside_column_left">
                        <?php dynamic_sidebar('widgets_product_listing'); ?>
                    </div>
                </div>            
            <?php endif; ?>
                      
        <?php } ?>           
        
    </div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer('shop'); ?>