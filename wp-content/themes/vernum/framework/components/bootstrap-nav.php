<?php

/**
 * class Bootstrap_Walker_Nav_Menu()
 * Extending Walker_Nav_Menu to modify class assigned to submenu ul element
 */
class Bootstrapwp_Walker_Nav_Menu extends Walker_Nav_Menu {

    function __construct() {

    }

    function start_lvl(&$output, $depth) {

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $args = (object)$args;
        
        if (strcasecmp($item->title, 'divider')) {
            
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array )$item->classes;
            //$classes[] = ($item->current) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;
            $class_names = join( ' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args) );

            if ($args->has_children && $depth > 0) {
                $class_names .= ' dropdown-submenu';
            } else if ($args->has_children && $depth === 0) {
                $class_names .= ' dropdown';
            }

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            $attributes .= ( !is_str_contain( 'internal', $class_names ) || !is_front_page() ) ? ' class="external"' : '';
            $attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle  disabled"' : '';

            $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->
                    ID) . $args->link_after;
                
                if( $args->has_children ) {
                    if( $depth == 0 )
                        $item_output .= ' <span class="icon-angle-down"></span>';
                    if( $depth > 0 )
                        $item_output .= ' <span class="icon-angle-right"></span>';
                }
                $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth,
                $args);
        }
        else {
            $output .= $indent . '<li class="divider"></li>';
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        else
            if (is_object($args[0]))
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(
            &$output,
            $element,
            $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

            foreach ($children_elements[$id] as $child) {

                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args,
                    $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(
            &$output,
            $element,
            $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}
?>