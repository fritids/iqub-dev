<?php

/**
 * PhotoStream Widget
 * Showing your photostream from Dribbble, Flickr, Pinterest, Instagram in the sidebar.
 *     
 * @package		SpyroPress
 * @category	Widgets
 * @author		SpyroSol
 */

class SpyroPress_Widget_PhotoStream extends SpyropressWidget {

    /**
     * Constructor
     */
    function __construct() {

        // Widget variable settings.
        $this->cssclass = 'photostream';
        $this->description = __( 'Display photostream from Dribbble, Flickr, Pinterest, Instagram.', 'spyropress' );
        $this->id_base = 'spyropress_photostream';
        $this->name = __( 'Spyropress: PhotoStream', 'spyropress' );

        $this->fields = array(

            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
                'std' => 'Your Photostream' ),

            array(
                'label' => __( 'Number of Pics', 'spyropress' ),
                'id' => 'limit',
                'type' => 'range_slider',
                'std' => '9' ),

            array( 'type' => 'row' ),

            array( 'type' => 'col', 'size' => 6 ),
            array(
                'label' => __( 'Social Network', 'spyropress' ),
                'id' => 'social_network',
                'type' => 'select',
                'options' => array(
                    'dribbble' => __( 'Dribbble', 'spyropress' ),
                    'pinterest' => __( 'Pinterest', 'spyropress' ),
                    'flickr' => __( 'Flickr', 'spyropress' ),
                    'instagram' => __( 'Instagram', 'spyropress' ) ),
                'std' => 'instagram' ),
            array( 'type' => 'col_end' ),

            array( 'type' => 'col', 'size' => 6 ),
            array(
                'label' => __( 'PhotoStream User', 'spyropress' ),
                'id' => 'user',
                'type' => 'text',
                'std' => 'spyropress',
                ),
            array( 'type' => 'col_end' ),

            array( 'type' => 'row_end' ) );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        $default = array(
            'social_network' => 'instagram',
            'user' => 'spyropress',
            'limit' => '9',
        );
        $instance = spyropress_clean_array( wp_parse_args( $instance, $default ) );

        // extracting info
        extract( $args ); extract( $instance );

