<?php
/**
 * Template Part: CTA Section
 */

if (!defined('ABSPATH')) exit;

$bg = 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/team-working-around-computers-men-scaled.jpg';
$kicker = get_theme_mod('al_cta_kicker', 'Invest in Yourself');
$title  = get_theme_mod('al_cta_title', 'Design the Life You Want with Expert Consulting');
$desc   = get_theme_mod('al_cta_desc', 'Transform your goals into a clear, actionable plan with personalized consulting tailored to your needs. Book a session today and start making confident, informed decisions for your future.');
$btn_t  = get_theme_mod('al_cta_btn_text', 'CONTACT US');
$btn_u  = get_theme_mod('al_cta_btn_url', '/contact');

// If user typed "/contact" keep it. If they typed full URL, keep it.
$btn_url = $btn_u ? esc_url($btn_u) : home_url('/contact');

// Background style
$bg_style = '';
if (!empty($bg)) {
  $bg_style = "style=\"background-image:url('" . esc_url($bg) . "');\"";
}
?>

<section class="al-cta" <?php echo $bg_style; ?> aria-label="Call to Action">
  <div class="al-cta-overlay" aria-hidden="true"></div>

  <div class="al-container al-cta-inner">
    <div class="al-cta-content">
      <?php if (!empty($kicker)) : ?>
        <h6 class="al-cta-kicker"><?php echo esc_html($kicker); ?></h6>
      <?php endif; ?>

      <?php if (!empty($title)) : ?>
        <h3 class="al-cta-title"><?php echo esc_html($title); ?></h3>
      <?php endif; ?>

      <?php if (!empty($desc)) : ?>
        <p class="al-cta-desc"><?php echo esc_html($desc); ?></p>
      <?php endif; ?>

      <?php if (!empty($btn_t)) : ?>
        <div class="al-cta-btn-wrap">
          <a class="al-cta-btn" href="<?php echo $btn_url; ?>">
            <span class="al-cta-btn-text"><?php echo esc_html($btn_t); ?></span>
            <span class="al-cta-btn-dot" aria-hidden="true"></span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
