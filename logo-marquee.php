<?php
/**
 * Template Part: Logo Marquee (2 rows, opposite directions)
 */

if ( ! get_theme_mod('al_logo_marquee_enabled', true) ) return;

$raw = (string) get_theme_mod('al_logo_marquee_logos', '');
$lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $raw)));

$items = [];
foreach ($lines as $line) {
  // support: image_url|https://link.com
  $parts = array_map('trim', explode('|', $line, 2));
  $img = $parts[0] ?? '';
  $url = $parts[1] ?? '';

  if ($img) {
    $items[] = [
      'img' => esc_url($img),
      'url' => $url ? esc_url($url) : '',
    ];
  }
}

if (count($items) === 0) return;

$speed = (int) get_theme_mod('al_logo_marquee_speed', 28);
?>

<section class="al-logo-marquee" aria-label="Client logos" style="--al-marquee-speed: <?php echo esc_attr($speed); ?>s;">
  <div class="al-wrap">
    <div class="al-process-head al-reveal" data-reveal="up">
      <span class="al-process-kicker">Our Clients</span>
      <h2 class="al-process-title">Companies We’ve Supported</h2>
      <p class="al-process-desc">
        Trusted by forward-thinking brands across technology, retail, and services
      </p>
    </div>
    <!-- Row 1: right -> left -->
    <div class="al-marquee-row" data-dir="rtl">
      <div class="al-marquee-track">
        <?php for ($r = 0; $r < 2; $r++) : ?>
          <div class="al-marquee-group" aria-hidden="<?php echo $r === 1 ? 'true' : 'false'; ?>">
            <?php foreach ($items as $it) : ?>
              <div class="al-logo-card">
                <?php if (!empty($it['url'])) : ?>
                  <a class="al-logo-link" href="<?php echo $it['url']; ?>" target="_blank" rel="noopener">
                    <img class="al-logo-img" src="<?php echo $it['img']; ?>" alt="" loading="lazy">
                  </a>
                <?php else : ?>
                  <img class="al-logo-img" src="<?php echo $it['img']; ?>" alt="" loading="lazy">
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Row 2: left -> right -->
    <div class="al-marquee-row is-reverse" data-dir="ltr">
      <div class="al-marquee-track">
        <?php for ($r = 0; $r < 2; $r++) : ?>
          <div class="al-marquee-group" aria-hidden="<?php echo $r === 1 ? 'true' : 'false'; ?>">
            <?php foreach ($items as $it) : ?>
              <div class="al-logo-card">
                <?php if (!empty($it['url'])) : ?>
                  <a class="al-logo-link" href="<?php echo $it['url']; ?>" target="_blank" rel="noopener">
                    <img class="al-logo-img" src="<?php echo $it['img']; ?>" alt="" loading="lazy">
                  </a>
                <?php else : ?>
                  <img class="al-logo-img" src="<?php echo $it['img']; ?>" alt="" loading="lazy">
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>

  </div>
</section>
