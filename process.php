<?php
/**
 * Template Part: Process Section
 * File: /process.php (theme root)
 */

if (!defined('ABSPATH')) exit;

$steps = [
  [
    'number' => '01',
    'title' => 'Discovery Call',
    'description' => 'We begin with a complimentary consultation to understand your goals, challenges, and what success looks like for you.',
  ],
  [
    'number' => '02',
    'title' => 'Assessment & Strategy',
    'description' => 'Through proven assessment tools and deep dialogue, we identify key focus areas and design your personalized development roadmap.',
  ],
  [
    'number' => '03',
    'title' => 'Coaching & Development',
    'description' => 'Regular sessions combine reflection, skill-building, and real-world application to drive meaningful progress.',
  ],
  [
    'number' => '04',
    'title' => 'Integration & Growth',
    'description' => 'We embed new capabilities into your daily practice, measure results, and celebrate your transformation.',
  ],
];
?>

<section class="al-process" aria-label="How We Work Together">
  <div class="al-container">

    <div class="al-process-head al-reveal" data-reveal="up">
      <span class="al-process-kicker">The Journey</span>
      <h2 class="al-process-title">How We Work Together</h2>
      <p class="al-process-desc">
        A structured yet flexible process designed to meet you where you are
        and guide you where you want to be.
      </p>
    </div>

    <div class="al-process-wrap">
      <div class="al-process-line" aria-hidden="true"></div>

      <div class="al-process-grid">
        <?php foreach ($steps as $i => $step): ?>
          <article class="al-process-card al-reveal" data-reveal="up" style="--delay: <?php echo esc_attr($i * 0.15); ?>s">
            <div class="al-process-badge" aria-hidden="true">
              <span><?php echo esc_html($step['number']); ?></span>
            </div>

            <div class="al-process-card-inner">
              <h3><?php echo esc_html($step['title']); ?></h3>
              <p><?php echo esc_html($step['description']); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>
