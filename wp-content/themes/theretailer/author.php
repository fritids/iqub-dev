<?php
 
global $theretailer_theme_options;

global $wp_query;
$brand = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
iq_disable_zopim_chat();

$archive_product_sidebar = 'no';

if ( ($theretailer_theme_options['sidebar_listing']) && ($theretailer_theme_options['sidebar_listing'] == 1) ) { $archive_product_sidebar = 'yes'; };

if (isset($_GET["product_listing_sidebar"])) { $archive_product_sidebar = $_GET["product_listing_sidebar"]; }

get_header('shop'); ?>

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

                    <h1 class="page-title"><?php echo $curauth->display_name . ' ' . __('Profile', 'iqubator'); ?></h1>
                    
                    <?php
					
					woocommerce_get_template( 'loop/result-count.php' );
					
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
                <?php echo apply_filters('the_content', $brand->description); ?>
            </div>           
            
            <div class="contact_form woocommerce hidden">
                <?php echo do_shortcode('[contact-form-7 id="150" title="Contact brand"]'); ?>
            </div>      
            

                <?php 
                    // global $quick_chat;
                    // if(is_object($quick_chat) && method_exists($quick_chat, 'quick_chat')){
                    //    echo $quick_chat->quick_chat(400, 'default', 1, 'left', 0, 0, 1, 1, 1, 1);
                    // }
                ?>

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
        
        <?php if ( is_active_sidebar( 'widgets_brand_details' ) ) : ?>
            <div class="grid_3 pull_9">
                <div class="gbtr_aside_column_left">
                    <?php dynamic_sidebar('widgets_brand_details'); ?>
                </div>
            </div>            
        <?php endif; ?>
                      
        
    </div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer('shop'); ?>