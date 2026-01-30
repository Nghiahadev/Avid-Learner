<?php
/**
 * Services Page (Hard-coded Hero Image)
 * This file is automatically used when page slug = services
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/Services-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Services banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Our Services</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Built for Growth. Delivered with Precision.</h2>
    <p class="al-hero__text">
      From strategy to execution, every service is designed to move your business
      forward with clarity, confidence, and measurable impact.
    </p>
  </div>
</section>

<main class="site-main services-page">
  <?php
  while (have_posts()) :
    the_post();
    the_content();
  endwhile;
  ?>


  <?php get_template_part('our-approach'); ?>

    <!-- =====================================================
       FAQ – Avid Learner
  ====================================================== -->
    <?php get_template_part('faq-learning'); ?>

    <!-- =====================================================
       ELEMENTOR EDITABLE AREA
       (Add sections in Elementor Editor for the Home page)
  ====================================================== -->
  <section class="home-elementor">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </section>
    <!-- =====================================================
       CTA Consultation 
  ====================================================== -->
  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>
