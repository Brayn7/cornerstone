<?php 
/*
Plugin Name: missionaires
Description: This is a custom post type for adding missionaries.
Author: Robbie Bryan
Version: 0.1
*/

function missionary_init() {
   register_post_type( 'missionary', array(
      'labels'            => array(
         'name'                => __( 'Missionaries', 'missionaries' ),
         'singular_name'       => __( 'Missionary', 'missionaries' ),
         'all_items'           => __( 'All Missionaries', 'missionaries' ),
         'new_item'            => __( 'New Missionary', 'missionaries' ),
         'add_new'             => __( 'Add New', 'missionaries' ),
         'add_new_item'        => __( 'Add New Missionary', 'missionaries' ),
         'edit_item'           => __( 'Edit Missionary', 'missionaries' ),
         'view_item'           => __( 'View Missionary', 'missionaries' ),
         'search_items'        => __( 'Search Missionaries', 'missionaries' ),
         'not_found'           => __( 'No Missionaries found', 'missionaries' ),
         'not_found_in_trash'  => __( 'No Missionaries found in trash', 'missionaries' ),
         'parent_item_colon'   => __( 'Parent Missionary', 'missionaries' ),
         'menu_name'           => __( 'Missionaries', 'missionaries' ),
      ),
      'public'            => true,
      'hierarchical'      => true,
      'show_ui'           => true,
      'show_in_nav_menus' => true,
      'supports'          => array('title', 'page-attributes'),
      'has_archive'       => true,
      'rewrite'           => true,
      'query_var'         => true,
      'menu_icon'         => 'dashicons-admin-users',
      'show_in_rest'      => true,
      'rest_base'         => 'missionary',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
   ) );
}
add_action( 'init', 'missionary_init' );

function missionary_updated_messages( $messages ) {
   global $post;

   $permalink = get_permalink( $post );

   $messages['missionary'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf( __('Missionary updated. <a target="_blank" href="%s">View Missionary</a>', 'missionaries'), esc_url( $permalink ) ),
      2 => __('Custom field updated.', 'missionaries'),
      3 => __('Custom field deleted.', 'missionaries'),
      4 => __('Missionary updated.', 'missionaries'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf( __('Missionary restored to revision from %s', 'missionaries'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Missionary published. <a href="%s">View Missionary</a>', 'missionaries'), esc_url( $permalink ) ),
      7 => __('Missionary saved.', 'missionaries'),
      8 => sprintf( __('Missionary submitted. <a target="_blank" href="%s">Preview Missionary</a>', 'missionaries'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
      9 => sprintf( __('Missionary scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Missionary</a>', 'missionaries'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
      10 => sprintf( __('Missionary draft updated. <a target="_blank" href="%s">Preview Missionary</a>', 'missionaries'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
   );

   return $messages;
}

function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'missionary' == $screen->post_type ) {
          $title = 'Enter Missionary Name';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'wpb_change_title_text' );

add_filter( 'post_updated_messages', 'missionary_updated_messages' );

add_action( 'after_switch_theme', 'flush_rewrite_rules' );



