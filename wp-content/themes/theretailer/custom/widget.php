<?php
/**
 * Product Owner Widget
 *
 * @author 		Igor K
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.6.4
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class WC_Widget_Product_Owner extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
	var $current_author;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function WC_Widget_Product_Owner() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce widget_product_owner';
		$this->woo_widget_description = __( 'A list or dropdown of product owners.', 'woocommerce' );
		$this->woo_widget_idbase = 'woocommerce_product_owner';
		$this->woo_widget_name = __( 'WooCommerce Product Owner', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('product_owner', $this->woo_widget_name, $widget_ops);
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Product Owner', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		$c = $instance['count'] ? '1' : '0';

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		// prepare arguments
		$args  = array(
			'role' => 'product_owner',
			'orderby' => 'display_name',
		);

		$wp_user_query = new WP_User_Query($args);
		$authors = $wp_user_query->get_results();
		// Check for results
		if (!empty($authors)) {
		    echo '<ul class="product-categories">';
		    // loop trough each author
		    foreach ($authors as $author) {
		        $author_info = get_userdata($author->ID);
		        echo '<li><a href="' . iq_get_brand_shop_link($author) . '" >'.$author_info->first_name.' '.$author_info->last_name.'</a></li>';
		    }
		    echo '</ul>';
		}

		echo $after_widget;
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;

		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', 'woocommerce' ); ?></label><br />
<?php
	}

}


/**
 * Brand details Widget
 *
 * @author 		Igor K
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class WC_Widget_Brand_Details extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
	var $current_author;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function WC_Widget_Brand_Details() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce widget_brand_details';
		$this->woo_widget_description = __( 'Brand details box.', 'woocommerce' );
		$this->woo_widget_idbase = 'woocommerce_brand_details';
		$this->woo_widget_name = __( 'WooCommerce Brand Details', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('brand_details', $this->woo_widget_name, $widget_ops);
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );
		global $wp_query;
		$brand = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Brand Details', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		$c = $instance['count'] ? '1' : '0';

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

			echo get_wp_user_avatar($brand->id, 'medium');
			if  ($wp_query->query['post_type'] == 'product') {
				echo '<h3><a href="' . get_author_posts_url($brand->ID) . '" >'.ucwords($brand->first_name).' '.ucwords($brand->last_name).' Profile</a></h3>';
			} else {
				echo '<h3><a href="' . iq_get_brand_shop_link($brand) . '" >'.ucwords($brand->first_name).' '.ucwords($brand->last_name).' Shop</a></h3>';
			}
			echo '<h3><a id="toggle-brand-contact" href="#" >Contact me</a></h3>';

		echo $after_widget;
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

<?php
	}

}