<?php

/*********************************************/
/**************** INCLUDES *******************/
/*********************************************/
include_once('widget.php'); // Load Widgets

function iq_register_widgets() {
    if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
            'name' => __( 'Brand Sidebar', 'theretailer' ),
            'id' => 'widgets_brand_details',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }
    register_widget( 'WC_Widget_Product_Owner' );
    register_widget( 'WC_Widget_Brand_Details' );
}
add_action( 'widgets_init', 'iq_register_widgets');

function iq_products_for_current_po($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow && 'upload.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'manage_options' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );

        add_filter('views_edit-product', 'iq_fix_post_counts');
        add_filter('views_upload', 'iq_fix_media_counts');
	}
	return $query;
}
add_filter('pre_get_posts', 'iq_products_for_current_po');

// Fix product counts
function iq_fix_post_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'product',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(__('<a href="%s"'. $class .'>All <span class="count">(%d)</span></a>', 'all'),
                admin_url('edit.php?post_type=product'),
                $result->found_posts);
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(__('<a href="%s"'. $class .'>Published <span class="count">(%d)</span></a>', 'publish'),
                admin_url('edit.php?post_status=publish&post_type=product'),
                $result->found_posts);
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(__('<a href="%s"'. $class .'>Draft'. ((sizeof($result->posts) > 1) ? "s" : "") .' <span class="count">(%d)</span></a>', 'draft'),
                admin_url('edit.php?post_status=draft&post_type=product'),
                $result->found_posts);
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(__('<a href="%s"'. $class .'>Pending <span class="count">(%d)</span></a>', 'pending'),
                admin_url('edit.php?post_status=pending&post_type=product'),
                $result->found_posts);
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(__('<a href="%s"'. $class .'>Trash <span class="count">(%d)</span></a>', 'trash'),
                admin_url('edit.php?post_status=trash&post_type=product'),
                $result->found_posts);
        endif;
    }
    return $views;
}


// Fix media counts
function iq_fix_media_counts($views) {
    global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
    $views = array();
    $count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
    foreach( $count as $row )
        $_num_posts[$row['post_mime_type']] = $row['num_posts'];
    $_total_posts = array_sum($_num_posts);
    $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
    if ( !isset( $total_orphans ) )
        $total_orphans = $wpdb->get_var("
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment' 
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        ");
    $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
    foreach ( $matches as $type => $reals )
        foreach ( $reals as $real )
            $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
    $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
    $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
    foreach ( $post_mime_types as $mime_type => $label ) {
        $class = '';
        if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
            continue;
        if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
            $class = ' class="current"';
        if ( !empty( $num_posts[$mime_type] ) )
            $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
    }
    $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
    return $views;
}

function iq_allow_author_editing() {
  add_post_type_support( 'product', 'author' );
}
add_action('init','iq_allow_author_editing');

function iq_change_author_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'brand';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base. '/%author%';

    add_rewrite_rule(
        'shop/([^/]+)/?',
        'index.php?brand=$matches[1]',
        'top'
    );
}
add_action('init','iq_change_author_permalinks');


add_filter( 'query_vars', 'iq_query_vars' );
function iq_query_vars( $query_vars ) {
    $query_vars[] = 'brand';
    return $query_vars;
}

function iq_template_redirect(){
    global $wp_query;
    if($wp_query->get('brand')):
        include( get_template_directory() ."/woocommerce/archive-product.php" );
        exit();
    endif;
}
add_filter( 'template_redirect', 'iq_template_redirect' );

function iq_get_brand_shop_link($brand) {
    if (is_numeric($brand)) {
        $brand = get_userdata($brand);
    }

    return '/shop/' . $brand->nickname;
}

function iq_disable_zopim_chat() {
    remove_action('get_footer', 'zopimme');
}

function debug_me($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}