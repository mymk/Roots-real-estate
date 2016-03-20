<?php
/**
 * Roots initial setup and constants.
 */
function roots_setup()
{

  /*
  load_theme_textdomain('roots-immo', get_template_directory() . '/lang');
  */
  // Make theme available for translation
  load_theme_textdomain('roots-immo', get_template_directory().'/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'roots-immo'),
    'footer_navigation'  => __('Footer Navigation', 'roots-immo'),
  ]);

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  add_image_size('new-item', 220, 140, true); // 220px wide 140px height
  add_image_size('single-item', 750, 480, true);
    add_image_size('featured-item', 300, 192, true);

    add_image_size('best-item', 248, 164, true);
  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'roots_setup');
