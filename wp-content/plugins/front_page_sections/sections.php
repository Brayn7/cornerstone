<?php 
/*
Plugin Name: sections
Description: This is a custom post type for adding sections to the front page.
Author: Robbie Bryan
Version: 0.1
*/

function section_init() {
   register_post_type( 'section', array(
      'labels'            => array(
         'name'                => __( 'Sections', 'sections' ),
         'singular_name'       => __( 'Section', 'sections' ),
         'all_items'           => __( 'All Sections', 'sections' ),
         'new_item'            => __( 'New Section', 'sections' ),
         'add_new'             => __( 'Add New', 'sections' ),
         'add_new_item'        => __( 'Add New Section', 'sections' ),
         'edit_item'           => __( 'Edit Section', 'sections' ),
         'view_item'           => __( 'View Section', 'sections' ),
         'search_items'        => __( 'Search Sections', 'sections' ),
         'not_found'           => __( 'No Sections found', 'sections' ),
         'not_found_in_trash'  => __( 'No Sections found in trash', 'sections' ),
         'parent_item_colon'   => __( 'Parent Section', 'sections' ),
         'menu_name'           => __( 'Sections', 'sections' ),
      ),
      'public'            => true,
      'hierarchical'      => true,
      'show_ui'           => true,
      'show_in_nav_menus' => true,
      'supports'          => array('title', 'page-attributes', 'excerpt', 'editor'),
      'has_archive'       => true,
      'rewrite'           => true,
      'query_var'         => true,
      'menu_icon'         => 'dashicons-admin-users',
      'show_in_rest'      => true,
      'rest_base'         => 'section',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
   ) );
}
add_action( 'init', 'section_init' );

function section_updated_messages( $messages ) {
   global $post;

   $permalink = get_permalink( $post );

   $messages['section'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf( __('Section updated. <a target="_blank" href="%s">View Section</a>', 'sections'), esc_url( $permalink ) ),
      2 => __('Custom field updated.', 'sections'),
      3 => __('Custom field deleted.', 'sections'),
      4 => __('Section updated.', 'sections'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf( __('Section restored to revision from %s', 'sections'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Section published. <a href="%s">View Section</a>', 'sections'), esc_url( $permalink ) ),
      7 => __('Section saved.', 'sections'),
      8 => sprintf( __('Section submitted. <a target="_blank" href="%s">Preview Section</a>', 'sections'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
      9 => sprintf( __('Section scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Section</a>', 'sections'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
      10 => sprintf( __('Section draft updated. <a target="_blank" href="%s">Preview Section</a>', 'sections'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
   );

   return $messages;
}

// function wpb_change_title_text( $title ){
//      $screen = get_current_screen();
  
//      if  ( 'section' == $screen->post_type ) {
//           $title = 'Enter Section Name';
//      }
  
//      return $title;
// }
  
add_filter( 'enter_title_here', 'wpb_change_title_text' );

add_filter( 'post_updated_messages', 'section_updated_messages' );

add_action( 'after_switch_theme', 'flush_rewrite_rules' );



