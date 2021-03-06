<?php

/**
 * SpyroPress Functions
 * Hooked-in functions for SpyroPress related events on the front-end.
 *
 * @category Actions
 * @package SpyroPress
 *
 */

/**
 * Location Aware get_template_part
 *
 * Turbo-charged get template part file include.
 * Appends various location information and uses those files if available in your theme folder
 */
function spyropress_get_template_part( $args ) {
    
    // Defaults
    $defaults = array(
        'part' => false
    );

    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );

    // check for null
    if ( ! $part ) return;

    // get location context
    $templates = array_reverse( spyropress_get_context() );

    // get queried object
    $object = get_queried_object();
    if ( $object && isset( $object->post_name ) )
        $templates[] = "{$object->post_name}";

    $templates = $part . '-' . implode( '.php,' . $part . '-', $templates ) . '.php,' . $part . '.php';
    $templates = explode( ',', $templates );

    // locate and load template
    locate_template( $templates, true, false );
}

/**
 * Post Class
 * Adding some extra classes.
 */
function spyropress_entry_class( $classes = '' ) {

    static $post_alt;

    // Post alt class
    $classes[] = 'post-' . ++$post_alt;
    $classes[] = ( $post_alt % 2 ) ? 'odd' : 'even alt';

    return $classes;
}

/**
 * Improved Excerpt
 */
function spyropress_get_excerpt( $args = '' ) {

    global $post;

    $defaults = array(
        'by' => get_setting( 'excerpt_by' ),
        'length' => get_setting( 'excerpt_length', 118 ),
        'ellipsis' => get_setting( 'excerpt_ellipsis' ),
        'before_text' => get_setting( 'excerpt_before_text' ),
        'after_text' => get_setting( 'excerpt_after_text' ),
        'link_to_post' => get_setting( 'excerpt_link_to_post' ),
        'keep_line_breaks' => 0,
        'link_text' => get_setting( 'excerpt_link_text' ),
        'text' => ''
    );

    $args = wp_parse_args( $args, $defaults );
    extract( $args );

    $raw_excerpt = $text;

    // Retrieve the post content
    if ( '' == $text ) {
        $text = get_the_content( '' );
    }

    // Delete all shortcodes, scripts and tags
    $text = strip_shortcodes( $text );
    $text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
    $text = strip_tags( $text, '<em><strong><i><b>' );

    // by words
    if ( $by == 'words' ) {

        $words = explode( ' ', $text, $length + 1 );
        if ( count( $words ) > $length ) {
            array_pop( $words );
            $text = implode( ' ', $words );
        }
    }
    else {

        $text = substr( $text, 0, $length );
        $text = substr( $text, 0, strripos( $text, " " ) );
        $text = trim( preg_replace( '/\s+/', ' ', $text ) );
    }

    // Check emptiness
    if ( empty( $text ) ) return '';

    $text = stripslashes( $before_text ) . $text . $ellipsis . stripslashes( $after_text );
    if ( $link_to_post ) {
        $permalink = get_permalink( $post->ID );
        $text = $text . ' <a class="more" href="' . $permalink . '">' . $link_text . '</a>';
    }

    // Apply fixes
    $text = wptexturize( $text );
    $text = convert_smilies( $text );
    $text = convert_chars( $text );

    // Return
    return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

/**
 * Set Post Views
 */
function spyropress_set_post_views( $post_id = 0 ) {

    // only run on posts and not pages
    if ( is_single() && ! is_page() ) {

        global $post;
        $postID = ( ! empty( $post_id ) ) ? $post_id : $post->ID;

        $count_key = '_post_views_count';
        $count = get_post_meta( $postID, $count_key, true );
        if ( $count == '' ) {
            $count = 0;
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, '0' );
        }
        else {
            $count++;
            update_post_meta( $postID, $count_key, $count );
        }
    }
}

/**
 * Column Generator
 */
function spyropress_column_generator( $atts, $items = null ) {

    // default setting
    $default = array(
        // column setting
        'callback' => '',
        'row' => 1,
        'row_container' => 'div',
        'row_class' => get_row_class( true ),
        'column_class' => '',
        'columns' => 1,
    );
    $atts = wp_parse_args( $atts, $default );

    $output = '';
    $counter = 0;
    $columns = $atts['columns'];
    $callback = $atts['callback'];
    $close = false;

    // set column cssClass
    $colclass = get_column_class( $columns );
    if ( $atts['column_class'] )
        $colclass .= ' ' . $atts['column_class'];

    // init wp_query
    foreach ( $items as $item ) {

        // if has column defined
        if ( $columns ) {
            $counter++;
            $atts['column_class'] = $colclass;
            if ( $counter == 1 ) {
                if ( $atts['row'] )
                    $output .= '<' . $atts['row_container'] . ' class="' . $atts['row_class'] . '">';
                $atts['column_class'] = $colclass . ' column_first';
                $close = true;
            }

            // get the item using the defined callback function
            if ( $callback )
                $output .= call_user_func_array( $callback, array( $item, $atts ) );

            if ( $counter == $columns ) {
                $counter = 0;
                $close = false;
                if ( $atts['row'] )
                    $output .= '</' . $atts['row_container'] . '>';
            }
        }
        else {
            if ( $callback )
                $output .= call_user_func_array( $callback, array( $item, $atts ) );
        }
    }
    // close last unclosed row
    if ( $close )
        $output .= '</div>';

    return $output;
}

