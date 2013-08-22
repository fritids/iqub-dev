<?php
/**
 * Theme Options
 *
 * @author 		SpyroSol
 * @category 	Admin
 * @package 	Spyropress
 */

global $spyropress_theme_settings;

$spyropress_theme_settings['textfields'] = array(

	array(
        'label' => 'Text Fields',
        'type' => 'heading',
        'slug' => 'textfields',
    ),
    
    array(  
		'label' => 'Text Option',
        'desc' => 'This is the description field, good for additional info.',
		'id' => 'text',
        'type' => 'text',
        'placeholder' => 'Enter text here'
	),
    
    array(  
		'label' => 'Textarea Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'textarea',
        'type' => 'textarea',
        'placeholder' => 'Enter placeholder here',
        'std' => ''
	),
    
    array(  
		'label' => 'Editor Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'editor',
        'type' => 'editor',
        'std' => '',
        'rows' => 18,
        'settings' => array ( 'media_buttons' => false ) // wp_editor settings arguments
	)
); // End Text Fields

$spyropress_theme_settings['rcfields'] = array(

	array(
        'label' => 'Radio/Checkbox Fields',
        'type' => 'heading',
        'slug' => 'rcfields',
    ),
	
    array(  
		'label' => 'Checkbox Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'checkbox',
        'type' => 'checkbox',
        'options' => array (
            'value1' => 'Opt 1',
        ),
	),
    
    array(
        'label' => 'Multi Checkbox Option',
        'id' => 'multi_checkbox',
        'desc' => 'This is the description field, again good for additional info.',
        'type' => 'checkbox',
        'options' => array (
            'value1' => 'Opt 1',
            'value2' => 'Opt 2',
            'value3' => 'Opt 3'
        ), //Must provide key => value pairs for multi checkbox options
        'std' => array ('value2' => '1') 
	),
    
    array(
		'label' => 'Radio Option',
        'id' => 'radio',
		'type' => 'radio',
		'desc' => 'This is the description field, again good for additional info.',
		'options' => array( 
            '1' => 'Opt 1',
            '2' => 'Opt 2',
            '3' => 'Opt 3'
        ),//Must provide key => value pairs for radio options
		'std' => '2' 
	),
    
	array(
		'label' => 'Radio Image Option',
        'id' => 'radio_img',
		'type' => 'radio_img',
		'desc' => 'This is the description field, again good for additional info.',
		'options' => array(
						'1' => array('title' => 'Opt 1', 'img' => get_panel_img_path( 'align-none.png') ),
						'2' => array('title' => 'Opt 2', 'img' => get_panel_img_path( 'align-left.png') ),
						'3' => array('title' => 'Opt 3', 'img' => get_panel_img_path( 'align-center.png') ),
						'4' => array('title' => 'Opt 4', 'img' => get_panel_img_path( 'align-right.png') )
		),//Must provide key => value(array:title|img) pairs for radio options
		'std' => '2'
	),
    
	array(
		'label' => 'Radio Image Option For Layout', 
        'id' => 'radio_img_2',
		'type' => 'radio_img',
		'desc' => __('This uses some of the built in images, you can use them for layout options.', 'nhp-opts'),
		'options' => array(
						'1' => array('title' => '1 Column', 'img' => get_panel_img_path( 'layouts/1col.png') ),
						'2' => array('title' => '2 Column Left', 'img' => get_panel_img_path( 'layouts/2cl.png') ),
						'3' => array('title' => '2 Column Right', 'img' => get_panel_img_path( 'layouts/2cr.png') )
		),//Must provide key => value(array:title|img) pairs for radio options
		'std' => '2'
	)
    
); // End Radio/Checkbox Fields

//Start Select Box 

