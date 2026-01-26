<?php
/**
 * Theme functions for Avid Learner
 */

function avid_learner_enqueue_assets() {
  // Main stylesheet (style.css)
  wp_enqueue_style(
    'avid-learner-style',
    get_stylesheet_uri(),
    [],
    wp_get_theme()->get('Version')
  );

  // Slider JS (make sure this file exists)
  // wp-content/themes/avid-learner/assets/js/slider.js
  wp_enqueue_script(
    'avid-learner-slider',
    get_template_directory_uri() . '/assets/js/slider.js',
    [],
    wp_get_theme()->get('Version'),
    true
  );
}
add_action('wp_enqueue_scripts', 'avid_learner_enqueue_assets');

function avid_learner_setup() {
  // Let WordPress control the <title> tag
  add_theme_support('title-tag');

  // (Optional but recommended) Support Featured Images
  add_theme_support('post-thumbnails');

  // (Optional but recommended) Support custom logo in WP Customizer
  add_theme_support('custom-logo', [
    'height'      => 80,
    'width'       => 280,
    'flex-height' => true,
    'flex-width'  => true,
  ]);

  // Register menu locations
  register_nav_menus([
    'primary' => __('Primary Menu', 'avid-learner'),
  ]);
}
add_action('after_setup_theme', 'avid_learner_setup');