        // get view to render
        include $this->get_view();
    }

    function update( $new, $old ) {

        // delete cache
        delete_site_transient( '_spyropress_dribble_stream' );
        delete_site_transient( '_spyropress_flickr_stream' );
        delete_site_transient( '_spyropress_instagram_stream' );
        delete_site_transient( '_spyropress_pinterest_stream' );

        return parent::update( $new, $old );
    }

    function get_dribble_stream( $user = '', $limit = 9 ) {

        // Cache key
        $key = '_spyropress_dribble_stream';

        // Return from Cache
        if ( $output = get_site_transient( $key ) ) return $output;

        // Get stream
        $url = 'http://dribbble.com/' . $user . '/shots.json';
        $response = wp_remote_get( $url );
        if ( is_wp_error( $response ) ) return false;
        
        // decode json
        $shots = json_decode( wp_remote_retrieve_body( $response ) )->shots;
        $output = array();
        $count = 0;
        foreach ( $shots as $shot ) {
            if ( $count < $limit ) {
                $output[] = array(
                    'title' => str_replace( "`", "'", $shot->title ),
                    'url' => $shot->url,
                    'image' => $shot->image_teaser_url,
                    'width' => $shot->width,
                    'height' => $shot->height );
                $count++;
            }
            else {
                break;
            }
        }

        // Save into Cache
        if ( ! empty( $output ) ) set_site_transient( $key, $output, spyropress_get_seconds( 1 ) );

        return $output;
    }

    function get_flickr_stream( $user = '', $limit = 9 ) {

        // Cache key
        $key = '_spyropress_flickr_stream';

        // Return from Cache
        if ( $output = get_site_transient( $key ) ) return $output;

        // Get user id
        $url = 'http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username=' .
            $user . '&format=json&api_key=85145f20ba1864d8ff559a3971a0a033';
        $response = wp_remote_get( $url );
        if ( is_wp_error( $response ) )return false;
        
        $nsid = str_replace( 'jsonFlickrApi(', '', wp_remote_retrieve_body( $response ) );
        $nsid = str_replace( ')', '', $nsid );
        $nsid = json_decode( $nsid )->user->nsid;

        // Get Stream
        $url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=' .
            $nsid . '&format=json&api_key=85145f20ba1864d8ff559a3971a0a033&per_page=' . $limit .
            '&page=1&extras=url_sq&jsoncallback=?';
        $response = wp_remote_get( $url );
        if ( is_wp_error( $response ) ) return false;

        // decode json
        $shots = str_replace( 'jsonFlickrApi(', '', wp_remote_retrieve_body( $response ) );
        $shots = str_replace( ')', '', $shots );
        $shots = json_decode( $shots )->photos->photo;
        $output = array();
        $count = 0;
        foreach ( $shots as $shot ) {
            if ( $count < $limit ) {
                $output[] = array(
                    'title' => str_replace( "`", "'", $shot->title ),
                    'url' => sprintf( 'http://www.flickr.com/photos/%s/%s', $shot->owner, $shot->id ),
                    'image' => $shot->url_sq,
                    'width' => $shot->width,
                    'height' => $shot->height_sq );
                $count++;
            }
            else {
                break;
            }
        }

        // Save into Cache
        if ( ! empty( $output ) ) set_site_transient( $key, $output, spyropress_get_seconds( 0.25 ) );

        return $output;
    }

    function get_instagram_stream( $user = '', $limit = 9 ) {

        // Cache key
        $key = '_spyropress_instagram_stream';

        // Return from Cache
        if ( $output = get_site_transient( $key ) ) return $output;

        // Get usersearch
        $token = '188312888.f79f8a6.1b920e7f642b4693a4cb346162bf7154';
        $url = 'https://api.instagram.com/v1/users/search?q=' . $user . '&access_token=' .
            $token . '&count=10&callback=?';
        $response = wp_remote_get( $url );
        if ( is_wp_error( $response ) ) return false;
        
        // decode json
        $users = json_decode( wp_remote_retrieve_body( $response ) )->data;

        $output = array();
        $count = 0;
        // Loop through users
        foreach ( $users as $u ) {
            if ( $user == $u->username ) {
                // Get Shots
                $user_id = $u->id;
                $url = 'https://api.instagram.com/v1/users/' . $user_id .
                    '/media/recent/?access_token=' . $token . '&count=' . $limit . '&callback=?';
                $response = wp_remote_get( $url );
                if ( is_wp_error( $response ) ) return false;
                // decode json
                $shots = json_decode( wp_remote_retrieve_body( $response ) )->data;
                foreach ( $shots as $shot ) {
                    if ( $count < $limit ) {
                        $output[] = array(
                            'title' => ( $shot->caption ) ? str_replace( "`", "'", $shot->caption->text ) :
                                '',
                            'url' => $shot->link,
                            'image' => $shot->images->thumbnail->url,
                            'width' => $shot->images->width,
                            'height' => $shot->images->height );
                        $count++;
                    }
                    else {
                        break;
                    }
                }
            }
        }

        // Save into Cache
        if ( ! empty( $output ) ) set_site_transient( $key, $output, spyropress_get_seconds( 0.25 ) );

        return $output;
    }

    function get_pinterest_stream( $user = '', $limit = 9 ) {

        // Cache key
        $key = '_spyropress_pinterest_stream';

        // Return from Cache
        if ( $output = get_site_transient( $key ) ) return $output;

        // Get stream
        $url = 'http://pinterest.com/' . $user . '/feed.rss';
        $response = wp_remote_get( $url );
        if ( is_wp_error( $response ) ) return false;
        
        // decode json from xml
        $shots = json_decode( json_encode( ( array )simplexml_load_string( wp_remote_retrieve_body ( $response ) ) ), 1 );
        $shots = $shots['channel']['item'];

        $output = array();
        $count = 0;
        foreach ( $shots as $shot ) {
            $shot = ( object )$shot;
            if ( $count < $limit ) {
                $img = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $shot->
                    description, $matches );
                if ( ! empty( $matches[1][0] ) ) {
                    $img = $matches[1][0];
                    $output[] = array(
                        'title' => str_replace( "`", "'", $shot->title ),
                        'url' => $shot->link,
                        'image' => $img,
                        'width' => false,
                        'height' => false );
                    $count++;
                }
            }
            else {
                break;
            }
        }

        // Save into Cache
        if ( ! empty( $output ) ) set_site_transient( $key, $output, spyropress_get_seconds( 0.25 ) );

        return $output;
    }
} // class SpyroPress_Widget_PhotoStream

register_widget( 'SpyroPress_Widget_PhotoStream' );

?>