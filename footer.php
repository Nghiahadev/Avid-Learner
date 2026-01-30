<?php
/**
 * Footer template for Avid Learner
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

// Footer text (Customizer-ready later if you want)
$footer_title = get_theme_mod('al_footer_title', 'Join our newsletter for important updates');
$footer_note  = get_theme_mod('al_footer_note', 'Stay informed with instant updates delivered straight to your inbox.');

$brand_name   = get_theme_mod('al_footer_brand', 'Avid Learner');

// Updated consultant-focused description ✅
$footer_about = get_theme_mod(
  'al_footer_about',
  'We help businesses turn ideas into measurable results through strategy, execution, and continuous optimization—so you can grow with clarity and confidence.'
);

// Only email + address (NO phone) ✅
$email   = get_theme_mod('al_footer_email', 'info@avidlearner.com');
$address = get_theme_mod('al_footer_address', 'Philadelphia, PA, US');

// Social links
$facebook  = get_theme_mod('al_social_facebook', '#');
$twitter   = get_theme_mod('al_social_twitter', '#');
$instagram = get_theme_mod('al_social_instagram', '#');
$linkedin  = get_theme_mod('al_social_linkedin', '#');

$year = date('Y');
?>

<footer class="al-footer" role="contentinfo">
  <div class="al-footer-inner">

    <!-- TOP: Newsletter -->
    <div class="al-footer-top">
      <div class="al-footer-top-left">
        <h2 class="al-footer-title"><?php echo esc_html($footer_title); ?></h2>
      </div>

      <div class="al-footer-top-right">
        <div class="al-footer-note">
          <span class="al-footer-note-icon" aria-hidden="true">
            <i class="fa-regular fa-bell"></i>
          </span>
          <p><?php echo esc_html($footer_note); ?></p>
        </div>

        <!-- Newsletter form (Newsletter plugin by Stefano Lissa) -->
        <div class="al-footer-newsletter al-newsletter-fa">
          <?php echo do_shortcode('[newsletter]'); ?>
        </div>
      </div>
    </div>

    <div class="al-footer-divider"></div>

    <!-- MIDDLE -->
    <div class="al-footer-mid">

      <!-- Left: Brand -->
      <div class="al-footer-brand">
        <div class="al-footer-logo">
          <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <a class="al-footer-logo-text" href="<?php echo esc_url(home_url('/')); ?>">
              <?php echo esc_html($brand_name); ?>
            </a>
          <?php endif; ?>
        </div>

        <p class="al-footer-about"><?php echo esc_html($footer_about); ?></p>

        <div class="al-footer-social" aria-label="Social links">
          <a class="al-social-btn" href="<?php echo esc_url($facebook); ?>" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a class="al-social-btn" href="<?php echo esc_url($twitter); ?>" aria-label="X / Twitter">
            <i class="fa-brands fa-x-twitter"></i>
          </a>
          <a class="al-social-btn" href="<?php echo esc_url($instagram); ?>" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a class="al-social-btn" href="<?php echo esc_url($linkedin); ?>" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <!-- Right: Quick Links + Contact -->
      <div class="al-footer-cols">

        <!-- Quick Links -->
        <div class="al-footer-col">
          <h3>Quick Links</h3>
          <ul class="al-footer-menu">
            <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
            <li><a href="<?php echo esc_url(home_url('/services')); ?>">Services</a></li>
            <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
            <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
            <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div class="al-footer-col al-footer-contact">
          <h3>Get In Touch</h3>

          <ul class="al-footer-contact-list">
            <li>
              <a href="<?php echo esc_url('mailto:' . $email); ?>">
                <?php echo esc_html($email); ?>
              </a>
            </li>
          </ul>

          <div class="al-footer-contact-divider"></div>

          <p class="al-footer-address"><?php echo esc_html($address); ?></p>
        </div>

      </div>
    </div>

    <!-- BOTTOM -->
    <div class="al-footer-bottom">
      <p>Copyright © <?php echo esc_html($year); ?> All Rights Reserved.</p>
    </div>

  </div>

  <?php wp_footer(); ?>
</footer>
</body>
</html>
