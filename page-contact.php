<?php
/**
 * Contact Page (Hero + CF7 Layout + Elementor Area + CTA)
 * Slug: contact (or template assignment)
 */

get_header();

/**
 * Customizer values (optional)
 * If you haven't added the Customizer settings yet, these will just use defaults.
 */
$form_title = get_theme_mod('al_contact_form_title', 'Send us a message');
$form_sc = '[contact-form-7 id="7883fd9" title="Contact form 1"]';

$call_t  = get_theme_mod('al_contact_call_title', 'Prefer to talk directly?');
$call_p  = get_theme_mod('al_contact_call_text', 'Book a free 30-minute consultation with one of our experts.');
$call_bt = get_theme_mod('al_contact_call_btn', 'Schedule a Call');
$call_u  = get_theme_mod('al_contact_call_url', '/book');

$email   = get_theme_mod('al_contact_email', 'hello@apexconsult.com');
$phone   = get_theme_mod('al_contact_phone', '+1 (234) 567-890');
$addr1   = get_theme_mod('al_contact_address1', 'Philadelphia, PA, US');
$addr2   = get_theme_mod('al_contact_address2', ' ');

$linkedin = get_theme_mod('al_contact_social_linkedin', '#');
$twitter  = get_theme_mod('al_contact_social_twitter', '#');
$facebook = get_theme_mod('al_contact_social_facebook', '#');

// allow relative URLs like /book
$call_href = (strpos($call_u, 'http') === 0) ? $call_u : home_url($call_u);

// handy: detect if shortcode still default
$is_default_shortcode = (trim($form_sc) === '' || strpos($form_sc, 'id="123"') !== false);
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/Contact-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Contact banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Contact Us</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Get in Touch with Our Team</h2>
    <p class="al-hero__text">
      From strategy to execution, every service is designed to move your business
      forward with clarity, confidence, and measurable impact.
    </p>
  </div>
</section>

<main class="site-main contact-page">

  <!-- =====================================================
       CONTACT FORM 7 SECTION (Form + Right Cards)
  ====================================================== -->
  <section class="al-contact-wrap">
    <div class="al-contact-grid">

      <!-- LEFT: FORM -->
      <div class="al-contact-card">
        <h2 class="al-contact-h2"><?php echo esc_html($form_title); ?></h2>

        <div class="al-contact-cf7">
          <?php
            // If Contact Form 7 shortcode isn't available, show helpful message
            if (!shortcode_exists('contact-form-7')) {
              echo '<p style="color:#b91c1c;font-weight:800;">Contact Form 7 is not active. Please install/activate the plugin.</p>';
            } else {
              // If shortcode still default, show guidance (admin only)
              if ($is_default_shortcode && current_user_can('manage_options')) {
                echo '<div style="padding:12px 14px;border-radius:14px;background:#fff7ed;border:1px solid #fed7aa;color:#9a3412;font-weight:700;margin-bottom:14px;">
                        ⚠️ Your Contact Form 7 shortcode is still the default placeholder.
                        Go to <strong>WP Admin → Contact → Contact Forms</strong> and copy your real shortcode,
                        then paste it into <strong>Appearance → Customize → Contact Page</strong>.
                      </div>';
              }

              // Render shortcode
              echo do_shortcode($form_sc);
            }
          ?>
        </div>
      </div>

      <!-- RIGHT: Book + Info -->
      <div class="al-contact-side">

        <!-- Book a Call -->
        <div class="al-book-card">
          <div class="al-book-ic" aria-hidden="true">
            <i class="fa-regular fa-calendar-days"></i>
          </div>

          <h3><?php echo esc_html($call_t); ?></h3>
          <p><?php echo esc_html($call_p); ?></p>
          <a class="al-book-btn" href="<?php echo esc_url($call_href); ?>">
            <?php echo esc_html($call_bt); ?>
          </a>
        </div>

        <!-- Contact Info -->
        <div class="al-info-card">
          <h3>Contact Information</h3>

          <div class="al-info-list">
            <a class="al-info-item" href="mailto:<?php echo esc_attr($email); ?>">
              <span class="al-info-icon" aria-hidden="true">
                <i class="fa-solid fa-envelope"></i>
              </span>
              <span class="al-info-text">
                <small>Email</small>
                <strong><?php echo esc_html($email); ?></strong>
              </span>
            </a>

            <a class="al-info-item" href="tel:<?php echo esc_attr(preg_replace('/[^0-9\+]/', '', $phone)); ?>">
              <span class="al-info-icon" aria-hidden="true">
                <i class="fa-solid fa-phone"></i>
              </span>
              <span class="al-info-text">
                <small>Phone</small>
                <strong><?php echo esc_html($phone); ?></strong>
              </span>
            </a>

            <div class="al-info-item">
              <span class="al-info-icon" aria-hidden="true">
                <i class="fa-solid fa-location-dot"></i>
              </span>
              <span class="al-info-text">
                <small>Address</small>
                <strong><?php echo esc_html($addr1); ?><br><?php echo esc_html($addr2); ?></strong>
              </span>
            </div>
          </div>

          <div class="al-follow">
            <p>Follow us</p>
            <div class="al-social">
              <a href="<?php echo esc_url($linkedin); ?>" aria-label="LinkedIn" class="al-social-btn">
                <i class="fa-brands fa-linkedin-in"></i>
              </a>
              <a href="<?php echo esc_url($twitter); ?>" aria-label="Twitter" class="al-social-btn">
                <i class="fa-brands fa-x-twitter"></i>
              </a>
              <a href="<?php echo esc_url($facebook); ?>" aria-label="Facebook" class="al-social-btn">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
            </div>
          </div>
        </div>

      </div><!-- /right -->

    </div>
  </section>

  <!-- =====================================================
       ELEMENTOR EDITABLE AREA
       IMPORTANT: only output the_content ONCE
  ====================================================== -->
  <section class="home-elementor">
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
  </section>

  <!-- =====================================================
       CTA Consultation
  ====================================================== -->
  <?php get_template_part('cta-consultation'); ?>

</main>

<?php get_footer(); ?>
