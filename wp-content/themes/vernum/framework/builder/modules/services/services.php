<?php

/**
 * Module: Sections
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Services extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        
        $this->description = __( 'Service area builder.', 'spyropress' );
        $this->id_base = 'services';
        $this->name = __( 'Services', 'spyropress' );

        // Fields
        $this->fields = array(
            array(
                'label' => __( 'Service', 'spyropress' ),
                'id' => 'services',
                'type' => 'repeater',
                'item_title' => 'bucket',
                'hide_label' => true,
                'fields' => array(
                    
                    array(
                        'label' => __( 'Title', 'spyropress' ),
                        'id' => 'title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => __( 'Description', 'spyropress' ),
                        'id' => 'description',
                        'type' => 'textarea',
                        'rows' => 5
                    ),
                    
                    array(
                        'label' => __( 'Icon', 'spyropress' ),
                        'id' => 'icon',
                        'type' => 'select',
                        'options' => array(
                            'banknote' => 'banknote',
                            'bubble' => 'bubble',
                            'bulb' => 'bulb',
                            'calendar' => 'calendar',
                            'camera' => 'camera',
                            'clip' => 'clip',
                            'clock' => 'clock',
                            'cloud' => 'cloud',
                            'cup' => 'cup',
                            'data' => 'data',
                            'diamond' => 'diamond',
                            'display' => 'display',
                            'eye' => 'eye',
                            'fire' => 'fire',
                            'food' => 'food',
                            'heart' => 'heart',
                            'key' => 'key',
                            'lab' => 'lab',
                            'location' => 'location',
                            'lock' => 'lock',
                            'like' => 'like',
                            'mail' => 'mail',
                            'megaphone' => 'megaphone',
                            'music' => 'music',
                            'news' => 'news',
                            'note' => 'note',
                            'paperplane' => 'paperplane',
                            'params' => 'params',
                            'pen' => 'pen',
                            'phone' => 'phone',
                            'photo' => 'photo',
                            'search' => 'search',
                            'settings' => 'settings',
                            'sound' => 'sound',
                            'shop' => 'shop',
                            'star' => 'star',
                            'study' => 'study',
                            'stack' => 'stack',
                            'tag' => 'tag',
                            'trash' => 'trash',
                            'truck' => 'truck',
                            't-shirt' => 't-shirt',
                            'tv' => 'tv',
                            'user' => 'user',
                            'vallet' => 'vallet',
                            'video' => 'video',
                            'vynil' => 'vynil',
                            'world' => 'world'
                        )
                    ),
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args ); extract( $instance );
        // get view to render
        include $this->get_view();
    }

}
spyropress_builder_register_module( 'Spyropress_Module_Services' );

?>