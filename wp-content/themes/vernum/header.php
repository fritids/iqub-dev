<?php
/*
 * Core Spyropress header template
 *
 * Customise this in your child theme by:
 * - Using hooks and your own functions
 * - Using the 'header-content' template part
 * - For example 'header-content-category.php' for category view or 'header-content.php' (fallback if location specific file not available)
 * - Copying this file to your child theme and customising - it will over-ride this file
 *
 * @package Spyropress
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php spyropress_wrapper(); ?>
    <?php spyropress_before_header(); ?>
    <!-- header -->
     <header class="top">
     <?php spyropress_before_header_content(); ?>
        <nav class="menu">
            <div class="container">
                <div class="sixteen columns">
                    <!-- Mobile Only Menu Button  -->
                    <a href="#" class="menu-trigger"><i class="icon-reorder"></i></a>
				
					<!-- logo -->
                    <?php spyropress_logo(); ?>
					
					<!-- nav menu -->
                    <?php
                        $menu = spyropress_get_nav_menu( 'primary', array( 'container' => false, 'menu_class' => 'scrolling', 'echo' => false ) );
                        $url = is_front_page() ? '#' : home_url('/#');
                        echo str_replace( '#HOME_URL#', $url, $menu );
                    ?>
				</div>
			</div>
		</nav>
    <?php spyropress_after_header_content(); ?>
    </header>
    <!-- /header -->
    <?php spyropress_after_header(); ?>