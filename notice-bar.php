<?php
/**
 * Notice / Announcement Ticker Bar
 * You can edit the items below anytime.
 */

$items = [
  'Latest Updates',
  'New Announcements',
  'Workshop Alerts',
  'Live Notices',
  'Event Countdown',
  'Community News',
];
?>

<section class="al-notice-bar" aria-label="Site announcements">
  <div class="al-notice-track" role="marquee" aria-live="off">
    <?php for ($r = 0; $r < 2; $r++) : ?>
      <div class="al-notice-row" aria-hidden="<?php echo $r === 1 ? 'true' : 'false'; ?>">
        <?php foreach ($items as $i => $label) : ?>
          <span class="al-notice-item">
            <span class="al-notice-sep" aria-hidden="true">*</span>
            <span class="al-notice-text"><?php echo esc_html($label); ?></span>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endfor; ?>
  </div>
</section>