$spyropress_theme_settings['slfields'] = array(
    array(
        'label' => 'Select/Multiple Select Fields',
        'type' => 'heading',
        'slug' => 'slfields',
        
    ),
    
	array(
		'id' => 'select_single',
		'type' => 'select',
		'label' => 'Select Option', 
		'desc' => 'This is the description field, again good for additional info.',
		'options' => array(
            '1' => 'Opt 1',
            '2' => 'Opt 2',
            '3' => 'Opt 3',
            '4' => array(
                'name' => 'Group 1',
                'options' => array(
                    'g1' => 'Group Opt 1',
                    'g2' => 'Group Opt 2',
                    'g3' => 'Group Opt 3',
                )
            ),
            '5' => array(
                'name' => 'Group 2',
                'options' => array(
                    'g21' => 'Group Opt 1',
                    'g22' => 'Group Opt 2',
                    'g23' => 'Group Opt 3',
                )
            )
        ),
		'std' => '2'
	),
        
	array(
		'id' => 'select_multiple',
		'type' => 'multi_select',
		'label' => 'Multi Select Option',
		'desc' => 'This is the description field, again good for additional info.',
		'options' => array(
            '1' => 'Opt 1',
            '2' => 'Opt 2',
            '3' => 'Opt 3',
            '4' => array(
                'name' => 'Group 1',
                'options' => array(
                    'g1' => 'Group Opt 1',
                    'g2' => 'Group Opt 2',
                    'g3' => 'Group Opt 3',
                )
            ),
            '5' => array(
                'name' => 'Group 2',
                'options' => array(
                    'g21' => 'Group Opt 1',
                    'g22' => 'Group Opt 2',
                    'g23' => 'Group Opt 3',
                )
            )
        ),
		'std' => array('2','3')
	)									
);//END Select Box 

$spyropress_theme_settings['repeater'] = array(

	array (
        'label' => 'Repeater Fields',
        'type' => 'heading',
        'slug' => 'repeater',
        'selected' => true
    ),
    
    array(  
		'label' => __( 'Social', 'spyropress' ),
		'type' => 'repeater',
        'desc' => 'This is the description field, again good for additional info.',
        'id' => 'social',
        'item_title' => 'icon',
        'fields' => array(
            array(
                'label' => __( 'Sociable Icon', 'spyropress' ),
                'id' => 'icon',
                'type' => 'select',
                'options' => array(
                    'delicious.png' => __( 'Delicious', 'spyropress' ),
                    'deviantart.png' => __( 'Deviantart', 'spyropress' ),
                    'digg.png' => __( 'Digg', 'spyropress' ),
                    'email.png' => __( 'Email', 'spyropress' ),
                    'facebook.png' => __( 'Facebook', 'spyropress' ),
                    'flickr.png' => __( 'Flickr', 'spyropress' ),
                    'gtalk.png' => __( 'Gtalk', 'spyropress' ),
                    'lastfm.png' => __( 'Lastfm', 'spyropress' ),
                    'linkedin.png' => __( 'Linkedin', 'spyropress' ),
                    'myspace.png' => __( 'Myspace', 'spyropress' ),
                    'picasa.png' => __( 'Picasa', 'spyropress' ),
                    'reddit.png' => __( 'Reddit', 'spyropress' ),
                    'rss.png' => __( 'Rss', 'spyropress' ),
                    'skype.png' => __( 'Skype', 'spyropress' ),
                    'stumbleupon.png' => __( 'Stumbleupon', 'spyropress' ),
                    'technorati.png' => __( 'Technorati', 'spyropress' ),
                    'twitter.png' => __( 'Twitter', 'spyropress' ),
                    'tumblr.png' => __( 'Tumblr', 'spyropress' ),
                    'vimeo.png' => __( 'Vimeo', 'spyropress' ),
                    'youtube.png' => __( 'Youtube', 'spyropress' ),
                ),
                'std' => 'delicious.png'
            ),
            
            array(
                'label' => __( 'Custom Icon', 'spyropress' ),
                'id' => 'custom',
                'type' => 'upload',
            ),
            
            array(
                'label' => __( 'Sociable Link', 'spyropress' ),
                'id' => 'link',
                'type' => 'text',
            ),
            
            array(
                'label' => __( 'Alt Text', 'spyropress' ),
                'id' => 'alt',
                'type' => 'text',
            ),
            
            array(
            		'label' => __( 'Caption', 'spyropress' ),
            		'type' => 'repeater',
                    'id' => 'captionist',
                    'item_title' => 'caption',
                    'fields' => array(
                        
                        array(
                            'label' => __( 'Space from Left', 'spyropress' ),
                            'id' => 'left',
                            'type' => 'text',
                        ),
                        
                        array(
                            'label' => __( 'Space from Right', 'spyropress' ),
                            'id' => 'right',
                            'type' => 'text',
                        ),
                    )
            	)
        )
	),

); // end repeator

