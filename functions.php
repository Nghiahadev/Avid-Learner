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
