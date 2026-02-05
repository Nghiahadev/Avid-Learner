<?php
$creds = [
  ['icon' => 'fa-solid fa-award',      'label' => 'Top 10 Consulting Firm'],
  ['icon' => 'fa-solid fa-globe',      'label' => 'Global Presence'],
  ['icon' => 'fa-solid fa-briefcase',  'label' => 'Fortune 500 Clients'],
];
?>

<section class="al-about-cta" aria-label="About CTA">
  <div class="al-wrap">
    <div class="al-cta-grid">

      <div class="al-cta-left">
        <h2>Ready to Write Your Success Story?</h2>
        <p>
          Join the hundreds of companies that have transformed their businesses with ApexConsult.
        </p>
        <a class="al-cta-btn" href="<?php echo esc_url(home_url('/contact')); ?>">
          Start Your Journey
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <div class="al-cta-right">
        <div class="al-creds-grid">
          <?php foreach ($creds as $c): ?>
            <div class="al-cred">
              <div class="al-cred-ic" aria-hidden="true"><i class="<?php echo esc_attr($c['icon']); ?>"></i></div>
              <p><?php echo esc_html($c['label']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>
