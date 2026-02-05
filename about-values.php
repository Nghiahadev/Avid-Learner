<?php
$values = [
  ['icon' => 'fa-solid fa-bullseye', 'title' => 'Results-Driven',  'desc' => 'We measure our success by the tangible outcomes we deliver for our clients.'],
  ['icon' => 'fa-solid fa-heart',    'title' => 'Client-Centric',  'desc' => 'Your success is our priority. We become true partners in your journey.'],
  ['icon' => 'fa-solid fa-bolt',     'title' => 'Innovation First','desc' => 'We constantly push boundaries and embrace new ideas and methodologies.'],
  ['icon' => 'fa-solid fa-people-group','title' => 'Collaborative','desc' => 'We work alongside your team, building capabilities that last beyond our engagement.'],
];
?>

<section class="al-about-values" aria-label="Our values">
  <div class="al-wrap">
    <div class="al-values-grid">

      <div class="al-values-left">
        <span class="al-pill">Our Values</span>
        <h2 class="al-h2">The Principles That <span>Guide Us</span></h2>
        <p class="al-sub">
          Our values shape every decision we make and every interaction we have. They're the foundation of our culture
          and the key to our success.
        </p>

        <div class="al-values-cards">
          <?php foreach ($values as $v): ?>
            <div class="al-value-item">
              <div class="al-value-ic" aria-hidden="true"><i class="<?php echo esc_attr($v['icon']); ?>"></i></div>
              <div>
                <h3><?php echo esc_html($v['title']); ?></h3>
                <p><?php echo esc_html($v['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="al-values-right">
        <div class="al-approach-card">
          <h3>Our Approach</h3>
          <p>
            We believe in a collaborative, data-driven approach that combines strategic thinking with practical execution.
            We don't just advise — we partner with you to implement solutions that deliver lasting impact.
          </p>

          <div class="al-metrics">
            <div class="al-metric">
              <div class="al-metric-num" data-counter data-end="500" data-suffix="+" data-duration="1200">0+</div>
              <div class="al-metric-label">Projects</div>
            </div>
            <div class="al-metric">
              <div class="al-metric-num" data-counter data-end="50" data-suffix="+" data-duration="1200">0+</div>
              <div class="al-metric-label">Experts</div>
            </div>
            <div class="al-metric">
              <div class="al-metric-num" data-counter data-end="12" data-suffix="" data-duration="1200">0</div>
              <div class="al-metric-label">Countries</div>
            </div>
          </div>
        </div>

        <div class="al-blob b1"></div>
        <div class="al-blob b2"></div>
      </div>

    </div>
  </div>
</section>