/**
 * Query Generator
 * Generate query and loop through it, with column logic enabled.
 */
function spyropress_query_generator( $atts, $content = null ) {

    // default setting
    $default = array(
        // column setting
        'callback' => '',
        'row' => 1,
        'row_container' => 'div',
        'row_class' => get_row_class( true ),
        'column_class' => '',
        'columns' => 1,
    );
    $atts = wp_parse_args( $atts, $default );

    $output = '';
    $counter = 0;
    $columns = $atts['columns'];
    $callback = $atts['callback'];
    $close = false;

    // Add Pagination
    if ( $atts['limit'] ) {
        $atts['posts_per_page'] = $atts['limit'];
        unset( $atts['limit'] );

        if ( $atts['pagination'] ) {
            $atts['paged'] = get_page_query();
        }
    }

    // set column cssClass
    $colclass = get_column_class( $columns );
    if ( $atts['column_class'] )
        $colclass .= ' ' . $atts['column_class'];

    // if is archive merge wp_query
    if ( is_archive() || is_search() ) {
        global $wp_query;
        if ( ! empty( $wp_query->query ) )
            $atts = array_merge( $wp_query->query, $atts );
    }

    // init wp_query
    $posts = new WP_Query( $atts );
    if ( $posts->have_posts() ) {
        while ( $posts->have_posts() ) {
            $posts->the_post();

            // if has column defined
            if ( $columns ) {
                $counter++;
                $atts['column_class'] = $colclass;
                if ( $counter == 1 ) {
                    if ( $atts['row'] )
                        $output .= '<' . $atts['row_container'] . ' class="' . $atts['row_class'] . '">';
                    $atts['column_class'] = $atts['column_class']. ' alpha';
                    $close = true;
                }
                if ( $counter == $columns ) {
                    $atts['column_class'] = $atts['column_class']. ' omega';
                }

                // get the item using the defined callback function
                if ( $callback )
                    $output .= call_user_func_array( $callback, array( get_the_ID(), $atts ) );

                if ( $counter == $columns ) {
                    $counter = 0;
                    $close = false;
                    if ( $atts['row'] )
                        $output .= '</' . $atts['row_container'] . '>';
                }
            }
            else {
                if ( $callback )
                    $output .= call_user_func_array( $callback, array( get_the_ID(), $atts ) );
            }
        }
        // close last unclosed row
        if ( $close )
            $output .= '</div>';

        wp_reset_query();
        
        // get pagination for query if enabled
        $pagination = '';
        if ( $atts['pagination'] )
            $pagination = wp_pagenavi( array( 'query' => $posts, 'echo' => false ) );

        return array( 'content' => $output, 'pagination' => $pagination );
    }
    // no posts found
    else {
        wp_reset_query();
        return;
    }
}

/** Head and Meta Functions ****************************************************************/

/**
 * Display meta tags in <head> tag
 */
function display_meta_tags() {

    $meta = array();

    $meta['charset'] = '<meta charset="' . get_bloginfo( 'charset' ) . '" />';
    $meta['viewport'] = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>';
    $meta['compatibility'] = '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>';
    $meta['generator'] = '<meta name="generator" content="SpyroPress ' . spyropress_get_version() . '" />';
    $meta['profile'] = '<link rel="profile" href="http://gmpg.org/xfn/11" />';
    $meta['pingback'] = '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />';

    foreach ( $meta as $tag )
        echo "\t" . $tag . "\n";
}

/**
 * Display <title> in <head>
 * Check for SEO Plug-ins if they are handling the matter
 */
