<?php
/**
 * Services Grid (Customizer-driven)
 * Usage: get_template_part('template-parts/services-grid');
 */

$kicker    = get_theme_mod('al_svc_kicker', 'Our Services');
$title     = get_theme_mod('al_svc_title', 'Strategic Solutions for Every Challenge');
$highlight = get_theme_mod('al_svc_title_highlight', 'Every Challenge');
$subtitle  = get_theme_mod('al_svc_subtitle', 'From strategy to execution, we provide comprehensive consulting services that drive measurable business outcomes.');

$services = [];
for ($i = 1; $i <= 6; $i++) {
  $features = [];
  for ($f = 1; $f <= 4; $f++) {
    $val = trim(get_theme_mod("al_svc_{$i}_feature_{$f}", ''));
    if ($val !== '') $features[] = $val;
  }

  $services[] = [
    'icon' => trim(get_theme_mod("al_svc_{$i}_icon", 'fa-solid fa-circle')),
    'title' => trim(get_theme_mod("al_svc_{$i}_title", "Service {$i}")),
    'desc' => trim(get_theme_mod("al_svc_{$i}_desc", "")),
    'url' => trim(get_theme_mod("al_svc_{$i}_url", "/services")),
    'features' => $features,
  ];
}
?>

<section class="al-svc-grid" aria-label="Services grid">
  <div class="al-svc-grid__inner">

    <header class="al-svc-grid__head">
      <span class="al-svc-pill"><?php echo esc_html($kicker); ?></span>

      <?php
        // Highlight phrase inside title
        $title_html = esc_html($title);
        if ($highlight && strpos($title, $highlight) !== false) {
          $title_html = str_replace(
            esc_html($highlight),
            '<span>' . esc_html($highlight) . '</span>',
            esc_html($title)
          );
        } else {
          // fallback: highlight nothing
          $title_html = esc_html($title);
        }
      ?>
      <h2 class="al-svc-title"><?php echo $title_html; ?></h2>

      <p class="al-svc-sub"><?php echo esc_html($subtitle); ?></p>
    </header>

    <div class="al-svc-cards">
      <?php foreach ($services as $s): ?>
        <article class="al-svc-card">
          <div class="al-svc-ic" aria-hidden="true">
            <i class="<?php echo esc_attr($s['icon']); ?>"></i>
          </div>

          <h3 class="al-svc-card__title"><?php echo esc_html($s['title']); ?></h3>
          <?php if ($s['desc']): ?>
            <p class="al-svc-card__desc"><?php echo esc_html($s['desc']); ?></p>
          <?php endif; ?>

          <?php if (!empty($s['features'])): ?>
            <ul class="al-svc-features">
              <?php foreach ($s['features'] as $f): ?>
                <li>
                  <i class="fa-solid fa-check" aria-hidden="true"></i>
                  <span><?php echo esc_html($f); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <a class="al-svc-link" href="<?php echo esc_url(home_url($s['url'])); ?>">
            Learn More <i class="fa-solid fa-arrow-right"></i>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>
