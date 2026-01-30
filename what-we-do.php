<?php
/**
 * What We Do section
 * File: /what-we-do.php (theme root)
 */
if (!defined('ABSPATH')) exit;

$badge     = get_theme_mod('al_wedo_badge', 'What We Do');
$heading   = get_theme_mod('al_wedo_heading', 'Expertise That Drives Results');
$highlight = get_theme_mod('al_wedo_highlight', 'Drives Results');
$desc      = get_theme_mod('al_wedo_desc', 'We combine deep industry knowledge with innovative methodologies to help businesses overcome challenges and achieve transformational growth.');

$link_raw = trim((string) get_theme_mod('al_wedo_link', '/services'));
if ($link_raw === '') $link_raw = '/services';
$link = preg_match('#^https?://#i', $link_raw) ? esc_url($link_raw) : esc_url(home_url($link_raw[0] === '/' ? $link_raw : "/$link_raw"));

/* Safe highlighted heading */
$heading_plain   = wp_strip_all_tags((string)$heading);
$highlight_plain = wp_strip_all_tags((string)$highlight);
$heading_html    = esc_html($heading_plain);

if (!empty($highlight_plain) && strpos($heading_plain, $highlight_plain) !== false) {
  $pos    = strpos($heading_plain, $highlight_plain);
  $before = substr($heading_plain, 0, $pos);
  $after  = substr($heading_plain, $pos + strlen($highlight_plain));

  $heading_html =
    esc_html($before) .
    ' <span class="al-wedo-gradient">' . esc_html($highlight_plain) . '</span>' .
    esc_html($after);
}

/* Card content */
$defaults = [
  ['Strategy Consulting', 'Develop winning strategies that position your business for long-term success and market leadership.'],
  ['Growth Marketing', 'Accelerate revenue growth with data-driven marketing strategies and customer acquisition frameworks.'],
  ['Digital Transformation', 'Modernize your operations with cutting-edge technology solutions and process optimization.'],
  ['Organizational Excellence', 'Build high-performing teams and cultures that drive innovation and sustainable growth.'],
];

$cards = [];
for ($i=1; $i<=4; $i++){
  $cards[] = [
    'title' => get_theme_mod("al_wedo_{$i}_title", $defaults[$i-1][0]),
    'desc'  => get_theme_mod("al_wedo_{$i}_desc",  $defaults[$i-1][1]),
  ];
}

/* Inline SVG icons (NO PHP function to avoid redeclare issues) */
$icons = [
  // bulb
  '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12c.6.6 1 1.5 1 2.5V17h6v-.5c0-1 .4-1.9 1-2.5A7 7 0 0 0 12 2Z"/></svg>',
  // trending up
  '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17l6-6 4 4 8-8"/><path d="M14 7h7v7"/></svg>',
  // chart
  '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v18h18"/><path d="M7 15v3"/><path d="M11 12v6"/><path d="M15 8v10"/><path d="M19 5v13"/></svg>',
  // users
  '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 11a4 4 0 1 0-8 0"/><path d="M12 15c-4 0-7 2-7 5v1h14v-1c0-3-3-5-7-5Z"/><path d="M20 8a3 3 0 0 0-3-3"/><path d="M21 21v-1c0-2-1.4-3.6-3.5-4.4"/></svg>',
];
?>

<section class="al-wedo2" aria-label="What We Do">
  <div class="al-wedo2-dots" aria-hidden="true"></div>

  <div class="al-wedo2-container">
    <div class="al-wedo2-head">
      <span class="al-wedo2-badge"><?php echo esc_html($badge); ?></span>

      <h2 class="al-wedo2-title">
        <?php echo wp_kses($heading_html, ['span' => ['class' => []]]); ?>
      </h2>

      <p class="al-wedo2-desc"><?php echo esc_html($desc); ?></p>
    </div>

    <div class="al-wedo2-grid">
      <?php foreach ($cards as $idx => $card): ?>
        <article class="al-wedo2-card">
          <div class="al-wedo2-icon">
            <?php echo $icons[$idx]; ?>
          </div>

          <h3 class="al-wedo2-card-title"><?php echo esc_html($card['title']); ?></h3>
          <p class="al-wedo2-card-desc"><?php echo esc_html($card['desc']); ?></p>

          <a class="al-wedo2-link" href="<?php echo $link; ?>">
            Learn more <span aria-hidden="true">→</span>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
