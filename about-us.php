<?php
if ( ! get_theme_mod('al_about_enabled', true) ) return;

$img1   = get_theme_mod('al_about_img_1', '');
$img2   = get_theme_mod('al_about_img_2', '');
$circle = get_theme_mod('al_about_circle_img', '');

$kicker = get_theme_mod('al_about_kicker', 'ABOUT US');
$title  = get_theme_mod('al_about_title', 'Trusted guidance for <span>business growth</span>');
$desc   = get_theme_mod('al_about_desc', '');

$service_title = get_theme_mod('al_about_service_title', 'Strategic Advisory');
$service_desc  = get_theme_mod('al_about_service_desc', 'Clear, data-informed guidance to improve decision-making, optimize operations, and support long-term growth.');
$service_fa    = trim((string) get_theme_mod('al_about_service_fa', 'fa-solid fa-briefcase'));

$author_photo  = get_theme_mod('al_about_author_photo', '');
$author_name   = get_theme_mod('al_about_author_name', 'Kimberly');
$author_title  = get_theme_mod('al_about_author_title', 'Co. Founder');

$checks_raw = (string) get_theme_mod('al_about_checks', "Strategy & Roadmaps\nClear Communication\nOngoing Support");
$checks = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $checks_raw)));
?>

<section class="al-about" aria-label="About us">
  <div class="al-wrap">
    <div class="al-about-grid">

      <!-- LEFT: images -->
      <div class="al-about-left">
        <div class="al-about-images">

          <div class="al-about-img al-img-1">
            <?php if ($img1): ?>
              <img src="<?php echo esc_url($img1); ?>" alt="">
            <?php else: ?>
              <div class="al-placeholder">Set About Image 1 in Customizer</div>
            <?php endif; ?>
          </div>

          <div class="al-about-img al-img-2">
            <?php if ($img2): ?>
              <img src="<?php echo esc_url($img2); ?>" alt="">
            <?php else: ?>
              <div class="al-placeholder">Set About Image 2 in Customizer</div>
            <?php endif; ?>
          </div>

          <?php if ($circle): ?>
            <div class="al-about-circle" aria-hidden="true">
              <img src="<?php echo esc_url($circle); ?>" alt="">
            </div>
          <?php endif; ?>

          <div class="al-about-dots" aria-hidden="true"></div>

        </div>
      </div>

      <!-- RIGHT: content -->
      <div class="al-about-right">

        <div class="al-about-head">
          <div class="al-about-kicker">
            <span class="al-kicker-icon" aria-hidden="true">
              <i class="fa-solid fa-circle-dollar-to-slot"></i>
            </span>
            <span><?php echo esc_html($kicker); ?></span>
          </div>

          <h2 class="al-about-title"><?php echo wp_kses_post($title); ?></h2>

          <?php if ($desc): ?>
            <p class="al-about-desc"><?php echo wp_kses_post($desc); ?></p>
          <?php endif; ?>
        </div>

        <div class="al-about-row">

          <!-- Service mini box -->
          <div class="al-about-mini">
            <div class="al-mini-icon" aria-hidden="true">
              <i class="<?php echo esc_attr($service_fa); ?>"></i>
            </div>
            <div class="al-mini-body">
              <h3><?php echo esc_html($service_title); ?></h3>
              <p><?php echo wp_kses_post($service_desc); ?></p>
            </div>
          </div>

          <!-- Author card -->
          <div class="al-about-card">
            <div class="al-card-top">
              <div class="al-card-avatar">
                <?php if ($author_photo): ?>
                  <img src="<?php echo esc_url($author_photo); ?>" alt="">
                <?php else: ?>
                  <span aria-hidden="true"><i class="fa-solid fa-user"></i></span>
                <?php endif; ?>
              </div>
              <div>
                <div class="al-card-name"><?php echo esc_html($author_name); ?></div>
                <div class="al-card-role"><?php echo esc_html($author_title); ?></div>
              </div>
            </div>

            <?php if (!empty($checks)): ?>
              <ul class="al-card-list">
                <?php foreach ($checks as $c): ?>
                  <li><?php echo esc_html($c); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>
