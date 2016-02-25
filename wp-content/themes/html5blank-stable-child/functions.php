<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:


if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css' );

if ( !function_exists( 'chld_thm_cfg_child_css' ) ):
    function chld_thm_cfg_child_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', get_stylesheet_uri() );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_child_css', 999 );

// END ENQUEUE PARENT ACTION


//calling jp_custom_post function
add_action('init', 'jp_custom_post');

//if jp_custom_post exist then initiate funciton
if(jp_custom_post){
  //function to create custom post type
  function jp_custom_post(){
    register_post_type('jp_bussiness',
    );
    array(
      'labels' => array(
        'name' => __( 'Businesses' ),
        'singular_name' => __( 'Business' ),
        'edit' => __('Edit', 'Business'),
        'edit_item' => __('Edit Business', 'Business'),
      ),
      'public' => true,
      'hierarchical' => false,
      'has_archive' => true,
      'menu_icon' => 'dashicons-building',
      'supports' => array(
          'title',
          'editor',
          'excerpt',
          'thumbnail',
          'revisions',
      ),
      'can_export' => true,
      'taxonomies' => array(
          'post_tag',
          'category'
      ) // Add Category and Post Tags support
  }
}

//Add Meta Boxes
function my_admin(){
    add_meta_box(
      'business_meta_box',
      'Business Details',
      'display_business_meta_box',
      'jp_bussiness',
      'normal',
      'high'
    );
}
