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
function create_post_type() {
  register_taxonomy_for_object_type('category', ' Businesses'); // Register Taxonomies for Category
  register_taxonomy_for_object_type('post_tag', ' Business');
  register_post_type( 'jp_business',
    array(
      'labels' => array(
        'name' => __( 'Businesses' ),
        'singular_name' => __( 'Business' ),
        'edit' => __('Edit', 'Business'),
        'edit_item' => __('Edit Business', 'Business'),
      ),
      'public' => true,
      'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
      'has_archive' => true,
      'menu_icon' => 'dashicons-building',
      'supports' => array(
          'title',
          'editor',
          'excerpt',
          'thumbnail',
          'revisions',
      ), // Go to Dashboard Custom HTML5 Blank post for supports
      'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
          'post_tag',
          'category'
      ) // Add Category and Post Tags support
    )
  );
}
add_action( 'init', 'create_post_type' );
//
// //Add Meta Boxes
// function my_admin(){
//     add_meta_box(
//       'business_meta_box',
//       'Business Details',
//       'display_business_meta_box',
//       'jp_bussiness',
//       'normal',
//       'high'
//     );
// }
