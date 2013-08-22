<?php
/**
 * Theme Options
 *
 * @author 		SpyroSol
 * @category 	Admin
 * @package 	Spyropress
 */

global $spyropress_theme_settings;

$spyropress_theme_settings['general'] = array(

	array(
        'label' => __( 'General Settings', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'generalsettings',
        'icon' => 'module-icon-general'
    ),

    array(
    	'label' => 'Logo Setting',
    	'type' => 'sub_heading'
    ),

    array(
		'label' => __( 'Custom Logo', 'spyropress' ),
        'desc' => __( 'Upload a logo for your site or specify an image URL directly.', 'spyropress' ),
		'id' => 'logo',
        'type' => 'upload'
	),

    array(
		'label' => __( 'Custom Logo@2x', 'spyropress' ),
        'desc' => __( 'Upload a logo for retina display.', 'spyropress' ),
		'id' => 'logo-2x',
        'type' => 'upload'
	),

    array(
    	'label' => 'Logo Width',
    	'id' => 'logo_width',
    	'type' => 'range_slider',
        'max' => 400,
        'prop' => 'width'
    ),

    array(
    	'label' => 'Logo Height',
    	'id' => 'logo_height',
    	'type' => 'range_slider',
        'max' => 400,
        'prop' => 'height'
    ),

    array(
    	'label' => 'Fav and Apple Icons',
    	'type' => 'sub_heading'
    ),

    array(
		'label' => __( 'Custom Favicon', 'spyropress' ),
        'desc' => __( 'Upload a favicon for your site or specify an icon URL directly.<br/>Accepted formats: ico, png, gif<br/>Dimension: 16px x 16px.', 'spyropress' ),
		'id' => 'custom_favicon',
        'type' => 'upload'
	),

    array(
		'label' => __( 'Apple Touch Icon (small)', 'spyropress' ),
        'desc' => __( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 57px x 57px.', 'spyropress' ),
		'id' => 'apple_small',
        'type' => 'upload'
	),

    array(
		'label' => __( 'Apple Touch Icon (medium)', 'spyropress' ),
        'desc' => __( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 72px x 72px.', 'spyropress' ),
		'id' => 'apple_medium',
        'type' => 'upload'
	),

    array(
		'label' => __( 'Apple Touch Icon (large)', 'spyropress' ),
        'desc' => __( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 114px x 114px.', 'spyropress' ),
		'id' => 'apple_large',
        'type' => 'upload'
	),

    array(
        'label' => __( 'Header Customization', 'spyropress' ),
        'type' => 'sub_heading',
    ),

    array(
		'label' => __( 'Main Slider', 'spyropress' ),
		'id' => 'main-slider',
        'type' => 'select',
        'options' => spyropress_get_sliders()
	)

); // End General Settings

$spyropress_theme_settings['footer'] = array(

    array(
        'label' => __( 'Footer Customization', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'footer',
        'icon' => 'module-icon-footer'
    ),

    array(
		'label' => __( 'Footer Text', 'spyropress' ),
        'desc' => __( 'Custom HTML and Text that will appear in the footer of your theme.', 'spyropress' ),
		'id' => 'footer_text',
        'type' => 'editor'
	),

    array(
		'label' => __( 'Social', 'spyropress' ),
		'type' => 'repeater',
        'id' => 'socials',
        'item_title' => 'icon',
        'fields' => array(
            array(
                'label' => __( 'Network', 'spyropress' ),
                'id' => 'network',
                'type' => 'select',
                'options' => array(
                    'facebook' => __( 'Facebook', 'spyropress' ),
                    'github' => __( 'GitHub', 'spyropress' ),
                    'google-plus' => __( 'Google+', 'spyropress' ),
                    'linkedin' => __( 'Linkedin', 'spyropress' ),
                    'pinterest' => __( 'Pinterest', 'spyropress' ),
                    'twitter' => __( 'Twitter', 'spyropress' )
                )
            ),

            array(
                'label' => __( 'Link', 'spyropress' ),
                'id' => 'link',
                'type' => 'text',
            )
        )
	)

); // END FOOTER

$spyropress_theme_settings['post'] = array(

    array(
        'label' => __( 'Post Options', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'post',
        'icon' => 'module-icon-post'
    ),

    array(
        'label' => __( 'Blog Heading', 'spyropress' ),
        'id' => 'blog_heading',
        'type' => 'text',
        'std' => 'Blog'
    ),

    array(
        'label' => __( 'Blog Description', 'spyropress' ),
        'id' => 'blog_description',
        'type' => 'text',
        'std' => 'Now, however preposterous it may at first seem to talk of any creature\'s skin.'
    ),

    array(
		'label'    => __( 'Listing Settings', 'spyropress' ),
		'type'    => 'sub_heading'
	),

    array(
		'label' => __( 'Post Content', 'spyropress' ),
        'desc' => __( 'Select full content or the excerpt while showing posts.', 'spyropress' ),
        'id' => 'post_content',
		'type' => 'select',
		'options' => array(
            'content' => __( 'Full Content', 'spyropress' ),
            'excerpt' => __( 'The Excerpt', 'spyropress' )
        ),
		'std' => 'excerpt'
	),

    array(
		'label' => __( 'Excerpt Settings', 'spyropress' ),
		'type' => 'toggle'
	),

    array(
        'label' => __( 'Length by', 'spyropress' ),
        'id' => 'excerpt_by',
        'type' => 'select',
        'options' => array (
            '' => '',
            'words' => __( 'Words', 'spyropress' ),
            'chars' => __( 'Character', 'spyropress' ),
        ),
        'std' => 'words'
	),

    array(
		'label' => __( 'Length', 'spyropress' ),
        'desc' => __( 'Set the length of excerpt.', 'spyropress' ),
		'id' => 'excerpt_length',
        'type' => 'text',
        'std' => 44
	),

    array(
		'label' => __( 'Ellipsis', 'spyropress' ),
        'desc' => __( 'This is the description field, again good for additional info.', 'spyropress' ),
		'id' => 'excerpt_ellipsis',
        'type' => 'text',
        'std' => '&hellip;'
	),

    array(
		'label' => __( 'Before Text', 'spyropress' ),
        'desc' => __( 'This is the description field, again good for additional info.', 'spyropress' ),
		'id' => 'excerpt_before_text',
        'type' => 'text',
        'std' => '<p>'
	),

    array(
		'label' => __( 'After Text', 'spyropress' ),
        'desc' => __( 'This is the description field, again good for additional info.', 'spyropress' ),
		'id' => 'excerpt_after_text',
        'type' => 'text',
        'std' => '</p>'
	),

    array(
		'label' => __( 'Read More', 'spyropress' ),
		'id' => 'excerpt_link_to_post',
        'type' => 'checkbox',
        'options' => array(
            '1' => __( 'Enable or disable Read more link.', 'spyropress' )
        ),
        'std' => '1'
	),

    array(
		'label' => __( 'Link Text', 'spyropress' ),
        'desc' => __( 'A text for Read More button.', 'spyropress' ),
		'id' => 'excerpt_link_text',
        'type' => 'text',
        'std' => __( 'Read More', 'spyropress' )
	),

    array(
		'type' => 'toggle_end'
	),

    array(
		'label' => __( 'Author Box', 'spyropress' ),
		'type' => 'toggle'
	),

    array(
		'label' => __( 'Enable', 'spyropress' ),
		'id' => 'meta_authorbox',
        'type' => 'checkbox',
        'options' => array(
            'box' => __( 'Display author box.', 'spyropress' )
        )
	),

    array(
		'label' => __( 'Author Title Prefix', 'spyropress' ),
        'desc' => __( 'Write the title.', 'spyropress' ),
		'id' => 'authorbox_title',
        'type' => 'text',
        'std' => __( 'About', 'spyropress' )
	),

    array(
		'type' => 'toggle_end'
	)
    
); // End Blog Settings
$spyropress_theme_settings['seo'] = array(

	array(
        'label' => __( 'SEO Options', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'seo',
        'icon' => 'module-icon-seo'
    ),

    array(
		'label' => __( 'Tracking Code', 'spyropress' ),
        'desc' => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','spyropress' ),
		'id' => 'tracking_code',
        'type' => 'textarea'
	)

); //END SEO

$spyropress_theme_settings['plugins'] = array(

	array(
        'label' => __( 'Settings', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'plugins',
        'icon' => 'module-icon-general'
    ),

    array(
		'label' => __( 'Email Settings', 'spyropress' ),
		'type' => 'sub_heading'
	),

    array(
		'label' => __( 'Sender Name', 'spyropress' ),
        'desc' => __( 'For example sender name is "WordPress".', 'spyropress' ),
		'id' => 'mail_from_name',
        'type' => 'text'
	),

    array(
		'label' => __( 'Sender Email Address', 'spyropress' ),
        'desc' => __( 'For example sender email address is wordpress@yoursite.com.', 'spyropress' ),
		'id' => 'mail_from_email',
        'type' => 'text'
	),

    array(
		'label' => __( 'Twitter Settings', 'spyropress' ),
		'type' => 'toggle'
	),

    array(
        'label' => __( 'Screen name', 'spyropress' ),
        'id' => 'twitter_username',
        'type' => 'text'
    ),

    array(
		'label' => __( 'Create an Application', 'spyropress' ),
        'desc' => '<a href="https://dev.twitter.com/apps" target="_blank">Create an Application on Twitter</a>, once your application is created Twitter will generate your Oauth key and access tokens. Paste them below.',
		'type' => 'info'
	),

    array(
        'label' => __( 'Consumer Key', 'spyropress' ),
        'id' => 'consumer_key',
        'type' => 'text'
    ),

    array(
        'label' => __( 'Consumer Secret', 'spyropress' ),
        'id' => 'consumer_secret',
        'type' => 'text'
    ),

    array(
        'label' => __( 'Access Token', 'spyropress' ),
        'id' => 'access_token',
        'type' => 'text'
    ),

    array(
        'label' => __( 'Access Token Secret', 'spyropress' ),
        'id' => 'access_token_secret',
        'type' => 'text'
    ),

    array(
		'type' => 'toggle_end'
	),

    array(
		'label' => __( 'WP-Pagenavi', 'spyropress' ),
		'type' => 'toggle'
	),

    array(
		'label' => __( 'Text For Current Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'current_text',
        'desc' => '%PAGE_NUMBER% - '.__( 'The page number.', 'spyropress' ),
        'std' => '%PAGE_NUMBER%'
	),

    array(
		'label' => __( 'Text For Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'page_text',
        'desc' => '%PAGE_NUMBER% - ' .__( 'The page number.', 'spyropress' ),
        'std' => '%PAGE_NUMBER%'
	),

    array(
		'label' => __( 'Text For First Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'first_text',
        'desc' => '%TOTAL_PAGES% - ' .__( 'The total number of pages.', 'spyropress' ),
        'std' => __( '&laquo; First', 'spyropress' )
	),

    array(
		'label' => __( 'Text For Last Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'last_text',
        'desc' => '%TOTAL_PAGES% - ' .__( 'The total number of pages.', 'spyropress' ),
        'std' => __( 'Last &raquo;', 'spyropress' )
	),

    array(
		'label' => __( 'Text For Previous Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'prev_text',
        'std' => __( '&laquo;', 'spyropress' )
	),

    array(
		'label' => __( 'Text For Next Page', 'spyropress' ),
		'type' => 'text',
        'id' => 'next_text',
        'std' => __( '&raquo;', 'spyropress' )
	),

    array(
		'label' => __( 'Text For Previous &hellip;', 'spyropress' ),
		'type' => 'text',
        'id' => 'dotleft_text',
        'std' => __( '&hellip;', 'spyropress' )
	),

    array(
		'label' => __( 'Text For Next &hellip;', 'spyropress' ),
		'type' => 'text',
        'id' => 'dotright_text',
        'std' => __( '&hellip;', 'spyropress' )
    ),

    array(
        'label' => __( 'Page Navigation Text', 'spyropress' ),
        'id' => 'wp-page-pager',
        'type' => 'sub_heading',
        'desc' => __( 'Leaving a field blank will hide that part of the navigation.', 'spyropress' ),
    ),

    array(
		'label' => __( 'Always Show Page Navigation', 'spyropress' ),
		'type' => 'checkbox',
        'id' => 'always_show',
        'label' => __( 'Show navigation even if there\'s only one page.', 'spyropress' ),
        'std' => false
    ),

    array(
		'label' => __( 'Number Of Pages To Show', 'spyropress' ),
		'type' => 'text',
        'id' => 'num_pages',
        'std' => 5
    ),

    array(
		'label' => __( 'Number Of Larger Page Numbers To Show', 'spyropress' ),
		'type' => 'text',
        'id' => 'num_larger_page_numbers',
        'desc' => __( 'Larger page numbers are in addition to the normal page numbers. They are useful when there are many pages of posts.', 'spyropress' ),
        'std' => 3
    ),

    array(
		'label' => __( 'Show Larger Page Numbers In Multiples Of', 'spyropress' ),
		'type' => 'text',
        'id' => 'larger_page_numbers_multiple',
        'desc' => __( 'For example, if mutiple is 5, it will show: 5, 10, 15, 20, 25', 'spyropress' ),
        'std' => 10
    ),

    array(
		'type' => 'toggle_end'
	),

); // END CONNECT

$spyropress_theme_settings['separator'] = array(

	array ( 'type' => 'separator' )

); // END Separator

$spyropress_theme_settings['import'] = array(

	array (
        'label' => __( 'Import / Export', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'import-export',
        'icon' => 'module-icon-import'
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
        'label' => __( 'Support', 'spyropress' ),
        'type' => 'heading',
        'slug' => 'support',
        'icon' => 'module-icon-support'
    ),

    array(
		'id' => 'admin/docs-support.php',
        'type' => 'include'
	)

); // END Separator
?>