function display_meta_title() {

    echo "\t" . '<title>';

    // If 3rd party plugin is in use, let it manage titles as they does great job!
    if (
        class_exists( 'All_in_One_SEO_Pack' ) || 
        class_exists( 'Headspace_Plugin' ) ||
        class_exists( 'WPSEO_Admin' ) || 
        class_exists( 'WPSEO_Frontend' )
    ) {
        wp_title( '', true, 'right' );

    }
    else {

        if ( is_home() || is_front_page() ) {

            echo get_bloginfo( 'name', 'display' );

            $this_desc = esc_attr( get_bloginfo( 'description', 'display' ) );

            if ( $this_desc == 'Just another WordPress site' ) {
                //Silence is golden - site has default description which we dont want to show
            }
            else {
                //Proper site description in options
                echo ' - ';
                echo esc_attr( get_bloginfo( 'description', 'display' ) );
            }
        }

        // If it's a feed, lets add that into the title
        elseif ( is_feed() ) {
            echo get_bloginfo( 'name', 'display' ) . ' feed';
        }

        elseif ( is_search() ) {
            printf( __( 'Search results for  %1$s from %2$s', 'spyropress' ),
                get_search_query(), get_bloginfo( 'name', 'display' ) );
        }

        //DEFAULT FALLBACK
        else {
            wp_title( ' - ', true, 'right' );
            bloginfo( 'name' );
        }
    }

    echo '</title>';
    echo "\n";
}

/**
 * Place Fav and Apple Icon
 */
function spyropress_fav_touch_icons() {

    $output = '';

    if ( $favicon = get_setting( 'custom_favicon' ) )
        $output .= '<link rel="shortcut icon" href="' . $favicon . '"/>' . "\n";
    if ( $apple_small = get_setting( 'apple_small' ) )
        $output .= '<link rel="apple-touch-icon" href="' . $apple_small . '">' . "\n";
    if ( $apple_medium = get_setting( 'apple_medium' ) )
        $output .= '<link rel="apple-touch-icon" sizes="72x72" href="' . $apple_medium . '">' . "\n";
    if ( $apple_large = get_setting( 'apple_large' ) )
        $output .= '<link rel="apple-touch-icon" sizes="114x114" href="' . $apple_large . '">' . "\n";

    if ( $output ) {

        echo '<!--Le fav and touch icons-->' . "\n";

        echo get_relative_url( $output );

        echo '<!--/Le fav and touch icons-->' . "\n";
    }
}

/** Body Functions ****************************************************************/

/**
 * Content Wrapper
 */
function spyropress_page_wrapper() {

    $wrapper = '<!-- wrapper -->' . "\n";
    if ( 'fixed' == get_setting( 'theme_layout' ) )
        $wrapper .= '<div id="wrapper" class="container">';
    else
        $wrapper .= '<div id="wrapper">';

    echo $wrapper . "\n";
}

/**
 * Content Wrapper End
 */
function spyropress_page_wrapper_end() {
    echo '</div>' . "\n" . '<!-- wrapper -->' . "\n";
}

/**
 * Browserhappy and ChromeFrame tugged from HTML5BoilerPlate
 */
function display_browser_happy() {
    echo '<!--[if lt IE 7]>';
    echo '<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>';
    echo '<![endif]-->';
    echo "\n";
}

/**
 * Output Credit in footer
 */
function output_credit() {
    echo '<!-- ' . __( 'Powered by WordPress and the SpyroPress Framework', 'spyropress' ) . ' -->' . "\n";
}

/** Tracking Code
 * Output tracking code in footer i.e. Google Analytics
 */
function output_tracking_code() {
    get_setting_e( 'tracking_code' );
}

function display_slider() {
    
    if( is_front_page() && $slider = get_setting( 'main-slider', false ) )
        echo do_shortcode( '[slider id=' . $slider . ']' );
    
    get_template_part( 'tempaltes/header', 'slider' );
}

function spyropress_wp_nav_menu_objects( $items, $args ) {
    
    if( 'primary' != $args->theme_location ) return $items;
    
    $url = is_front_page() ? '#fwslider' : home_url();
    $class = !is_front_page() ? ' class="external"' : '';
    return '<li><a href="' . $url . '"' . $class . '>Home</a></li>'.$items;
}


/**
 * Comment Callback
 */
function spyropress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'spyropress' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'spyropress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <!-- avatar -->
	<div class="comment-avatar">
		<?php
            $avatar_size = ( '0' != $comment->comment_parent ) ? 60 : 74;
            echo wp_kses( get_avatar( $comment, $avatar_size ), array( 'img' => array( 'src' => array(), 'alt' => array(), 'height' => array(), 'width' => array() ) ) );
        ?>
	</div>

	<!-- comment content -->
	<div class="comment-body">
		
		<!-- author and date -->
		<div class="comment-meta">
			<cite><?php comment_author_link(); ?></cite>
			<?php printf( __( '<span>%1$s at %2$s</span>', 'spyropress' ), get_comment_date(), get_comment_time() ) ?>
		</div>
	
		<?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spyropress' ); ?></em><br />
        <?php
            }
            comment_text();
        ?>
		<?php
            echo str_replace( 'comment-reply-link', 'button reply', get_comment_reply_link( array_merge( $args, array(
                'depth' => $depth,
                'reply_text' => 'reply',
                'max_depth' => $args['max_depth'],
            ) ) ) );
        ?>		
	</div>
	<?php
			break;
	endswitch;
}
?>