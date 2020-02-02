<?php

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
 
    function start_lvl(&$output, $depth = 0, $args = array()) {    }
 
    function end_lvl(&$output, $depth = 0, $args = array()) {    }
 
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Here is where we create each option.
        $item_output = '';
 
        // add spacing to the title based on the depth
        $item->title = '<span class="spacing">'.str_repeat(" . ", $depth * 4). '</span>' . $item->title;
 
        // Get the attributes.. Though we likely don't need them for this...
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';
 
        // Add the html
        $item_output .= '<option'. $attributes .'>';
        $item_output .= apply_filters( 'the_title_attribute', $item->title );
 
        // Add this new item to the output string.
        $output .= $item_output;
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        // Close the item.
        $output .= "</option>\n"; 
    }
}

?>