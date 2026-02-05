<?php
$timeline = [
  ['year' => '2012', 'title' => 'Founded',          'desc' => 'Started with a vision to transform how businesses approach growth and strategy.'],
  ['year' => '2015', 'title' => 'National Expansion','desc' => 'Opened offices in New York, San Francisco, and Chicago.'],
  ['year' => '2018', 'title' => 'Digital Innovation Lab','desc' => 'Launched our innovation practice to help clients navigate digital disruption.'],
  ['year' => '2021', 'title' => 'Global Reach',     'desc' => 'Expanded internationally with offices in London and Singapore.'],
  ['year' => '2024', 'title' => '500+ Projects',    'desc' => 'Celebrated delivering over 500 successful client engagements.'],
];
?>

<section class="al-about-timeline" aria-label="Our journey">
  <div class="al-wrap">
    <header class="al-section-head center">
      <span class="al-pill">Our Journey</span>
      <h2 class="al-h2">The <span>ApexConsult</span> Story</h2>
    </header>

<div class="al-timeline">
  <div class="al-timeline-line" aria-hidden="true">
    <span class="al-timeline-line-fill" aria-hidden="true"></span>
  </div>

  <?php foreach ($timeline as $i => $t): 
    $side = ($i % 2 === 0) ? 'left' : 'right';
  ?>
    <article class="al-timeline-item <?php echo esc_attr($side); ?>" data-animate="timeline">
      <div class="al-timeline-content">
        <div class="al-year"><?php echo esc_html($t['year']); ?></div>
        <h3><?php echo esc_html($t['title']); ?></h3>
        <p><?php echo esc_html($t['desc']); ?></p>
      </div>
      <div class="al-dot" aria-hidden="true"></div>
    </article>
  <?php endforeach; ?>
</div>

  </div>
</section>
