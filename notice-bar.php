<?php
/**
 * Notice / Announcement Ticker Bar
 * Template Part: notice-bar.php
 */

$enabled = (bool) get_theme_mod('al_notice_enabled', true);
if (!$enabled) {
  return;
}

$raw = (string) get_theme_mod(
  'al_notice_items',
  "Latest Updates\nNew Announcements\nWorkshop Alerts\nLive Notices\nEvent Countdown\nCommunity News"
);

// Turn textarea lines into an array
$lines = preg_split("/\r\n|\n|\r/", $raw);
$items = array_values(array_filter(array_map('trim', $lines)));

// Fallback if admin deletes everything
if (empty($items)) {
  $items = ['Latest Updates'];
}
?>

<section class="al-notice-bar" aria-label="Site announcements">
  <div class="al-notice-track" role="marquee" aria-live="off">
    <?php for ($r = 0; $r < 2; $r++) : ?>
      <div class="al-notice-row" aria-hidden="<?php echo $r === 1 ? 'true' : 'false'; ?>">
        <?php foreach ($items as $label) : ?>
          <span class="al-notice-item">
            <span class="al-notice-sep" aria-hidden="true">*</span>
            <span class="al-notice-text"><?php echo esc_html($label); ?></span>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endfor; ?>
  </div>
</section>