$spyropress_theme_settings['customfields'] = array(

	array (
        'label' => 'Custom Fields',
        'type' => 'heading',
        'slug' => 'customfields',
    ),
    
    array(  
		'label' => 'Maring/Padding Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'padder',
        'type' => 'padder'
	),
    
    array(  
		'label' => 'Border Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'border',
        'type' => 'border'
	),
    
    array(  
		'label' => 'Typography Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'typography',
        'type' => 'typography'
	),
    
    array(  
		'label' => 'Background Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'background',
        'type' => 'background'
	),
    
    array(  
		'label' => 'Info Section',
        'desc' => 'This is the info of this section, good for other info you want to deliver.',
        'type' => 'info'
	),
    
    array(  
		'label' => 'Sub Heading Section',
        'desc' => 'This is the sub heading additional info area.',
        'type' => 'sub_heading'
	),
    
    array(  
		'label' => 'Text Option',
        'desc' => 'This is the description field, good for additional info.',
		'id' => 'text2',
        'type' => 'text',
        'placeholder' => 'Enter text here',
	),
    
    array(  
		'label' => 'Text Option',
        'desc' => 'This is the description field, good for additional info.',
		'id' => 'text3',
        'type' => 'text',
        'placeholder' => 'Enter text here',
	),
    
    array(  
		'label' => 'Toggle Section',
        'desc' => 'This is the sub heading additional info area.',
        'type' => 'toggle'
	),
    
    array(  
		'label' => 'Text Option',
        'desc' => 'This is the description field, good for additional info.',
		'id' => 'text22',
        'type' => 'text',
        'placeholder' => 'Enter text here',
	),
    
    array(  
		'label' => 'Text Option',
        'desc' => 'This is the description field, good for additional info.',
		'id' => 'text32',
        'type' => 'text',
        'placeholder' => 'Enter text here',
	),
    
    array(  
        'type' => 'toggle_end'
	),
    
    array (
        'id' => 'colorpick',
        'type' => 'colorpicker',
        'label' => 'Color Option',
        'desc' => 'This is the description field, again good for additional info.',
        'std' => '#ffffff'
    ),
    
    array (
        'id' => 'date',
        'type' => 'datepicker',
        'label' => 'Date Option',
        'desc' => 'This is the description field, again good for additional info.',
        'std' => '06/15/2012'
    ),
    
    array(  
		'label' => 'Custom Post Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'custom-post',
        'type' => 'custom_post',
        'post_type' => array( 'page', 'post' )
	),
    
    array(  
		'label' => 'Custom Posts Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'custom-posts',
        'type' => 'custom_posts',
        'post_type' => array( 'page', 'post' )
	),
    
    array(  
		'label' => 'Post Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'post',
        'type' => 'post'
	),
    
    array(  
		'label' => 'Posts Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'posts',
        'type' => 'posts'
	),
    
    array(  
		'label' => 'Page Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'page',
        'type' => 'page'
	),
    
    array(  
		'label' => 'Pages Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'pages',
        'type' => 'pages'
	),
    
    array(  
		'label' => 'Custom Taxonomy Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'custom-taxonomy',
        'type' => 'custom_taxonomy',
        'taxonomy' => 'post_tag'
	),
    
    array(  
		'label' => 'Custom Taxonomies Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'custom-taxonomies',
        'type' => 'custom_taxonomies',
        'taxonomy' => 'post_tag'
	),
    
    array(  
		'label' => 'Category Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'category',
        'type' => 'category'
	),
    
    array(  
		'label' => 'Categories Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'categories',
        'type' => 'categories'
	),
    
    array(  
		'label' => 'Tag Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'tag',
        'type' => 'tag'
	),
    
    array(  
		'label' => 'Tags Type Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'tags',
        'type' => 'tags'
	),
    
    array(  
		'label' => 'Upload Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'upload',
        'type' => 'upload'
	),
    
    array(  
		'label' => 'Range Slider Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'range-slider',
        'type' => 'range_slider',
        'max' => 50,
        'min' => 0,
        'step' => 10
	),
    
    array(  
		'label' => 'Range Slider Option',
        'desc' => 'This is the description field, again good for additional info.',
		'id' => 'range-slider-2',
        'type' => 'range_slider',
        'max' => 150,
        'min' => 10,
        'step' => 10
	),
    
); // End Radio/Checkbox Fields

$spyropress_theme_settings['separator'] = array(

	array ( 'type' => 'separator' )
	
); // END Separator

$spyropress_theme_settings['import'] = array(

	array (
        'label' => 'Import / Export',
        'type' => 'heading',
        'slug' => 'import-export'
    ),
	
    array(
        'type' => 'import'
	),
    
    array(
        'type' => 'export'
	),
); // END Import/Export

$spyropress_theme_settings['support'] = array(

	array (
        'label' => 'Support',
        'type' => 'heading',
        'slug' => 'support'
    ),
    
    array(  
		'id' => 'admin/docs-support.php',
        'type' => 'include'
	)
	
); // END Separator
?>