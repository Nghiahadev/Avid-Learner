<?php
/**
 * Template Part: Why Choose Us
 * File: template-parts/why-choose-us.php
 */

if (!defined('ABSPATH')) exit;

/* ---------------------------
   Defaults (always show)
---------------------------- */
$default_stats = [
  ['number' => '500', 'prefix' => '',  'suffix' => '+', 'label' => 'Projects Delivered'],
  ['number' => '98',  'prefix' => '',  'suffix' => '%', 'label' => 'Client Satisfaction'],
  ['number' => '150', 'prefix' => '$', 'suffix' => 'M', 'label' => 'Revenue Generated'],
  ['number' => '12',  'prefix' => '',  'suffix' => '+', 'label' => 'Years Experience'],
];

$badge     = get_theme_mod('al_why_badge', 'Why Choose Us');
$heading   = get_theme_mod('al_why_heading', "We Don't Just Consult — We Transform");
$highlight = get_theme_mod('al_why_highlight', 'We Transform');
$desc      = get_theme_mod(
  'al_why_desc',
  'Our approach combines strategic thinking with hands-on execution. We work alongside your team to implement solutions that deliver measurable, lasting results.'
);

$benefits_raw = get_theme_mod(
  'al_why_benefits',
  "Data-driven decision making\nProven ROI within 90 days\nDedicated expert teams\nContinuous optimization\nTransparent communication\nIndustry-leading methodologies"
);

$benefits = array_values(array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", (string)$benefits_raw))));

/* ---------------------------
   Build stats (Customizer OR defaults)
---------------------------- */
$stats = [];
for ($i = 1; $i <= 4; $i++) {
  $def = $default_stats[$i - 1];

  $num   = get_theme_mod("al_stat_{$i}_number", $def['number']);
  $prefix= get_theme_mod("al_stat_{$i}_prefix", $def['prefix']);
  $suffix= get_theme_mod("al_stat_{$i}_suffix", $def['suffix']);
  $label = get_theme_mod("al_stat_{$i}_label",  $def['label']);

  // Clean number so "500+" or "$150M" still works
  $num_clean = preg_replace('/[^0-9.]/', '', (string)$num);
  if ($num_clean === '' || !is_numeric($num_clean)) {
    $num_clean = $def['number'];
  }

  $decimals = (strpos($num_clean, '.') !== false) ? strlen(substr(strrchr($num_clean, '.'), 1)) : 0;

  $stats[] = [
    'number'   => $num_clean,
    'prefix'   => (string)$prefix,
    'suffix'   => (string)$suffix,
    'label'    => (string)$label,
    'decimals' => (int)$decimals,
  ];
}

/* ---------------------------
   Heading highlight (safe)
---------------------------- */
$heading_plain   = wp_strip_all_tags((string)$heading);
$highlight_plain = wp_strip_all_tags((string)$highlight);

$heading_html = esc_html($heading_plain);

if (!empty($highlight_plain) && strpos($heading_plain, $highlight_plain) !== false) {
  $pos = strpos($heading_plain, $highlight_plain);
  $before = substr($heading_plain, 0, $pos);
  $after  = substr($heading_plain, $pos + strlen($highlight_plain));

  $heading_html =
    esc_html($before) .
    '<span class="al-text-gradient">' . esc_html($highlight_plain) . '</span>' .
    esc_html($after);
}
?>

<section class="al-why section-spacing" aria-label="Why Choose Us">
  <div class="al-why-blob al-why-blob-blue" aria-hidden="true"></div>
  <div class="al-why-blob al-why-blob-purple" aria-hidden="true"></div>

  <div class="al-container">
    <div class="al-why-grid">

      <!-- Left -->
      <div class="al-why-left al-reveal" data-reveal="left">
        <span class="al-why-badge"><?php echo esc_html($badge); ?></span>

        <h2 class="al-why-title">
          <?php echo wp_kses($heading_html, ['span' => ['class' => []]]); ?>
        </h2>

        <p class="al-why-desc"><?php echo esc_html($desc); ?></p>

        <div class="al-why-benefits">
          <?php foreach ($benefits as $index => $benefit) : ?>
            <div class="al-benefit al-stagger" data-delay="<?php echo esc_attr((int)$index); ?>">
              <span class="al-check" aria-hidden="true">✓</span>
              <span class="al-benefit-text"><?php echo esc_html($benefit); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right -->
      <div class="al-why-right al-reveal" data-reveal="right">
        <div class="al-stats-grid">
          <?php foreach ($stats as $stat) : ?>
            <div class="al-stat-card">
              <div class="al-stat-number">
                <?php if ($stat['prefix'] !== '') : ?>
                  <span class="al-stat-prefix"><?php echo esc_html($stat['prefix']); ?></span>
                <?php endif; ?>

                <span
                  class="al-counter"
                  data-end="<?php echo esc_attr($stat['number']); ?>"
                  data-decimals="<?php echo esc_attr($stat['decimals']); ?>"
                  data-duration="1200"
                >0</span>

                <?php if ($stat['suffix'] !== '') : ?>
                  <span class="al-stat-suffix"><?php echo esc_html($stat['suffix']); ?></span>
                <?php endif; ?>
              </div>

              <p class="al-stat-label"><?php echo esc_html($stat['label']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>
