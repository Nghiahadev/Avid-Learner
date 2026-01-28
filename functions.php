<?php
/**
 * Theme functions for Avid Learner
 * Author: Nghia Ha
 */

if (!defined('ABSPATH')) {
  exit;
}

/* ======================================================
   HELPERS
====================================================== */
function al_asset_version($path) {
  // $path should be a FULL server path, like get_template_directory() . '/assets/js/file.js'
  return file_exists($path) ? filemtime($path) : wp_get_theme()->get('Version');
}

/* ======================================================
   ENQUEUE STYLES & SCRIPTS
====================================================== */
function avid_learner_enqueue_assets() {

  // Main Stylesheet (style.css)
  $style_path = get_stylesheet_directory() . '/style.css';
  wp_enqueue_style(
    'avid-learner-style',
    get_stylesheet_uri(),
    [],
    al_asset_version($style_path)
  );

  // Slider JS: /assets/js/slider.js
  $slider_path = get_template_directory() . '/assets/js/slider.js';
  if (file_exists($slider_path)) {
    wp_enqueue_script(
      'avid-learner-slider',
      get_template_directory_uri() . '/assets/js/slider.js',
      [],
      al_asset_version($slider_path),
      true
    );
  }

  // Tabs JS: /assets/js/tabs.js
  $tabs_path = get_template_directory() . '/assets/js/tabs.js';
  if (file_exists($tabs_path)) {
    wp_enqueue_script(
      'avid-learner-tabs',
      get_template_directory_uri() . '/assets/js/tabs.js',
      [],
      al_asset_version($tabs_path),
      true
    );
  }

  // Why Choose Us JS: /assets/js/why-choose-us.js
  $why_path = get_template_directory() . '/assets/js/why-choose-us.js';
  if (file_exists($why_path)) {
    wp_enqueue_script(
      'avid-learner-why-choose-us',
      get_template_directory_uri() . '/assets/js/why-choose-us.js',
      [],
      al_asset_version($why_path),
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'avid_learner_enqueue_assets');


/* ======================================================
   CUSTOMIZER: WHY CHOOSE US
====================================================== */
function al_customize_why_choose_us($wp_customize) {

  $wp_customize->add_section('al_why_choose_us', [
    'title'    => __('Why Choose Us', 'avid-learner'),
    'priority' => 40,
  ]);

  // Badge text
  $wp_customize->add_setting('al_why_badge', [
    'default'           => 'Why Choose Us',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_badge', [
    'label'   => __('Badge Text', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  // Heading
  $wp_customize->add_setting('al_why_heading', [
    'default'           => "We Don't Just Consult — We Transform",
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_heading', [
    'label'   => __('Heading', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  // Highlighted word / phrase (gradient)
  $wp_customize->add_setting('al_why_highlight', [
    'default'           => 'We Transform',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_highlight', [
    'label'   => __('Highlighted Text (Gradient)', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  // Description
  $wp_customize->add_setting('al_why_desc', [
    'default'           => "Our approach combines strategic thinking with hands-on execution. We work alongside your team to implement solutions that deliver measurable, lasting results.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_why_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'textarea',
  ]);

  // Benefits (1 per line)
  $wp_customize->add_setting('al_why_benefits', [
    'default'           => "Data-driven decision making\nProven ROI within 90 days\nDedicated expert teams\nContinuous optimization\nTransparent communication\nIndustry-leading methodologies",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_why_benefits', [
    'label'       => __('Benefits (one per line)', 'avid-learner'),
    'description' => __('Enter one benefit per line.', 'avid-learner'),
    'section'     => 'al_why_choose_us',
    'type'        => 'textarea',
  ]);

  // Stats (4 cards)
  for ($i = 1; $i <= 4; $i++) {
    $default_number = ($i === 1 ? '500' : ($i === 2 ? '98' : ($i === 3 ? '150' : '12')));
    $default_prefix = ($i === 3 ? '$' : '');
    $default_suffix = ($i === 1 ? '+' : ($i === 2 ? '%' : ($i === 3 ? 'M' : '+')));
    $default_label  = ($i === 1 ? 'Projects Delivered' : ($i === 2 ? 'Client Satisfaction' : ($i === 3 ? 'Revenue Generated' : 'Years Experience')));

    $wp_customize->add_setting("al_stat_{$i}_number", [
      'default'           => $default_number,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_number", [
      'label'   => sprintf(__('Stat %d Number', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_prefix", [
      'default'           => $default_prefix,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_prefix", [
      'label'   => sprintf(__('Stat %d Prefix', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_suffix", [
      'default'           => $default_suffix,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_suffix", [
      'label'   => sprintf(__('Stat %d Suffix', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_label", [
      'default'           => $default_label,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_label", [
      'label'   => sprintf(__('Stat %d Label', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);
  }
}
add_action('customize_register', 'al_customize_why_choose_us');


/* ======================================================
   THEME SETUP
====================================================== */
function avid_learner_setup() {

  // Let WordPress handle <title>
  add_theme_support('title-tag');

  // Featured images
  add_theme_support('post-thumbnails');

  // Custom logo support
  add_theme_support('custom-logo', [
    'height'      => 80,
    'width'       => 280,
    'flex-height' => true,
    'flex-width'  => true,
  ]);

  // Register navigation menus
  register_nav_menus([
    'primary' => __('Primary Menu', 'avid-learner'),
  ]);
}
add_action('after_setup_theme', 'avid_learner_setup');
