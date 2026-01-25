<?php
function avid_learner_enqueue_assets() {
  wp_enqueue_style(
    'avid-learner-style',
    get_stylesheet_uri(),
    [],
    wp_get_theme()->get('Version')
  );
}
add_action('wp_enqueue_scripts', 'avid_learner_enqueue_assets');

function avid_learner_setup() {
  add_theme_support('title-tag');

  register_nav_menus([
    'primary' => __('Primary Menu', 'avid-learner'),
  ]);
}
add_action('after_setup_theme', 'avid_learner_setup');
