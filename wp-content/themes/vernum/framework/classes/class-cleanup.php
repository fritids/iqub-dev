<?php

/**
 * SpyroPress Cleaner
 * Clean the wordpress with useless things inspired by Roots
 *
 * @author 		SpyroSol
 * @category 	Class
 * @package 	Spyropress
 */

class SpyropressCleanup {

    /**
     * Class constructor
     */
    public function __construct() {

        if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {

            $this->clean_head();

            // Remove class and ID''s from Custom Menus
            add_filter( 'nav_menu_css_class', array( $this, 'menu_class_filter' ), 100, 1 );
            add_filter( 'page_css_class', array( $this, 'menu_class_filter' ), 100, 1 );
            add_filter( 'nav_menu_item_id', '__return_false', 100, 1 );

            // Disable self trackbacks -- http://wp-snippets.com/disable-self-trackbacks
            add_action( 'pre_ping', array( $this, 'disable_self_ping' ) );

            if (
                ! class_exists( 'All_in_One_SEO_Pack' ) ||
                ! class_exists( 'Headspace_Plugin' ) ||
                ! class_exists( 'WPSEO_Admin' ) ||
                ! class_exists( 'WPSEO_Frontend' )
            ) {
                remove_action( 'wp_head', 'rel_canonical' );
                add_action( 'wp_head', array( $this, 'spyropress_rel_canonical' ) );
            }

            // Remove the WordPress version from RSS feeds
            add_filter( 'the_generator', '__return_false' );
        }

        $this->clean_urls();
    }

    function spyropress_rel_canonical() {
        global $wp_the_query;

        // checks
        if ( ! is_singular() ) return;
        // OR
        if ( ! $id = $wp_the_query->get_queried_object_id() ) return;

        $link = get_permalink( $id );
        echo "<link rel='canonical' href='$link' />\n";
    }

    /**
     * Cleanup wp_head()
     *
     * Remove unnecessary <link>'s
     * Remove inline CSS used by Recent Comments widget
     * Remove inline CSS used by posts with galleries
     * Remove self-closing tag and change ''s to "'s on rel_canonical()
     */
    function clean_head() {
        global $wp_widget_factory;

        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

        // Remove recent comment widget css
        if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) )
                remove_action( 'wp_head', array(
                    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'
                ) );
        // Remove default gallery css
        add_filter( 'use_default_gallery_style', '__return_false' );
    }

    /** URLS Cleanup  **/
    function clean_urls() {

        if ( ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) &&
            current_theme_supports( 'relative-urls' ) ) {

            $relative_url_filters = array(
                'bloginfo_url',
                'theme_root_uri',
                'stylesheet_directory_uri',
                'template_directory_uri',
                'plugins_url',
                'the_permalink',
                'wp_list_pages',
                'wp_list_categories',
                'wp_nav_menu',
                'the_content_more_link',
                'the_tags',
                'get_pagenum_link',
                'get_comment_link',
                'month_link',
                'day_link',
                'year_link',
                'tag_link',
                'the_author_posts_link',
                'script_loader_src',
                'style_loader_src'
            );

            foreach ( $relative_url_filters as $filter ) {
                add_filter( $filter, array( $this, 'root_relative_url' ) );
            }
        }
    }

    /**
     * root relative URLs for everything
     * inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
     */
    function root_relative_url( $input ) {
        // fix for site_url != home_url()
        if ( ! is_admin() && site_url() != home_url() && stristr( $input, 'wp-includes' ) === false ) {
            $input = str_replace( site_url(), "", $input );
        }

        $output = preg_replace_callback( '!(https?://[^/|"]+)([^"]+)?!', create_function
            ( '$matches', // If full URL is home_url("/") and this isn't a subdir install, return a slash for relative root
            'if (isset($matches[0]) && $matches[0] === home_url("/") && str_replace("http://", "", home_url("/", "http"))==$_SERVER["HTTP_HOST"]) { return "/";' .
            // If domain is equal to home_url("/"), then make URL relative
            '} elseif (isset($matches[0]) && strpos($matches[0], home_url("/")) !== false) { return $matches[2];' .
            // If domain is not equal to home_url("/"), do not make external link relative
            '} else { return $matches[0]; };' ), $input );

        // detect and correct for subdir installs
        if ( $subdir = parse_url( home_url(), PHP_URL_PATH ) ) {
            if ( substr( $output, 0, strlen( $subdir ) ) == ( substr( $output, strlen( $subdir ), strlen( $subdir ) ) ) ) {
                $output = substr( $output, strlen( $subdir ) );
            }
        }

        return $output;
    }

    /** Clean extra menu classes **/
    function menu_class_filter( $classes ) {
        return is_array( $classes ) ? preg_grep( '/^menu-ite.+/', $classes, PREG_GREP_INVERT ) : '';
    }

    function disable_self_ping( &$links ) {
        foreach ( $links as $l => $link ) {
            if ( 0 === strpos( $link, home_url() ) ) {
                unset( $links[$l] );
            }
        }
    }
}
?>