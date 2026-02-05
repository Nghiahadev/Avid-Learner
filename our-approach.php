<?php
/**
 * Our Approach section (template part)
 * Usage: get_template_part('our-approach');
 */

$theme = get_template_directory_uri();

// Defaults (fallback to your theme assets)
$icon_path = $theme . '/assets/images';
$img_path  = $theme . '/assets/images';

// Section texts
$kicker    = get_theme_mod('al_approach_kicker', 'our approach');
$title     = get_theme_mod('al_approach_title', 'Customized strategies for');
$highlight = get_theme_mod('al_approach_highlight', 'learning success');

$btn_text = get_theme_mod('al_approach_btn_text', 'Contact now');
$btn_url  = get_theme_mod('al_approach_btn_url', '/contact');

// Build cards (3)
$cards = [];
for ($i = 1; $i <= 3; $i++) {

  $card_title = get_theme_mod("al_approach_{$i}_title", '');
  $card_text  = get_theme_mod("al_approach_{$i}_text", '');

  // Icon: Customizer upload OR fallback svg
  $icon_id  = (int) get_theme_mod("al_approach_{$i}_icon", 0);
  $icon_url = $icon_id ? wp_get_attachment_image_url($icon_id, 'full') : '';

  if (!$icon_url) {
    $fallback_icons = [
      1 => $icon_path . '/icon-our-mission.svg',
      2 => $icon_path . '/icon-our-vision.svg',
      3 => $icon_path . '/icon-our-value.svg',
    ];
    $icon_url = $fallback_icons[$i] ?? '';
  }

  // Image: Customizer upload OR fallback jpg
  $img_id  = (int) get_theme_mod("al_approach_{$i}_image", 0);
  $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'full') : '';

  if (!$img_url) {
    $fallback_imgs = [
      1 => $img_path . '/our-mission-img.jpg',
      2 => $img_path . '/our-vision-img.jpg',
      3 => $img_path . '/our-value-img.jpg',
    ];
    $img_url = $fallback_imgs[$i] ?? '';
  }

  // Delay
  $delay = ($i === 1 ? '0s' : ($i === 2 ? '0.2s' : '0.4s'));

  // Safety fallback if empty
  if (!$card_title) {
    $card_title = ($i === 1 ? 'our mission' : ($i === 2 ? 'our vision' : 'our value'));
  }
  if (!$card_text) {
    $card_text = ($i === 1
      ? 'Empowering learners with practical paths to grow skills and build real projects.'
      : ($i === 2
        ? 'A community where learning is clear, consistent, and connected to real outcomes.'
        : 'Simplicity, momentum, and support—so you can learn smarter and ship faster.'
      )
    );
  }

  $cards[] = [
    'icon'  => $icon_url,
    'title' => $card_title,
    'text'  => $card_text,
    'image' => $img_url,
    'delay' => $delay,
  ];
}
?>

<section class="our-approach" aria-label="Our approach">
  <div class="container">

    <div class="row section-row align-items-center">
      <div class="col-lg-6">
        <div class="section-title">
          <h3 class="wow fadeInUp"><?php echo esc_html($kicker); ?></h3>
          <h2 class="wow fadeInUp" data-wow-delay="0.2s">
            <?php echo esc_html($title); ?> <span><?php echo esc_html($highlight); ?></span>
          </h2>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
          <a href="<?php echo esc_url(al_to_url($btn_url)); ?>" class="btn-default">
            <?php echo esc_html($btn_text); ?>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <?php foreach ($cards as $card) : ?>
        <div class="col-lg-4 col-md-6">
          <div class="mission-vission-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($card['delay']); ?>">

            <div class="mission-vission-header">
              <div class="icon-box">
                <?php if (!empty($card['icon'])) : ?>
                  <img src="<?php echo esc_url($card['icon']); ?>" alt="<?php echo esc_attr($card['title']); ?> icon">
                <?php endif; ?>
              </div>

              <div class="mission-vission-content">
                <h3><?php echo esc_html($card['title']); ?></h3>
                <p><?php echo esc_html($card['text']); ?></p>
              </div>
            </div>

            <div class="mission-vission-image">
              <!-- ✅ Add reveal class (optional) -->
              <figure class="image-anime reveal">
                <?php if (!empty($card['image'])) : ?>
                  <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?> image">
                <?php endif; ?>
              </figure>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
