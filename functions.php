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
  return file_exists($path) ? filemtime($path) : wp_get_theme()->get('Version');
}

/**
 * Convert "/contact" to full URL, keep full URLs as-is
 */
function al_to_url($maybe_path) {
  $maybe_path = trim((string)$maybe_path);
  if ($maybe_path === '') return '';

  if (preg_match('#^https?://#i', $maybe_path)) {
    return esc_url($maybe_path);
  }

  if ($maybe_path[0] !== '/') {
    $maybe_path = '/' . $maybe_path;
  }

  return esc_url(home_url($maybe_path));
}

/* ======================================================
   THEME SETUP
====================================================== */
function avid_learner_setup() {

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  // make sure pages support featured images
  add_post_type_support('page', 'thumbnail');

  add_theme_support('custom-logo', [
    'height'      => 80,
    'width'       => 280,
    'flex-height' => true,
    'flex-width'  => true,
  ]);

  register_nav_menus([
    'primary' => __('Primary Menu', 'avid-learner'),
  ]);
}
add_action('after_setup_theme', 'avid_learner_setup');

/* ======================================================
   ENQUEUE STYLES & SCRIPTS
====================================================== */
function avid_learner_enqueue_assets() {

  // Main stylesheet
  $style_path = get_stylesheet_directory() . '/style.css';
  wp_enqueue_style(
    'avid-learner-style',
    get_stylesheet_uri(),
    [],
    al_asset_version($style_path)
  );

  // Font Awesome (Footer social + icons)
  wp_enqueue_style(
    'avid-learner-fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
    [],
    '6.5.0'
  );

  // Our Approach CSS
  $approach_css = get_template_directory() . '/assets/css/our-approach.css';
  if (file_exists($approach_css)) {
    wp_enqueue_style(
      'al-our-approach',
      get_template_directory_uri() . '/assets/css/our-approach.css',
      [],
      al_asset_version($approach_css)
    );
  }

  // Slider JS
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

  // Tabs JS
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

  // Why Choose Us JS (counters + reveal)
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

  // What We Do JS (reveal + stagger)
  $wedo_path = get_template_directory() . '/assets/js/what-we-do.js';
  if (file_exists($wedo_path)) {
    wp_enqueue_script(
      'avid-learner-what-we-do',
      get_template_directory_uri() . '/assets/js/what-we-do.js',
      [],
      al_asset_version($wedo_path),
      true
    );
  }

  // Reveal JS (Process)
  $reveal_path = get_template_directory() . '/assets/js/reveal.js';
  if (file_exists($reveal_path)) {
    wp_enqueue_script(
      'avid-learner-reveal',
      get_template_directory_uri() . '/assets/js/reveal.js',
      [],
      al_asset_version($reveal_path),
      true
    );
  }

  // FAQ JS
  $faq_path = get_template_directory() . '/assets/js/faq.js';
  if (file_exists($faq_path)) {
    wp_enqueue_script(
      'al-faq',
      get_template_directory_uri() . '/assets/js/faq.js',
      [],
      al_asset_version($faq_path),
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

  $wp_customize->add_setting('al_why_badge', [
    'default'           => 'Why Choose Us',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_badge', [
    'label'   => __('Badge Text', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_heading', [
    'default'           => "We Don't Just Consult — We Transform",
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_heading', [
    'label'   => __('Heading', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_highlight', [
    'default'           => 'We Transform',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_highlight', [
    'label'   => __('Highlighted Text (Gradient)', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_desc', [
    'default'           => "Our approach combines strategic thinking with hands-on execution. We work alongside your team to implement solutions that deliver measurable, lasting results.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_why_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'textarea',
  ]);

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
   CUSTOMIZER: WHAT WE DO
====================================================== */
function al_customize_what_we_do($wp_customize) {

  $wp_customize->add_section('al_what_we_do', [
    'title'    => __('What We Do', 'avid-learner'),
    'priority' => 42,
  ]);

  $wp_customize->add_setting('al_wedo_badge', [
    'default'           => 'What We Do',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_badge', [
    'label'   => __('Badge Text', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_heading', [
    'default'           => 'Expertise That Drives Results',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_heading', [
    'label'   => __('Heading', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_highlight', [
    'default'           => 'Drives Results',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_highlight', [
    'label'   => __('Highlight Text (Gradient)', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_desc', [
    'default'           => 'We combine deep industry knowledge with innovative methodologies to help businesses overcome challenges and achieve transformational growth.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_wedo_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_wedo_link', [
    'default'           => '/services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_link', [
    'label'       => __('Learn More Link (URL)', 'avid-learner'),
    'description' => __('Example: /services', 'avid-learner'),
    'section'     => 'al_what_we_do',
    'type'        => 'text',
  ]);

  $defaults = [
    ['Strategy Consulting', 'Develop winning strategies that position your business for long-term success and market leadership.'],
    ['Growth Marketing', 'Accelerate revenue growth with data-driven marketing strategies and customer acquisition frameworks.'],
    ['Digital Transformation', 'Modernize your operations with cutting-edge technology solutions and process optimization.'],
    ['Organizational Excellence', 'Build high-performing teams and cultures that drive innovation and sustainable growth.'],
  ];

  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("al_wedo_{$i}_title", [
      'default'           => $defaults[$i - 1][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_wedo_{$i}_title", [
      'label'   => sprintf(__('Card %d Title', 'avid-learner'), $i),
      'section' => 'al_what_we_do',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_wedo_{$i}_desc", [
      'default'           => $defaults[$i - 1][1],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_wedo_{$i}_desc", [
      'label'   => sprintf(__('Card %d Description', 'avid-learner'), $i),
      'section' => 'al_what_we_do',
      'type'    => 'textarea',
    ]);
  }
}
add_action('customize_register', 'al_customize_what_we_do');

/* ======================================================
   CUSTOMIZER: CTA SECTION
====================================================== */
function al_customize_cta_section($wp_customize) {

  $wp_customize->add_section('al_cta_section', [
    'title'    => __('CTA Section', 'avid-learner'),
    'priority' => 45,
  ]);

  $wp_customize->add_setting('al_cta_bg', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  if (class_exists('WP_Customize_Image_Control')) {
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_cta_bg', [
      'label'   => __('CTA Background Image', 'avid-learner'),
      'section' => 'al_cta_section',
    ]));
  }

  $wp_customize->add_setting('al_cta_kicker', [
    'default'           => 'Invest in Yourself',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_kicker', [
    'label'   => __('Small Heading', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_title', [
    'default'           => 'Create the Life You Want, Get Personalized Coaching Today!',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_title', [
    'label'   => __('Main Heading', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_desc', [
    'default'           => 'Elevate your life with personalized coaching tailored to your unique needs. Start your journey to self-discovery and growth today by booking a session with our experienced life coach.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_cta_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_cta_btn_text', [
    'default'           => 'CONTACT US',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_btn_text', [
    'label'   => __('Button Text', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_btn_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_btn_url', [
    'label'       => __('Button Link (URL)', 'avid-learner'),
    'description' => __('Example: /contact or https://yoursite.com/contact', 'avid-learner'),
    'section'     => 'al_cta_section',
    'type'        => 'text',
  ]);
}
add_action('customize_register', 'al_customize_cta_section');

/* ======================================================
   CUSTOMIZER: FOOTER
====================================================== */
function al_customize_footer($wp_customize) {

  $wp_customize->add_section('al_footer', [
    'title'    => __('Footer', 'avid-learner'),
    'priority' => 60,
  ]);

  $fields = [
    'al_footer_title'   => ['Newsletter Title', 'Join our newsletter for event important announcement', 'text'],
    'al_footer_note'    => ['Newsletter Note', 'Stay informed with instant updates delivered straight to your inbox.', 'text'],
    'al_footer_brand'   => ['Brand Name (fallback)', 'Avid Learner', 'text'],
    'al_footer_about'   => ['About Text', 'Experience a world-class conference designed to inspire innovation, empower professionals, and connect leaders from around the globe.', 'textarea'],
    'al_footer_phone'   => ['Phone', '+00 123 456 789', 'text'],
    'al_footer_email'   => ['Email', 'support@domainname.com', 'text'],
    'al_footer_address' => ['Address', '45/2 Central Business Innovation Near International Trade Tower', 'textarea'],

    'al_social_facebook'  => ['Facebook URL', '#', 'text'],
    'al_social_twitter'   => ['X/Twitter URL', '#', 'text'],
    'al_social_instagram' => ['Instagram URL', '#', 'text'],
    'al_social_linkedin'  => ['LinkedIn URL', '#', 'text'],
  ];

  foreach ($fields as $key => $data) {
    [$label, $default, $type] = $data;

    $wp_customize->add_setting($key, [
      'default'           => $default,
      'sanitize_callback' => ($type === 'textarea') ? 'sanitize_textarea_field' : 'sanitize_text_field',
    ]);

    $wp_customize->add_control($key, [
      'label'   => __($label, 'avid-learner'),
      'section' => 'al_footer',
      'type'    => $type,
    ]);
  }
}
add_action('customize_register', 'al_customize_footer');

/* ======================================================
   CUSTOMIZER: NOTICE BAR (Ticker)
====================================================== */
add_action('customize_register', function ($wp_customize) {

  $wp_customize->add_section('al_notice_bar', [
    'title'       => __('Notice Bar', 'avid-learner'),
    'priority'    => 35,
    'description' => __('Edit the scrolling notice/ticker items. Enter one item per line.', 'avid-learner'),
  ]);

  // Toggle on/off
  $wp_customize->add_setting('al_notice_enabled', [
    'default'           => true,
    'sanitize_callback' => function ($val) {
      return (bool) $val;
    },
  ]);
  $wp_customize->add_control('al_notice_enabled', [
    'label'   => __('Enable Notice Bar', 'avid-learner'),
    'section' => 'al_notice_bar',
    'type'    => 'checkbox',
  ]);

  // Items (one per line)
  $wp_customize->add_setting('al_notice_items', [
    'default'           => "Latest Updates\nNew Announcements\nWorkshop Alerts\nLive Notices\nEvent Countdown\nCommunity News",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_notice_items', [
    'label'       => __('Notice Items', 'avid-learner'),
    'description' => __('Enter one item per line.', 'avid-learner'),
    'section'     => 'al_notice_bar',
    'type'        => 'textarea',
  ]);

});

/* ======================================================
   CUSTOMIZER: OUR APPROACH
====================================================== */
add_action('customize_register', function ($wp_customize) {

  $wp_customize->add_section('al_our_approach', [
    'title'       => __('Our Approach', 'avid-learner'),
    'priority'    => 44,
    'description' => __('Edit the Our Approach section (heading, button, and cards).', 'avid-learner'),
  ]);

  // Heading small label (h3)
  $wp_customize->add_setting('al_approach_kicker', [
    'default'           => 'our approach',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_approach_kicker', [
    'label'   => __('Kicker (small heading)', 'avid-learner'),
    'section' => 'al_our_approach',
    'type'    => 'text',
  ]);

  // Main heading
  $wp_customize->add_setting('al_approach_title', [
    'default'           => 'Customized strategies for',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_approach_title', [
    'label'   => __('Main heading (first part)', 'avid-learner'),
    'section' => 'al_our_approach',
    'type'    => 'text',
  ]);

  // Highlighted word in <span>
  $wp_customize->add_setting('al_approach_highlight', [
    'default'           => 'learning success',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_approach_highlight', [
    'label'   => __('Highlighted text (span)', 'avid-learner'),
    'section' => 'al_our_approach',
    'type'    => 'text',
  ]);

  // Button text
  $wp_customize->add_setting('al_approach_btn_text', [
    'default'           => 'Contact now',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_approach_btn_text', [
    'label'   => __('Button text', 'avid-learner'),
    'section' => 'al_our_approach',
    'type'    => 'text',
  ]);

  // Button link (path or full URL)
  $wp_customize->add_setting('al_approach_btn_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_approach_btn_url', [
    'label'       => __('Button URL', 'avid-learner'),
    'description' => __('Example: /contact or https://yoursite.com/contact', 'avid-learner'),
    'section'     => 'al_our_approach',
    'type'        => 'text',
  ]);

  // Cards (3)
  $defaults = [
    [
      'title' => 'our mission',
      'text'  => 'Empowering learners with practical paths to grow skills and build real projects.',
    ],
    [
      'title' => 'our vision',
      'text'  => 'A community where learning is clear, consistent, and connected to real outcomes.',
    ],
    [
      'title' => 'our value',
      'text'  => 'Simplicity, momentum, and support—so you can learn smarter and ship faster.',
    ],
  ];

  for ($i = 1; $i <= 3; $i++) {
    // Card title
    $wp_customize->add_setting("al_approach_{$i}_title", [
      'default'           => $defaults[$i - 1]['title'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_approach_{$i}_title", [
      'label'   => sprintf(__('Card %d title', 'avid-learner'), $i),
      'section' => 'al_our_approach',
      'type'    => 'text',
    ]);

    // Card text
    $wp_customize->add_setting("al_approach_{$i}_text", [
      'default'           => $defaults[$i - 1]['text'],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_approach_{$i}_text", [
      'label'   => sprintf(__('Card %d description', 'avid-learner'), $i),
      'section' => 'al_our_approach',
      'type'    => 'textarea',
    ]);

    // Card icon (image picker)
    $wp_customize->add_setting("al_approach_{$i}_icon", [
      'default'           => '',
      'sanitize_callback' => 'absint', // attachment ID
    ]);
    if (class_exists('WP_Customize_Media_Control')) {
      $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        "al_approach_{$i}_icon",
        [
          'section'   => 'al_our_approach',
          'label'     => sprintf(__('Card %d icon', 'avid-learner'), $i),
          'mime_type' => 'image',
        ]
      ));
    }

    // Card image (image picker)
    $wp_customize->add_setting("al_approach_{$i}_image", [
      'default'           => '',
      'sanitize_callback' => 'absint', // attachment ID
    ]);
    if (class_exists('WP_Customize_Media_Control')) {
      $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        "al_approach_{$i}_image",
        [
          'section'   => 'al_our_approach',
          'label'     => sprintf(__('Card %d image', 'avid-learner'), $i),
          'mime_type' => 'image',
        ]
      ));
    }
  }
});

/* ======================================================
   CUSTOMIZER: FAQ SECTION (Editable FAQs + Images)
====================================================== */
add_action('customize_register', function ($wp_customize) {

  $wp_customize->add_section('al_faq_section', [
    'title'       => __('FAQ Section', 'avid-learner'),
    'priority'    => 46,
    'description' => __('Edit the FAQ content and images used in the FAQ block.', 'avid-learner'),
  ]);

  // Title
  $wp_customize->add_setting('al_faq_title', [
    'default'           => 'Frequently Asked Questions',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_faq_title', [
    'section' => 'al_faq_section',
    'label'   => __('FAQ Title', 'avid-learner'),
    'type'    => 'text',
  ]);

  // Subtitle
  $wp_customize->add_setting('al_faq_subtitle', [
    'default'           => 'Quick answers about Avid Learner—what it is, who it’s for, and how to stay updated.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_faq_subtitle', [
    'section' => 'al_faq_section',
    'label'   => __('FAQ Subtitle', 'avid-learner'),
    'type'    => 'textarea',
  ]);

  // FAQ Items (4)
  for ($i = 1; $i <= 4; $i++) {

    $wp_customize->add_setting("al_faq_q_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_faq_q_{$i}", [
      'section' => 'al_faq_section',
      'label'   => sprintf(__('Question %d', 'avid-learner'), $i),
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_faq_a_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_faq_a_{$i}", [
      'section' => 'al_faq_section',
      'label'   => sprintf(__('Answer %d', 'avid-learner'), $i),
      'type'    => 'textarea',
    ]);
  }

  // Images (4) via media picker
  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("al_faq_img_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'absint', // attachment ID
    ]);

    if (class_exists('WP_Customize_Media_Control')) {
      $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        "al_faq_img_{$i}",
        [
          'section'   => 'al_faq_section',
          'label'     => sprintf(__('FAQ Image %d', 'avid-learner'), $i),
          'mime_type' => 'image',
        ]
      ));
    }
  }
});

/**
 * =========================================================
 * Stacking Cards (5) - Customizer Settings
 * =========================================================
 */
add_action('customize_register', function ($wp_customize) {

  // Section
  $wp_customize->add_section('al_stack_cards', [
    'title'       => __('Stacking Cards Section', 'avid-learner'),
    'priority'    => 45,
    'description' => __('Edit the sticky stacking cards section (5 cards).', 'avid-learner'),
  ]);

  // Eyebrow
  $wp_customize->add_setting('al_stack_eyebrow', [
    'default'           => 'Services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_eyebrow', [
    'label'   => __('Eyebrow (small title)', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  // Main Title
  $wp_customize->add_setting('al_stack_title', [
    'default'           => 'Development programs built for leaders and teams',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_title', [
    'label'   => __('Main Title', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  // Subtitle
  $wp_customize->add_setting('al_stack_subtitle', [
    'default'           => 'Scroll to explore five ways we help strengthen leadership, alignment, and performance—without adding complexity.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_stack_subtitle', [
    'label'   => __('Subtitle', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'textarea',
  ]);

  // Button text + links (optional)
  $wp_customize->add_setting('al_stack_btn1_text', [
    'default'           => 'Book a consult',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_btn1_text', [
    'label'   => __('Primary Button Text', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_btn1_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_stack_btn1_url', [
    'label'       => __('Primary Button URL (relative or full URL)', 'avid-learner'),
    'section'     => 'al_stack_cards',
    'type'        => 'text',
    'description' => __('Example: /contact', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_stack_btn2_text', [
    'default'           => 'View services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_btn2_text', [
    'label'   => __('Secondary Button Text', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_btn2_url', [
    'default'           => '/services',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_stack_btn2_url', [
    'label'       => __('Secondary Button URL (relative or full URL)', 'avid-learner'),
    'section'     => 'al_stack_cards',
    'type'        => 'text',
    'description' => __('Example: /services', 'avid-learner'),
  ]);

  /**
   * 5 Cards Defaults
   */
  $defaults = [
    1 => [
      'label' => '01. SERVICE',
      'title' => 'Talent Development',
      'text'  => 'Build essential capabilities with practical learning paths, real-world application, and measurable skill growth.',
    ],
    2 => [
      'label' => '02. SERVICE',
      'title' => 'Team Coaching & Development',
      'text'  => 'Improve trust, alignment, and collaboration through facilitated coaching sessions that strengthen team performance.',
    ],
    3 => [
      'label' => '03. SERVICE',
      'title' => 'Executive Coaching & Development',
      'text'  => 'One-on-one coaching for leaders to sharpen decision-making, communication, presence, and strategic execution.',
    ],
    4 => [
      'label' => '04. SERVICE',
      'title' => 'Leadership Development & Facilitation',
      'text'  => 'Workshops and facilitation that elevate leadership habits, clarity, and accountability across the organization.',
    ],
    5 => [
      'label' => '05. SERVICE',
      'title' => 'Culture & Change Management',
      'text'  => 'Guide change with structure and empathy—aligning people, processes, and communication so adoption actually sticks.',
    ],
  ];

  // Card fields (1..5)
  for ($i = 1; $i <= 5; $i++) {

    $wp_customize->add_setting("al_stack_card{$i}_label", [
      'default'           => $defaults[$i]['label'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_label", [
      'label'   => sprintf(__('Card %d - Label (e.g. 01. SERVICE)', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_title", [
      'default'           => $defaults[$i]['title'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_title", [
      'label'   => sprintf(__('Card %d - Heading', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_text", [
      'default'           => $defaults[$i]['text'],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_text", [
      'label'   => sprintf(__('Card %d - Description', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'textarea',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_image", [
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      "al_stack_card{$i}_image",
      [
        'label'   => sprintf(__('Card %d - Image', 'avid-learner'), $i),
        'section' => 'al_stack_cards',
      ]
    ));
  }
});

/**
 * =========================================================
 * Enqueue style.css + Inline JS for stacking effect
 * (No extra asset files required)
 * =========================================================
 */
add_action('wp_enqueue_scripts', function () {

  // If your theme already enqueues style.css, you can remove this line.
  wp_enqueue_style('al-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));

  $js = <<<JS
(() => {
  const cards = document.querySelectorAll('.al-stack-card');
  if (!cards.length) return;

  const onScroll = () => {
    const viewportHeight = window.innerHeight;
    const isMobile = window.innerWidth <= 768;
    const stickyTopOffset = isMobile ? viewportHeight * 0.10 : viewportHeight * 0.15;

    cards.forEach((card, index) => {
      const nextCard = cards[index + 1];
      if (!nextCard) return;

      const nextRect = nextCard.getBoundingClientRect();
      const distance = nextRect.top - stickyTopOffset;

      if (distance < viewportHeight && distance > 0) {
        // Desktop shrinks a bit more; mobile shrinks less for readability
        const maxShrink = isMobile ? 0.965 : 0.92;
        const factor = (1 - maxShrink) / viewportHeight;

        const scale = 1 - ((viewportHeight - distance) * factor);
        const finalScale = Math.max(maxShrink, Math.min(1, scale));

        // Keep brightness high since we are on a white theme
        const brightness = Math.max(0.86, Math.min(1, scale));

        card.style.transform = `scale(\${finalScale})`;
        card.style.filter = `brightness(\${brightness})`;
      } else if (distance <= 0) {
        const maxShrink = isMobile ? 0.965 : 0.92;
        card.style.transform = `scale(\${maxShrink})`;
        card.style.filter = 'brightness(0.86)';
      } else {
        card.style.transform = 'scale(1)';
        card.style.filter = 'brightness(1)';
      }
    });
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();
})();
JS;

  // Attach inline JS to a registered handle
  wp_register_script('al-stack-inline', '', [], null, true);
  wp_enqueue_script('al-stack-inline');
  wp_add_inline_script('al-stack-inline', $js);
});


/*CF7 */
add_action('customize_register', function ($wp_customize) {

  $wp_customize->add_section('al_contact_page', [
    'title'    => __('Contact Page', 'avid-learner'),
    'priority' => 46,
    'description' => __('Customize the Contact page content and Contact Form 7 shortcode.', 'avid-learner'),
  ]);

  // HERO
  $wp_customize->add_setting('al_contact_badge', [
    'default' => 'Get in Touch',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_badge', [
    'label' => __('Hero Badge', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_title', [
    'default' => "Let's Start a Conversation",
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_title', [
    'label' => __('Hero Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_subtitle', [
    'default' => "Ready to transform your business? We'd love to hear from you. Fill out the form below or book a consultation directly.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_contact_subtitle', [
    'label' => __('Hero Subtitle', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'textarea',
  ]);

  // FORM TITLE
  $wp_customize->add_setting('al_contact_form_title', [
    'default' => 'Send us a message',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_form_title', [
    'label' => __('Form Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  // CF7 SHORTCODE
  $wp_customize->add_setting('al_contact_cf7_shortcode', [
    'default' => '[contact-form-7 id="123" title="Contact Form"]',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_contact_cf7_shortcode', [
    'label' => __('Contact Form 7 Shortcode', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
    'description' => __('Paste CF7 shortcode. Example: [contact-form-7 id="123" title="Contact Form"]', 'avid-learner'),
  ]);

  // RIGHT CARD
  $wp_customize->add_setting('al_contact_call_title', [
    'default' => 'Prefer to talk directly?',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_call_title', [
    'label' => __('Call Card Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_call_text', [
    'default' => 'Book a free 30-minute consultation with one of our experts.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_contact_call_text', [
    'label' => __('Call Card Text', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'textarea',
  ]);

  $wp_customize->add_setting('al_contact_call_btn', [
    'default' => 'Schedule a Call',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_call_btn', [
    'label' => __('Call Button Text', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_call_url', [
    'default' => '/book',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_call_url', [
    'label' => __('Call Button URL (relative or full)', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
    'description' => __('Example: /book or https://calendly.com/yourname/30min', 'avid-learner'),
  ]);

  // CONTACT INFO
  $wp_customize->add_setting('al_contact_email', [
    'default' => 'hello@apexconsult.com',
    'sanitize_callback' => 'sanitize_email',
  ]);
  $wp_customize->add_control('al_contact_email', [
    'label' => __('Contact Email', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_phone', [
    'default' => '+1 (234) 567-890',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_phone', [
    'label' => __('Contact Phone', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_address1', [
    'default' => '123 Business Ave, Suite 500',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_address1', [
    'label' => __('Address Line 1', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_address2', [
    'default' => 'New York, NY 10001',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_address2', [
    'label' => __('Address Line 2', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  // SOCIAL LINKS
  $wp_customize->add_setting('al_contact_social_linkedin', [
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_linkedin', [
    'label' => __('LinkedIn URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_social_twitter', [
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_twitter', [
    'label' => __('Twitter/X URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_contact_social_facebook', [
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_facebook', [
    'label' => __('Facebook URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type' => 'text',
  ]);
});


/* ======================================================
   About Us Section
====================================================== */
add_action('wp_enqueue_scripts', function () {
  // Font Awesome
  wp_enqueue_style(
    'font-awesome-6',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
    [],
    '6.5.1'
  );

  // Counter animation (simple, lightweight)
  $js = <<<JS
(() => {
  const els = document.querySelectorAll('[data-counter]');
  if (!els.length) return;

  const animate = (el) => {
    const end = parseInt(el.getAttribute('data-end') || '0', 10);
    const suffix = el.getAttribute('data-suffix') || '';
    const dur = parseInt(el.getAttribute('data-duration') || '1200', 10);
    const start = 0;
    const t0 = performance.now();

    const tick = (t) => {
      const p = Math.min(1, (t - t0) / dur);
      const val = Math.floor(start + (end - start) * (p * (2 - p)));
      el.textContent = val.toLocaleString() + suffix;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting && !e.target.dataset.did) {
        e.target.dataset.did = '1';
        animate(e.target);
      }
    });
  }, { threshold: 0.35 });

  els.forEach(el => io.observe(el));
})();
JS;

  wp_register_script('al-counters', '', [], null, true);
  wp_enqueue_script('al-counters');
  wp_add_inline_script('al-counters', $js);
});


/* ======================================================
   Services grid
====================================================== */
add_action('customize_register', function ($wp_customize) {

  $wp_customize->add_section('al_services_grid', [
    'title'       => __('Services Grid', 'avid-learner'),
    'priority'    => 48,
    'description' => __('Edit the Services Grid section content and Font Awesome icons.', 'avid-learner'),
  ]);

  // Section heading
  $wp_customize->add_setting('al_svc_kicker', [
    'default'           => 'Our Services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_svc_kicker', [
    'label'   => __('Kicker (pill text)', 'avid-learner'),
    'section' => 'al_services_grid',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_svc_title', [
    'default'           => 'Strategic Solutions for Every Challenge',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_svc_title', [
    'label'   => __('Title', 'avid-learner'),
    'section' => 'al_services_grid',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_svc_title_highlight', [
    'default'           => 'Every Challenge',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_svc_title_highlight', [
    'label'       => __('Title Highlight (gradient words)', 'avid-learner'),
    'section'     => 'al_services_grid',
    'type'        => 'text',
    'description' => __('This will be highlighted in gradient in the title.', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_svc_subtitle', [
    'default'           => 'From strategy to execution, we provide comprehensive consulting services that drive measurable business outcomes.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_svc_subtitle', [
    'label'   => __('Subtitle', 'avid-learner'),
    'section' => 'al_services_grid',
    'type'    => 'textarea',
  ]);

  // Defaults for 6 services
  $defaults = [
    1 => [
      'icon' => 'fa-regular fa-lightbulb',
      'title' => 'Strategy Consulting',
      'desc'  => 'Develop comprehensive business strategies that align with your vision and drive sustainable growth.',
      'url'   => '/services/strategy-consulting',
      'features' => ['Market Analysis','Competitive Strategy','Business Planning','M&A Advisory'],
    ],
    2 => [
      'icon' => 'fa-solid fa-arrow-trend-up',
      'title' => 'Growth Marketing',
      'desc'  => 'Accelerate customer acquisition and revenue growth with data-driven marketing strategies.',
      'url'   => '/services/growth-marketing',
      'features' => ['Go-to-Market Strategy','Brand Positioning','Digital Marketing','Performance Analytics'],
    ],
    3 => [
      'icon' => 'fa-solid fa-chart-column',
      'title' => 'Digital Transformation',
      'desc'  => 'Modernize your operations with cutting-edge technology and process optimization.',
      'url'   => '/services/digital-transformation',
      'features' => ['Technology Roadmap','Process Automation','Cloud Migration','Data Analytics'],
    ],
    4 => [
      'icon' => 'fa-solid fa-people-group',
      'title' => 'Organizational Development',
      'desc'  => 'Build high-performing teams and cultures that drive innovation and excellence.',
      'url'   => '/services/organizational-development',
      'features' => ['Leadership Development','Change Management','Team Building','Culture Design'],
    ],
    5 => [
      'icon' => 'fa-solid fa-rocket',
      'title' => 'Innovation Advisory',
      'desc'  => 'Stay ahead of the curve with innovation strategies and emerging technology insights.',
      'url'   => '/services/innovation-advisory',
      'features' => ['Innovation Labs','R&D Strategy','Product Development','Startup Partnerships'],
    ],
    6 => [
      'icon' => 'fa-solid fa-shield-halved',
      'title' => 'Risk & Compliance',
      'desc'  => 'Navigate complex regulatory landscapes and build resilient business operations.',
      'url'   => '/services/risk-compliance',
      'features' => ['Risk Assessment','Compliance Frameworks','Crisis Management','Business Continuity'],
    ],
  ];

  // 6 service blocks
  for ($i = 1; $i <= 6; $i++) {

    $wp_customize->add_setting("al_svc_{$i}_icon", [
      'default'           => $defaults[$i]['icon'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_svc_{$i}_icon", [
      'label'       => sprintf(__('Service %d - Font Awesome icon class', 'avid-learner'), $i),
      'section'     => 'al_services_grid',
      'type'        => 'text',
      'description' => __('Example: fa-solid fa-rocket', 'avid-learner'),
    ]);

    $wp_customize->add_setting("al_svc_{$i}_title", [
      'default'           => $defaults[$i]['title'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_svc_{$i}_title", [
      'label'   => sprintf(__('Service %d - Title', 'avid-learner'), $i),
      'section' => 'al_services_grid',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_svc_{$i}_desc", [
      'default'           => $defaults[$i]['desc'],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_svc_{$i}_desc", [
      'label'   => sprintf(__('Service %d - Description', 'avid-learner'), $i),
      'section' => 'al_services_grid',
      'type'    => 'textarea',
    ]);

    $wp_customize->add_setting("al_svc_{$i}_url", [
      'default'           => $defaults[$i]['url'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_svc_{$i}_url", [
      'label'       => sprintf(__('Service %d - Learn More URL', 'avid-learner'), $i),
      'section'     => 'al_services_grid',
      'type'        => 'text',
      'description' => __('Example: /services/strategy-consulting', 'avid-learner'),
    ]);

    // 4 features
    for ($f = 1; $f <= 4; $f++) {
      $wp_customize->add_setting("al_svc_{$i}_feature_{$f}", [
        'default'           => $defaults[$i]['features'][$f-1] ?? '',
        'sanitize_callback' => 'sanitize_text_field',
      ]);
      $wp_customize->add_control("al_svc_{$i}_feature_{$f}", [
        'label'   => sprintf(__('Service %d - Feature %d', 'avid-learner'), $i, $f),
        'section' => 'al_services_grid',
        'type'    => 'text',
      ]);
    }
  }
});

add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_about_carousel', [
    'title' => __('About Carousel', 'avid-learner'),
    'priority' => 55,
    'description' => __('Upload images and set titles for the About page drag carousel.', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_carousel_kicker', [
    'default' => 'Our Story Gallery',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_carousel_kicker', [
    'label' => __('Kicker (pill text)', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_about_carousel_title', [
    'default' => 'Moments that shaped our journey',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_carousel_title', [
    'label' => __('Section Title', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type' => 'text',
  ]);

  $wp_customize->add_setting('al_about_carousel_subtitle', [
    'default' => 'Drag, scroll, or swipe to explore highlights from our work, culture, and milestones.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_about_carousel_subtitle', [
    'label' => __('Section Subtitle', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type' => 'textarea',
  ]);

  // ✅ number of slides (no $items needed)
  $slide_count = 7;

  for ($i = 1; $i <= $slide_count; $i++) {

    $wp_customize->add_setting("al_about_carousel_{$i}_title", [
      'default' => "Slide {$i}",
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_carousel_{$i}_title", [
      'label' => sprintf(__('Slide %d Title', 'avid-learner'), $i),
      'section' => 'al_about_carousel',
      'type' => 'text',
    ]);

    $wp_customize->add_setting("al_about_carousel_{$i}_image", [
      'default' => 0,
      'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(
      new WP_Customize_Media_Control(
        $wp_customize,
        "al_about_carousel_{$i}_image",
        [
          'label' => sprintf(__('Slide %d Image', 'avid-learner'), $i),
          'section' => 'al_about_carousel',
          'mime_type' => 'image',
        ]
      )
    );
  }
});
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'al-about-carousel',
    get_template_directory_uri() . '/assets/js/about-carousel.js',
    [],
    '1.0.0',
    true
  );
});


add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'al-timeline-reveal',
    get_template_directory_uri() . '/assets/js/timeline-reveal.js',
    [],
    '1.0.0',
    true
  );
});


/**
 * Logo Marquee (Customizer)
 * - Admin can paste one logo per line (image URL)
 * - Optional link:  image_url|https://link.com
 */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_logo_marquee', [
    'title'    => __('Logo Marquee', 'avid-learner'),
    'priority' => 45,
  ]);

  $wp_customize->add_setting('al_logo_marquee_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);

  $wp_customize->add_control('al_logo_marquee_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_logo_marquee',
    'label'   => __('Enable logo marquee', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_logo_marquee_logos', [
    'default'           => "",
    'sanitize_callback' => 'wp_kses_post',
  ]);

  $wp_customize->add_control('al_logo_marquee_logos', [
    'type'        => 'textarea',
    'section'     => 'al_logo_marquee',
    'label'       => __('Logos (one per line)', 'avid-learner'),
    'description' => __("Paste one logo image URL per line.\nOptional link format: image_url|https://example.com", 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_logo_marquee_speed', [
    'default'           => 28,
    'sanitize_callback' => function($v){
      $v = intval($v);
      if ($v < 10) $v = 10;
      if ($v > 120) $v = 120;
      return $v;
    },
  ]);

  $wp_customize->add_control('al_logo_marquee_speed', [
    'type'        => 'number',
    'section'     => 'al_logo_marquee',
    'label'       => __('Animation speed (seconds)', 'avid-learner'),
    'input_attrs' => ['min' => 10, 'max' => 120, 'step' => 1],
  ]);

});


/**
 * About Us Section - Customizer Settings (Consulting version)
 */
add_action('customize_register', function($wp_customize){

  // Section
  $wp_customize->add_section('al_about_us', [
    'title'    => __('About Us', 'avid-learner'),
    'priority' => 35,
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_about_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_about_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_about_us',
    'label'   => __('Enable About Us section', 'avid-learner'),
  ]);

  // Images
  $wp_customize->add_setting('al_about_img_1', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_img_1', [
    'label'   => __('About Image 1', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_img_2', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_img_2', [
    'label'   => __('About Image 2', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_circle_img', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_circle_img', [
    'label'       => __('Circle Image (SVG)', 'avid-learner'),
    'description' => __('Rotating circle image shown between photos.', 'avid-learner'),
    'section'     => 'al_about_us',
  ]));

  // Text content
  $wp_customize->add_setting('al_about_kicker', [
    'default'           => 'ABOUT US',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_kicker', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Small heading (kicker)', 'avid-learner'),
  ]);

  // Allow <span> for accent color on part of title
  $wp_customize->add_setting('al_about_title', [
    'default'           => 'Trusted guidance for <span>business growth</span>',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_title', [
    'type'        => 'textarea',
    'section'     => 'al_about_us',
    'label'       => __('Main heading (HTML allowed: <span>)', 'avid-learner'),
    'description' => __('Example: Trusted guidance for <span>business growth</span>', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_desc', [
    'default'           => 'We partner with teams to clarify strategy, strengthen execution, and deliver measurable results. Our approach blends structured analysis, practical insight, and hands-on support tailored to your goals.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_desc', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Description', 'avid-learner'),
  ]);

  // Service mini box (Consulting)
  $wp_customize->add_setting('al_about_service_title', [
    'default'           => 'Strategic Advisory',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_service_title', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Service box title', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_service_desc', [
    'default'           => 'Clear, data-informed guidance to improve decision-making, optimize operations, and support long-term growth.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_service_desc', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Service box description', 'avid-learner'),
  ]);

  // Font Awesome icon class (instead of image icon)
  $wp_customize->add_setting('al_about_service_fa', [
    'default'           => 'fa-solid fa-briefcase',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_service_fa', [
    'type'        => 'text',
    'section'     => 'al_about_us',
    'label'       => __('Service icon (Font Awesome classes)', 'avid-learner'),
    'description' => __('Example: fa-solid fa-briefcase  |  fa-solid fa-chart-line  |  fa-solid fa-layer-group', 'avid-learner'),
  ]);

  // Author card
  $wp_customize->add_setting('al_about_author_photo', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_author_photo', [
    'label'   => __('Author photo', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_author_name', [
    'default'           => 'Kimberly',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_author_name', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Author name', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_author_title', [
    'default'           => 'Co. Founder',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_author_title', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Author title', 'avid-learner'),
  ]);

  // Checklist (one per line)
  $wp_customize->add_setting('al_about_checks', [
    'default'           => "Strategy & Roadmaps\nClear Communication\nOngoing Support",
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_checks', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Checklist items (one per line)', 'avid-learner'),
  ]);

});